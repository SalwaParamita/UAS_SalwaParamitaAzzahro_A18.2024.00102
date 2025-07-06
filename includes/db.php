<?php
date_default_timezone_set('Asia/Jakarta');

$servername = "sql108.infinityfree.com";
$username = "if0_39405871";
$password = "KT5qEu3YPeUN";
$db = "if0_39405871_rate_it_up_latihan";

//create connection
$conn = new mysqli($servername, $username, $password, $db);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo "Connected successfully<hr>";
?>
hj