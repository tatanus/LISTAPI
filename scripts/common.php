<?

include "../scripts/error_reporting.php";

date_default_timezone_set('America/New_York');

require_once('../libs/class.cache.php');

$SITE_NAME = 'list.ExploitSearch.net';
$SITE_NAME_LONG = 'list.ExploitSearch.net';
$SITE_URL = 'http://list.exploitsearch.net';
$SITE_LINK = '<a href="'.$SITE_URL.'">'.$SITE_NAME.'</a>';

# #################################################
#
# ERROR HANDLER
#
# #################################################

function customError($errno, $errstr, $errfile, $errline, $errcontext) {
	# TODO: Write custom ERROR code
}

# #################################################
#
# UTIL FUNCTIONS
#
# #################################################


# #################################################
#
# STRING FUNCTIONS
#
# #################################################

#cleans up INPUT
function sanitize($input) {
	global $mysqli;
	if (is_array($input)) {
		foreach($input as $var=>$val) {
			$output[$var] = sanitize($val);
		}
	} else {
		if (get_magic_quotes_gpc()) {
			$input = stripslashes($input);
		}
		$input  = strip_tags($input);
		$output = $mysqli->real_escape_string($input);
	}
	return $output;
}

?>
