<?php
require 'config.php';
// Ambil data agregat
$sql = "SELECT IFNULL(SUM(berat_bersih * harga_per_kg),0) AS total_pendapatan, IFNULL(SUM(berat_bersih),0) AS total_berat FROM panen";
$res = $conn->query($sql);
$data = $res->fetch_assoc();

// Ambil data grafik pertumbuhan tonase
$sql_chart = "SELECT tanggal_panen, SUM(berat_bersih) AS berat_bersih FROM panen GROUP BY tanggal_panen ORDER BY tanggal_panen ASC";
$res_chart = $conn->query($sql_chart);
$labels = [];
$values = [];
while ($row = $res_chart->fetch_assoc()) {
    $labels[] = date('d M', strtotime($row['tanggal_panen']));
    $values[] = round($row['berat_bersih'], 2);
}
$conn->close();
function rupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Panen Sawit</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="grey lighten-4">
    <nav class="green darken-2">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center">Kalkulator Panen Sawit</a>
            <ul class="right">
                <li><a href="riwayat.php"><i class="material-icons">history</i></a></li>
            </ul>
        </div>
    </nav>
    <div class="container" style="margin-top:40px;">
        <div class="row">
            <div class="col s12 m6">
                <div class="card z-depth-3 center-align" style="border-radius:18px;">
                    <div class="card-content">
                        <span class="card-title"><i class="material-icons large green-text">monetization_on</i></span>
                        <h5 style="font-weight:500;">Total Pendapatan Bersih</h5>
                        <h4 class="green-text" style="font-size:2.2rem; font-weight:700; letter-spacing:1px;"><?= rupiah($data['total_pendapatan']) ?></h4>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card z-depth-3 center-align" style="border-radius:18px;">
                    <div class="card-content">
                        <span class="card-title"><i class="material-icons large orange-text">scale</i></span>
                        <h5 style="font-weight:500;">Total Berat Bersih</h5>
                        <h4 class="orange-text" style="font-size:2.2rem; font-weight:700; letter-spacing:1px;"><?= number_format($data['total_berat'], 2, ',', '.') ?> kg</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="card z-depth-3" style="border-radius:18px; padding:24px 16px;">
                    <div class="card-content">
                        <h5 class="center-align" style="font-weight:500; margin-bottom:24px;">Grafik Pertumbuhan Tonase Panen</h5>
                        <canvas id="grafikTonase" height="120"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn">
        <a href="input.php" class="btn-floating btn-large red">
            <i class="material-icons">add</i>
        </a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart.js
        const ctx = document.getElementById('grafikTonase').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($labels) ?>,
                datasets: [{
                    label: 'Tonase (kg)',
                    data: <?= json_encode($values) ?>,
                    borderColor: '#43a047',
                    backgroundColor: 'rgba(67,160,71,0.08)',
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#43a047',
                    pointRadius: 4,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#888', font: { weight: 500 } }
                    },
                    y: {
                        grid: { color: 'rgba(67,160,71,0.1)' },
                        ticks: { color: '#43a047', font: { weight: 500 } }
                    }
                }
            }
        });
    });
    </script>
</body>
</html>
