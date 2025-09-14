
# Kalkulator Panen Sawit

Minimalist web app for recording and calculating net income from palm oil harvests. Built with PHP, MySQL, and Materialize CSS. Optimized for mobile and modern UI.

## Fitur
- Dashboard dengan total pendapatan dan berat bersih
- Grafik pertumbuhan tonase panen
- Input data panen (berat, harga, tanggal)
- Riwayat panen
- Dummy data otomatis (panen setiap dua minggu)

## Struktur File

```
├── index.php         # Dashboard
├── input.php         # Form input panen
├── riwayat.php       # Riwayat panen
├── config.php        # Koneksi database
├── simpan_panen.php  # Backend simpan data
├── dummy_panen.php   # Generate dummy data
└── assets/
	└── css/
		└── style.css # Custom style
```

## Cara Menjalankan
1. Pastikan PHP dan MySQL sudah terinstall
2. Buat database dan tabel sesuai instruksi di dummy_panen.php
3. Jalankan server PHP:
   ```bash
   php -S 0.0.0.0:8080
   ```
4. Akses di browser: http://localhost:8080/

## Lisensi
MIT
