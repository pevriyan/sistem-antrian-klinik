<?php
session_start();
if (!isset($_SESSION['status_login'])) { header("Location: index.php"); exit(); }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tentang Klinik - Klinik Amin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e3f2fd;
            background-image: url('https://www.transparenttextures.com/patterns/medical-icons.png');
            animation: gerakBackground 15s ease-in-out infinite alternate;
        }
        @keyframes gerakBackground { from { background-position: 0px 0px; } to { background-position: 0px 100px; } }
        .konten-kaca { background: rgba(255, 255, 255, 0.95); border-radius: 15px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="dashboard.php">🏥 Klinik Amin</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="kelola_antrian.php">Kelola Antrian</a></li>
                    <li class="nav-item"><a class="nav-link" href="data_pasien.php">Data Pasien</a></li>
                    <li class="nav-item"><a class="nav-link active" href="tentang.php">Tentang Klinik</a></li>
                </ul>
                <a href="logout.php" class="btn btn-danger btn-sm fw-bold">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row konten-kaca align-items-center mx-2">
            <div class="col-md-4 text-center mb-4 mb-md-0">
            <img src="profil.jpg.jpeg" alt="Profil Klinik" class="img-fluid rounded shadow border border-4 border-primary">
                <h4 class="fw-bold mt-4 text-primary">dr. Jasmine</h4>
                <p class="text-muted fw-semibold">Dokter Umum & Kepala Klinik</p>
            </div>
            <div class="col-md-8">
                <h2 class="fw-bold mb-4 text-dark border-bottom pb-2">Tentang dr. Jasmine</h2>
                <p style="text-align: justify; line-height: 1.8; font-size: 1.05rem;" class="text-secondary">
                    dr. Jasmine adalah seorang dokter umum berprestasi yang merupakan kebanggaan lulusan Fakultas Kedokteran Universitas Mataram (UNRAM). Selama masa studinya, beliau dikenal sebagai mahasiswi yang cemerlang dan aktif dalam berbagai penelitian medis, yang membawanya meraih predikat sebagai salah satu lulusan terbaik. Dedikasi tingginya pada dunia kesehatan sudah terlihat sejak di bangku kuliah, dengan fokus utama pada pelayanan medis yang tulus, akurat, dan berbasis bukti ilmiah (<i>evidence-based medicine</i>).
                </p>
                <p style="text-align: justify; line-height: 1.8; font-size: 1.05rem;" class="text-secondary">
                    Di Klinik Amin, dr. Jasmine memadukan ilmu kedokteran modern dengan pendekatan yang sangat humanis. Beliau sangat memahami bahwa kesembuhan pasien tidak hanya berasal dari resep obat, melainkan juga dari komunikasi yang baik dan rasa nyaman. Oleh karena itu, dr. Jasmine selalu meluangkan waktu untuk mendengarkan setiap keluhan pasien dengan penuh empati. Dengan keahlian penanganan penyakit umum hingga pencegahan penyakit kronis, beliau berkomitmen menjadikan Klinik Amin sebagai fasilitas kesehatan yang terpercaya dan bersahabat bagi seluruh masyarakat.
                </p>
            </div>
        </div>
    </div>
</body>
</html>