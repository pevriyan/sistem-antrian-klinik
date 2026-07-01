<?php
session_start();
if (!isset($_SESSION['status_login'])) { header("Location: index.php"); exit(); }
include 'koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM antrian WHERE id_antrian='$id'");
    $data = mysqli_fetch_assoc($query);
    $nomor_format = sprintf("A%03d", $data['nomor_antrian']);
} else {
    die("Data tidak ditemukan!");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Antrian</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; text-align: center; margin: 0; padding: 20px; background: #fff; }
        .kertas-struk { width: 300px; margin: 0 auto; border: 2px dashed #000; padding: 20px; }
        h2 { margin: 0 0 10px 0; font-size: 24px; }
        .nomor { font-size: 60px; font-weight: bold; margin: 10px 0; border-top: 1px solid #000; border-bottom: 1px solid #000; padding: 10px 0; }
        p { margin: 5px 0; font-size: 14px; }
        @media print {
            body { background: white; }
            .kertas-struk { border: none; }
        }
    </style>
</head>
<body>
    <div class="kertas-struk">
        <h2>🏥 KLINIK AMIN</h2>
        <p>Jl. Kesehatan No. 123</p>
        <p>Tanggal: <?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></p>
        
        <p style="margin-top: 20px;">NOMOR ANTRIAN ANDA:</p>
        <div class="nomor"><?php echo $nomor_format; ?></div>
        
        <p>Atas Nama:</p>
        <h3 style="margin: 5px 0;"><?php echo strtoupper($data['nama_pasien']); ?></h3>
        
        <p style="margin-top: 20px; font-size: 12px;">Mohon tunggu sampai nomor<br>Anda dipanggil.</p>
        <p style="font-size: 12px; margin-top: 10px;">Semoga Lekas Sembuh!</p>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>