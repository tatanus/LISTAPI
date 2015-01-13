<?php
include "../scripts/error_reporting.php";

$list_type = "";
if (isset($_GET['type'])) {
        $list_type = $_GET['type'];
}

$list_subtype = "";
if (isset($_GET['subtype'])) {
        $list_subtype = $_GET['subtype'];
}

$list_count = 0;
if (isset($_GET['count'])) {
        $list_count = intval($_GET['count']);
}

$list_minlen = 0;
if (isset($_GET['minlen'])) {
        $list_minlen = intval($_GET['minlen']);
}

$list_maxlen = 0;
if (isset($_GET['maxlen'])) {
        $list_maxlen = intval($_GET['maxlen']);
}

$list_startstr = "";
if (isset($_GET['startstr'])) {
        $list_startstr = $_GET['startstr'];
}

$list_endstr = "";
if (isset($_GET['endstr'])) {
        $list_endstr = $_GET['endstr'];
}

$list_substr = "";
if (isset($_GET['substr'])) {
        $list_substr = $_GET['substr'];
}

$list_charset = "";
if (isset($_GET['charset'])) {
        $list_charset = $_GET['charset'];
}

$list_sortgui = 0;
if (isset($_GET['sortgui'])) {
        $list_sortgui = intval($_GET['sortgui']);
}

$list_sort = 0;
if (isset($_GET['sort'])) {
        $list_sort = intval($_GET['sort']);
}

$list_output = "";
if (isset($_GET['output'])) {
        $list_output = $_GET['output'];
}

$list_help = 0;
if (isset($_GET['help'])) {
        $list_help = intval($_GET['help']);
}

$list_gettypes = 0;
if (isset($_GET['gettypes'])) {
        $list_gettypes = intval($_GET['gettypes']);
}

$list_getsubtypes = 0;
if (isset($_GET['getsubtypes'])) {
        $list_getsubtypes = intval($_GET['getsubtypes']);
}

$list_getstats = 0;
if (isset($_GET['getstats'])) {
        $list_getstats = intval($_GET['getstats']);
}

$list_verbose = 0;
if (isset($_GET['verbose'])) {
        $list_verbose = intval($_GET['verbose']);
}

$list_showcount = 0;
if (isset($_GET['showcount'])) {
        $list_showcount = intval($_GET['showcount']);
}

?>
