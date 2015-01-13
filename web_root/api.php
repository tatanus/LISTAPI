<?php
include "../scripts/error_reporting.php";
include "../scripts/ratelimiter.php";

$rateLimiter = new RateLimiter(new Memcache(), $_SERVER["REMOTE_ADDR"]);
try {
    // allow a maximum of 100 requests for the IP in 5 minutes
    $rateLimiter->limitRequestsInMinutes(100, 5);
} catch (RateExceededException $e) {
#    echo "Too Many Requests - API calls are limited to 100 every 5 minutes";
    header("HTTP/1.0 529 Too Many Requests - API calls are limited to 100 every 5 minutes");
    exit;
}

include "../scripts/db.php";
set_error_handler("customError");
include "../scripts/search.php";
include "../scripts/get_params.php";
$out = validate("out", $list_output);
$verbose = validate("out", $list_verbose);
if ($out == "html") { include "../scripts/header.php"; }
format_output("start", $list_output, "", $verbose);
if ($list_help != 0) echo "<center>All API calls must start with: <pre>http://list.exploitsearch.net/api?</pre></center>";
if ($list_help != 0) display_help($list_output);
else {
	if ($list_getstats != 0) get_stats($list_verbose, $list_output);
	if ($list_gettypes != 0) get_types($list_verbose, $list_output);
	if ($list_getsubtypes != 0) get_subtypes($list_type, $list_verbose, $list_output);
	getList($list_type, $list_subtype, $list_count, $list_minlen, $list_maxlen, $list_startstr, $list_endstr, $list_substr, $list_sort, $list_charset, $list_verbose, $list_showcount, $list_output);
}
format_output("end", $list_output, "", $verbose);
if ($out == "html") { include "../scripts/footer.php"; }
?>
