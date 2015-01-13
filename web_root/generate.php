<?
include "../scripts/error_reporting.php";
include "../scripts/db.php";
set_error_handler("customError");
include "../scripts/get_params.php";


$upper = 0;
if (isset($_GET['upper'])) {
	if ($_GET['upper'] == "1") { $upper = "1"; }
}
$lower = 0;
if (isset($_GET['lower'])) {
	if ($_GET['lower'] == "1") { $lower = "1"; }
}
$digit = 0;
if (isset($_GET['digits'])) {
	if ($_GET['digits'] == "1") { $digit = "1"; }
}
$special = 0;
if (isset($_GET['special'])) {
	if ($_GET['special'] == "1") { $special = "1"; }
}
$charset=$upper.$lower.$digit.$special;

header('Location: http://list.exploitsearch.net/api?type='.$list_type.'&count='.$list_count.'&minlen='.$listminlen.'&maxlen='.$maxlen.'&startstr='.$list_startstr.'&endstr='.$list_endstr.'&substr='.$list_substr.'&charset='.$charset.'&sort='.$list_sortgui);
?>
