<?php
session_start();
if (!isset($_SESSION['status_login'])) { header("Location: index.php"); exit(); }
include 'koneksi.php';

$tgl = date('Y-m-d');

// Mengambil data dengan pengaman agar tidak Fatal Error
$q_antrian = mysqli_query($conn, "SELECT COUNT(*) as total FROM antrian WHERE tanggal='$tgl'");
$total_antrian = $q_antrian ? mysqli_fetch_assoc($q_antrian)['total'] : 0;

$q_pasien = mysqli_query($conn, "SELECT COUNT(*) as total FROM pasien");
$total_pasien = $q_pasien ? mysqli_fetch_assoc($q_pasien)['total'] : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Klinik Amin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e3f2fd;
            /* Background alat medis */
            background-image: url('https://www.transparenttextures.com/patterns/medical-icons.png');
            /* Animasi bergerak atas bawah */
            animation: gerakBackground 15s ease-in-out infinite alternate;
        }
        @keyframes gerakBackground {
            from { background-position: 0px 0px; }
            to { background-position: 0px 100px; }
        }
        .konten-kaca {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="dashboard.php">🏥 Klinik Amin</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="kelola_antrian.php">Kelola Antrian</a></li>
                    <li class="nav-item"><a class="nav-link" href="data_pasien.php">Data Pasien</a></li>
                    <li class="nav-item"><a class="nav-link" href="tentang.php">Tentang Klinik</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="navbar-text text-white me-3">Halo, <strong><?php echo $_SESSION['username']; ?></strong>!</span>
                    <a href="logout.php" class="btn btn-danger btn-sm fw-bold">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="konten-kaca text-center">
            <h2 class="fw-bold mb-4">Dashboard Utama</h2>
            <div class="row justify-content-center">
                <div class="col-md-5 mb-3">
                    <div class="card bg-info text-white shadow border-0 rounded-4 p-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Antrian Hari Ini</h5>
                            <h1 class="display-4 fw-bold"><?php echo $total_antrian; ?></h1>
                            <a href="kelola_antrian.php" class="btn btn-light text-info fw-bold mt-2 rounded-pill">Lihat Detail ➔</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <div class="card bg-success text-white shadow border-0 rounded-4 p-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Rekam Medis Pasien</h5>
                            <h1 class="display-4 fw-bold"><?php echo $total_pasien; ?></h1>
                            <a href="data_pasien.php" class="btn btn-light text-success fw-bold mt-2 rounded-pill">Lihat Detail ➔</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 