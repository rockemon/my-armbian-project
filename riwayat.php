<?php
require 'config.php';
$sql = "SELECT * FROM panen ORDER BY tanggal_panen DESC, id DESC";
$res = $conn->query($sql);
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
    <title>Riwayat Panen Sawit</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="grey lighten-4">
    <nav class="green darken-2">
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo center">Riwayat Panen</a>
        </div>
    </nav>
    <div class="container" style="margin-top:40px;">
        <ul class="collection with-header">
            <li class="collection-header"><h5>Riwayat Panen</h5></li>
            <?php if ($res->num_rows > 0): ?>
                <?php while($row = $res->fetch_assoc()): ?>
                    <li class="collection-item avatar">
                        <i class="material-icons circle green">calendar_today</i>
                        <span class="title"><b><?= date('d M Y', strtotime($row['tanggal_panen'])) ?></b></span>
                        <p>
                            Berat Bersih: <b><?= number_format($row['berat_bersih'],2,',','.') ?> kg</b><br>
                            Harga/kg: <b><?= rupiah($row['harga_per_kg']) ?></b><br>
                            Pendapatan Bersih: <b class="green-text"><?= rupiah($row['berat_bersih'] * $row['harga_per_kg']) ?></b>
                        </p>
                        <span class="secondary-content"><i class="material-icons">scale</i></span>
                    </li>
                <?php endwhile; ?>
            <?php else: ?>
                <li class="collection-item">Belum ada data panen.</li>
            <?php endif; ?>
        </ul>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
