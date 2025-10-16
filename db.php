<?php
$host = 'db';
$user = 'schnitzel';
$pass = 'jagdpass';
$db = 'schnitzeljagd';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
?>