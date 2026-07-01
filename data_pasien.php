<?php
session_start();
if (!isset($_SESSION['status_login'])) { header("Location: index.php"); exit(); }
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM pasien ORDER BY tanggal_periksa DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pasien - Klinik Amin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e3f2fd;
            background-image: url('https://www.transparenttextures.com/patterns/medical-icons.png');
            animation: gerakBackground 15s ease-in-out infinite alternate;
        }
        @keyframes gerakBackground { from { background-position: 0px 0px; } to { background-position: 0px 100px; } }
        .konten-kaca { background: rgba(255, 255, 255, 0.95); border-radius: 15px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
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
                    <li class="nav-item"><a class="nav-link active" href="data_pasien.php">Data Pasien</a></li>
                    <li class="nav-item"><a class="nav-link" href="tentang.php">Tentang Klinik</a></li>
                </ul>
                <a href="logout.php" class="btn btn-danger btn-sm fw-bold">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5 mb-5">
        <div class="konten-kaca">
            <h3 class="fw-bold mb-4 text-center text-primary">Riwayat Data Pasien</h3>
            
            <div class="row mb-3 justify-content-end">
                <div class="col-md-4">
                    <input type="text" id="inputPencarian" class="form-control form-control-lg shadow-sm border-primary" placeholder="🔍 Cari nama atau penyakit..." autocomplete="off">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered bg-white">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>History Sakit (Keluhan)</th>
                            <th>Jenis Penyakit (Diagnosa)</th>
                            <th>Tanggal Periksa</th>
                        </tr>
                    </thead>
                    <tbody id="tabelPasien">
                        <?php $no = 1; while($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td class="text-center fw-bold"><?php echo $no++; ?></td>
                            <td class="fw-bold text-primary"><?php echo $row['nama_pasien']; ?></td>
                            <td><?php echo $row['riwayat_sakit']; ?></td>
                            <td class="text-center"><span class="badge bg-danger rounded-pill px-3 py-2"><?php echo $row['jenis_penyakit']; ?></span></td>
                            <td class="text-center"><?php echo $row['tanggal_periksa']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('inputPencarian').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#tabelPasien tr');

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
</body>
</html>