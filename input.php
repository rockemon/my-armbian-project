<?php
$tgl = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Panen Sawit</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="grey lighten-4">
    <nav class="green darken-2">
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo center">Input Panen</a>
        </div>
    </nav>
    <div class="container" style="margin-top:40px;">
        <form action="simpan_panen.php" method="POST" class="card-panel">
            <div class="input-field">
                <i class="material-icons prefix">weight</i>
                <input type="number" name="berat_kotor" id="berat_kotor" required min="0" step="0.01">
                <label for="berat_kotor">Berat Timbangan (kg)</label>
            </div>
            <div class="input-field">
                <i class="material-icons prefix">price_change</i>
                <input type="number" name="harga_per_kg" id="harga_per_kg" required min="0">
                <label for="harga_per_kg">Harga per kg (Rp)</label>
            </div>
            <div class="input-field">
                <i class="material-icons prefix">cut</i>
                <input type="number" name="berat_bersih" id="berat_bersih" required min="0" step="0.01">
                <label for="berat_bersih">Berat Bersih (Setelah Potong)</label>
            </div>
            <div class="input-field">
                <i class="material-icons prefix">calendar_today</i>
                <input type="text" name="tanggal_panen" id="tanggal_panen" class="datepicker" value="<?= $tgl ?>" required>
                <label for="tanggal_panen">Tanggal Panen</label>
            </div>
            <button type="submit" class="btn green waves-effect waves-light">Simpan Data</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');
        M.Datepicker.init(elems, {
            format: 'yyyy-mm-dd',
            defaultDate: new Date('<?= $tgl ?>'),
            setDefaultDate: true,
            autoClose: true
        });
    });
    </script>
</body>
</html>
