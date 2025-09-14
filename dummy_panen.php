<?php
// Script untuk generate dummy data panen sawit setiap dua minggu mulai Januari 2025
require 'config.php';

$user = 'sawituser';
$pass = 'passwordku';
$db = 'db_sawit';
$mysqli = new mysqli('127.0.0.1', $user, $pass, $db);
if ($mysqli->connect_error) die('Koneksi gagal: ' . $mysqli->connect_error);

$start = strtotime('2025-01-01');
$end = strtotime('2025-09-14'); // hari ini
$interval = 14 * 24 * 60 * 60; // dua minggu

for ($tgl = $start; $tgl <= $end; $tgl += $interval) {
    $tanggal_panen = date('Y-m-d', $tgl);
    $berat_kotor = rand(500, 1200) + rand(0,99)/100; // 500-1200kg
    $harga_per_kg = rand(1800, 2500); // harga per kg
    $berat_bersih = $berat_kotor * (rand(85, 95)/100); // 85-95% dari kotor
    $stmt = $mysqli->prepare("INSERT INTO panen (tanggal_panen, berat_kotor, harga_per_kg, berat_bersih) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sidi", $tanggal_panen, $berat_kotor, $harga_per_kg, $berat_bersih);
    $stmt->execute();
    $stmt->close();
}
$mysqli->close();
echo "Dummy data panen berhasil dibuat!";
