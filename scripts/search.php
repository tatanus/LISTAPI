<?php
include "../scripts/error_reporting.php";

function display_data($title, $data, $out) {
	$out = validate("out", $out);

}

function display_help($out) {
	$out = validate("out", $out);
        format_output("title", $out, "WORDLIST API HELP");
	if ($out == "html") print "<pre>\n";

	print "Parameters:                 DEFAULT    DESCRIPTION
                            ---------  -----------
     type=..	     --]    passwords  type of words to return: passwords, snmp, dns, etc...
     subtype=..	     --]    [blank]    subtype of words to return: **
     count=[0..1000] --]    10         # of \"words\" to return
     minlen=[0..]    --]    0          minimum length of the returned \"words\"
     maxlen=[0..]    --]    256        maximum length of the returned \"words\"
     startstr=...    --]    [blank]    only return words that starts with a specific substring
     endstr=...	     --]    [blank]    only return words that ends with a specific substring
     substr=...	     --]    [blank]    only return words that contain a specific substring
     sort=[0-4]	     --]    random    sort the word list:
                                         0 = alphabetically, descending
                                         1 = alphabetically, ascending
                                         2 = most common, descending
                                         3 = most common, ascnding
                                         [any other number] = randomn sorting
     charset-...     --]    0000       which character sets are required in output
                                         1000 = UPPER case characters
                                         0100 = LOWER case characters
                                         0010 = DIGITS
                                         0001 = SPECIAL characters
                                         add the values to gether to use multiple character sets
                                           (ex. 1010 = UPPER and DIGITS)
     output=...	     --]    html        output format : txt, html (coming soon: xml, json)
     ------------
     help=0/1        --]    0          This help message
     verbose=0/1     --]    1          Make output more verbose
     ------------
     gettypes=0/1    --]    0          display a list of possible word types that are available to use
     getsubtypes=0/1 --]    0          display a list of possible word subtypes that are available to use for the specified type
                                         NOTE: you must also specify the \"type\" parameter when using this call
     getstats=0/1    --]    0          display count of entries for each Type
     ------------
     examples:
         (check back later)";
	if ($out == "html") print "</pre>\n";
}

function validate($type, $value) {
	if ($type == "type") {
		if ($type == "") return "passwords";
		return $value;
	}
	if ($type == "subtype") {
		return $value;
	}
	if ($type == "charset") {
		$val2 = "";
                if (preg_match("/^1\d\d\d$/", $value)) { $val2 = "AND `word` REGEXP '[A-Z]' "; }
                if (preg_match("/^\d1\d\d$/", $value)) { $val2 = $val2."AND `word` REGEXP '[a-z]' "; }
                if (preg_match("/^\d\d1\d$/", $value)) { $val2 = $val2."AND `word` REGEXP '[0-9]' "; }
                if (preg_match("/^\d\d\d1$/", $value)) { $val2 = $val2."AND `word` REGEXP '[^[:alnum:]]' "; } 
		return $val2;
	}
	if ($type == "count") {
#		if ( is_int($value) && ($value > 1000) ) return 1000;
		if ( is_int($value) && ($value > 0) ) return $value;
		return 10;
	}
	if ($type == "min") {
		if ( is_int($value) && ($value > 0) ) return $value;
		return 0;
	}
	if ($type == "max") {
		if ( is_int($value) && ($value > 0) ) return $value;
		return 256;
	}
	if ($type == "start") {
		return $value.'%';
	}
	if ($type == "end") {
		return '%'.$value;
	}
	if ($type == "sub") {
		return '%'.$value.'%';
	}
	if ($type == "sort") {
		if ($value === 0) return "`word` DESC";
		if ($value === 1) return "`word` ASC";
		if ($value === 2) return "`count` DESC";
		if ($value === 3) return "`count` ASC";
		return "RAND()";
	}
	if ($type == "out") {
		if ( ($value != "html") &&
		     ($value != "xml") &&
		     ($value != "json") &&
		     ($value != "txt") ) return "html";
		return $value;
	}
	if ($type == "showcount") {
		if ( is_int($value) ) return $value;
		return 0;
	}
	if ($type == "verbose") {
		if ( is_int($value) ) return $value;
		return 1;
	}
}

function get_stats($verbose, $out) {
        global $mysqli;

	$out = validate("out", $out);
	$verbose = validate("verbose", $verbose);

        $result = $mysqli->query("SELECT `type`, count(*) AS 'cnt' FROM `cache` GROUP BY `type`");
	format_output("title", $out, "Current Stats per Type:", $verbose);
        while ($row = $result->fetch_row()) {
		format_output("word", $out, $row[0]."  ".$row[1], $verbose);
        }
        $result->close();
}

