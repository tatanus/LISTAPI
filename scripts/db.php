<?
include "../scripts/error_reporting.php";

$mysql_database = 'DBNAME';
$mysql_user = 'DBUSER';
$mysql_password = 'DBPASSWORD'; 
$mysql_host = 'DBHOST';

$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
if ($mysqli->connect_errno)
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
?>
