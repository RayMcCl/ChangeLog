<?
$servername = "YOURIP";
$username = "YOURUSER";
$password = "YOURPASS";
$dbname = "YOURDBNAME";

// Create connection

$conn = new PDO("mysql:host=".$servername.";dbname=".$dbname.";", $username, $password);
?>
