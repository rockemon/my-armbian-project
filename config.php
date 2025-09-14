<?php
$host = '127.0.0.1';
$user = 'sawituser';
$pass = 'passwordku';
$db   = 'db_sawit';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
