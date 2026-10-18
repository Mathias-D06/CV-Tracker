<?php
// Database credentials live in config.php, which is not committed.
// Copy config.example.php to config.php and fill in your own details.
require_once(__DIR__ . '/config.php');
try{
$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}   catch(PDOException $ex) {
echo "Connection failed: " . $ex->getMessage();
exit;
}
?>
