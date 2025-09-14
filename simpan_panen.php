<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $berat_kotor   = $_POST['berat_kotor'] ?? 0;
    $harga_per_kg  = $_POST['harga_per_kg'] ?? 0;
    $berat_bersih  = $_POST['berat_bersih'] ?? 0;
    $tanggal_panen = $_POST['tanggal_panen'] ?? date('Y-m-d');

    $stmt = $conn->prepare("INSERT INTO panen (tanggal_panen, berat_kotor, harga_per_kg, berat_bersih) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sidi", $tanggal_panen, $berat_kotor, $harga_per_kg, $berat_bersih);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header('Location: index.php');
    exit;
} else {
    header('Location: input.php');
    exit;
}