function get_types_raw() {
        global $mysqli;

	$list = array();

        $result = $mysqli->query("SELECT `type` FROM `cache` GROUP BY `type`");
	while ($row = $result->fetch_row()) {
		array_push($list, $row[0]);
        }
	$result->close();
	return $list;
}

function get_types($verbose, $out) {
        global $mysqli;

	$out = validate("out", $out);
	$verbose = validate("verbose", $verbose);

        $result = $mysqli->query("SELECT `type` FROM `cache` GROUP BY `type`");
	format_output("title", $out, "Known Types:", $verbose);
        while ($row = $result->fetch_row()) {
		format_output("word", $out, $row[0], $verbose);
        }
        $result->close();
}

function get_subtypes($type, $verbose, $out) {
        global $mysqli;

	$type = validate("type", $type);
	$verbose = validate("verbose", $verbose);
	$out = validate("out", $out);

        $query = "SELECT `subtype` FROM `cache` WHERE `type` = ? AND `subtype` != '' GROUP BY `subtype`";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s',$type);
        $stmt->execute();
        $result = $stmt->get_result();

	format_output("title", $out, "Known SubTypes for Type [".$type."]: (All Types have a default [blank] Subtype)", $verbose);
        while ($row = $result->fetch_row()) {
		format_output("word", $out, $row[0], $verbose);
        }
        $result->close();
        $stmt->close();
}

function format_output($part, $type, $value, $verbose) {
	if ($type == "html") {
		if ($part == "start") { print "<br>\n"; }
		if ($part == "title") { if ($verbose == 1) print "\n----------------------------------------------<br>\n".$value."<br><br>\n"; }
		if ($part == "word") { print htmlspecialchars($value)."<br>\n"; }
		if ($part == "end") { print ""; }
	}
	if ($type == "xml") {
		if ($part == "start") { }
		if ($part == "title") { }
		if ($part == "word") { }
		if ($part == "end") { }
	}
	if ($type == "json") {
		if ($part == "start") { }
		if ($part == "title") { }
		if ($part == "word") { }
		if ($part == "end") { }
	}
	if ($type == "txt") {
		if ($part == "start") { }
		if ($part == "title") { if ($verbose == 1) print "\n----------------------------------------------\n".$value."\n\n"; }
		if ($part == "word") { print $value."\n"; }
		if ($part == "end") { }
	}
}

function getList($type, $subtype, $count, $min, $max, $start, $end, $sub, $sort, $charset, $verbose, $showcount, $out) {
        global $mysqli;

	$type = validate("type", $type);
	$subtype = validate("subtype", $subtype);
	$count = validate("count", $count);
	$min = validate("min", $min);
	$max = validate("max", $max);
	$start = validate("start", $start);
	$end = validate("end", $end);
	$sub = validate("sub", $sub);
	$sort = validate("sort", $sort);
	$verbose = validate("verbose", $verbose);
	$out = validate("out", $out);
	$charset = validate("charset", $charset);

	$query = "";
	if ($showcount == "") {
		$query = 'SELECT `word`, `count` FROM `cache` WHERE `type` = ? AND `length` >= ? AND `length` <= ? AND `word` LIKE ? AND `word` LIKE ? AND `word` LIKE ? '.$charset.' GROUP BY `word` ORDER BY '.$sort.' LIMIT ?';
	} else {
		$query = 'SELECT `word`, `count` FROM `cache` WHERE `type` = ? AND `subtype` = ? AND `length` >= ? AND `length` <= ? AND `word` LIKE ? AND `word` LIKE ? AND `word` LIKE ? '.$charset.' GROUP BY `word` ORDER BY '.$sort.' LIMIT ?';
	}
        $stmt = $mysqli->prepare($query);
	if ($subtype == "") {
	        $stmt->bind_param('siisssi',$type,$min,$max,$start,$end,$sub,$count);
	} else {
	        $stmt->bind_param('ssiisssi',$type,$subtype,$min,$max,$start,$end,$sub,$count);
	}
        $stmt->execute();
        $result = $stmt->get_result();

	if ($result->num_rows == 0) return;

	format_output("title", $out, "[".$count."] words of type [".$type."]", $verbose);
        while ($row = $result->fetch_row()) {
		if ($showcount == 0) {
			format_output("word", $out, $row[0], $verbose);
		} else {
			format_output("word", $out, "[".$row[1]."] ".$row[0], $verbose);
		}
        }
        $result->close();
        $stmt->close();

        return;
}

?>
