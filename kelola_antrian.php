<?php
session_start();
if (!isset($_SESSION['status_login'])) { header("Location: index.php"); exit(); }
include 'koneksi.php';

$tgl = date('Y-m-d');

// 1. CREATE
if (isset($_POST['tambah_antrian'])) {
    $nama = $_POST['nama_pasien'];
    $q_max = mysqli_query($conn, "SELECT MAX(nomor_antrian) as max_nomor FROM antrian WHERE tanggal='$tgl'");
    $max_data = mysqli_fetch_assoc($q_max);
    $nomor_baru = $max_data['max_nomor'] ? $max_data['max_nomor'] + 1 : 1;

    mysqli_query($conn, "INSERT INTO antrian (nama_pasien, nomor_antrian, status, tanggal) VALUES ('$nama', '$nomor_baru', 'menunggu', '$tgl')");
    header("Location: kelola_antrian.php");
    exit();
}

// 2. UPDATE & DELETE
if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $aksi = $_GET['aksi'];

    if ($aksi == 'panggil') {
        mysqli_query($conn, "UPDATE antrian SET status='selesai' WHERE status='dipanggil' AND tanggal='$tgl'");
        mysqli_query($conn, "UPDATE antrian SET status='dipanggil' WHERE id_antrian='$id'");
    } elseif ($aksi == 'selesai') {
        mysqli_query($conn, "UPDATE antrian SET status='selesai' WHERE id_antrian='$id'");
    } elseif ($aksi == 'hapus') {
        mysqli_query($conn, "DELETE FROM antrian WHERE id_antrian='$id'");
    }
    header("Location: kelola_antrian.php");
    exit();
}

$q_saat_ini = mysqli_query($conn, "SELECT COUNT(*) as jml FROM antrian WHERE status='dipanggil' AND tanggal='$tgl'");
$saat_ini = $q_saat_ini ? mysqli_fetch_assoc($q_saat_ini)['jml'] : 0;

$q_sisa = mysqli_query($conn, "SELECT COUNT(*) as jml FROM antrian WHERE status='menunggu' AND tanggal='$tgl'");
$sisa = $q_sisa ? mysqli_fetch_assoc($q_sisa)['jml'] : 0;

$q_selesai = mysqli_query($conn, "SELECT COUNT(*) as jml FROM antrian WHERE status='selesai' AND tanggal='$tgl'");
$selesai = $q_selesai ? mysqli_fetch_assoc($q_selesai)['jml'] : 0;

$data_antrian = mysqli_query($conn, "SELECT * FROM antrian WHERE tanggal='$tgl' ORDER BY nomor_antrian ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Antrian - Klinik Amin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            /* Dominan putih bersih dengan sapuan biru muda (Light Blue RGB) */
            background: linear-gradient(-45deg, #ffffff, #f0f8ff, #ffffff, #e1f5fe);
            background-size: 400% 400%;
            animation: gerakGradient 15s ease infinite;
            min-height: 100vh;
        }
        
        @keyframes gerakGradient { 
            0% { background-position: 0% 50%; } 
            50% { background-position: 100% 50%; } 
            100% { background-position: 0% 50%; } 
        }
        
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="dashboard.php">🏥 Klinik Amin</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="kelola_antrian.php">Kelola Antrian</a></li>
                    <li class="nav-item"><a class="nav-link" href="data_pasien.php">Data Pasien</a></li>
                    <li class="nav-item"><a class="nav-link" href="tentang.php">Tentang Klinik</a></li>
                </ul>
                <a href="logout.php" class="btn btn-danger btn-sm fw-bold">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        <div class="konten-kaca">
            <h2 class="fw-bold mb-4 text-center">Antrian Hari Ini</h2>
            
            <div class="row text-center mb-5">
                <div class="col-md-4"><div class="card border-primary shadow-sm rounded-4"><div class="card-header bg-primary text-white fw-bold">Dipanggil</div><div class="card-body"><h1 class="display-4 fw-bold text-primary" id="angka-dipanggil"><?php echo $saat_ini; ?></h1></div></div></div>
                <div class="col-md-4"><div class="card border-warning shadow-sm rounded-4"><div class="card-header bg-warning text-dark fw-bold">Menunggu</div><div class="card-body"><h1 class="display-4 fw-bold text-warning"><?php echo $sisa; ?></h1></div></div></div>
                <div class="col-md-4"><div class="card border-success shadow-sm rounded-4"><div class="card-header bg-success text-white fw-bold">Selesai</div><div class="card-body"><h1 class="display-4 fw-bold text-success"><?php echo $selesai; ?></h1></div></div></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 bg-light rounded-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-primary mb-3">➕ Tambah</h5>
                            <form method="POST">
                                <div class="mb-3">
                                    <input type="text" name="nama_pasien" class="form-control" placeholder="Nama pasien..." required autocomplete="off">
                                </div>
                                <button type="submit" name="tambah_antrian" class="btn btn-primary w-100 fw-bold">Ambil Nomor</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <h4 class="fw-bold mb-3 text-secondary">Daftar Pasien</h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered bg-white text-center align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pasien</th>
                                    <th>Status</th>
                                    <th>Aksi Kontrol</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(mysqli_num_rows($data_antrian) > 0) {
                                    while($row = mysqli_fetch_assoc($data_antrian)): 
                                        $nomor_format = sprintf("A%03d", $row['nomor_antrian']);
                                ?>
                                <tr>
                                    <td><h4 class="fw-bold m-0 text-primary"><?php echo $nomor_format; ?></h4></td>
                                    <td class="fw-bold"><?php echo $row['nama_pasien']; ?></td>
                                    <td>
                                        <?php 
                                            if($row['status'] == 'menunggu') { echo "<span class='badge bg-warning text-dark px-3 py-2'>Menunggu</span>"; }
                                            elseif($row['status'] == 'dipanggil') { echo "<span class='badge bg-primary px-3 py-2'>Dipanggil</span>"; }
                                            else { echo "<span class='badge bg-success px-3 py-2'>Selesai</span>"; }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="cetak.php?id=<?php echo $row['id_antrian']; ?>" target="_blank" class="btn btn-sm btn-info fw-bold text-white me-1">🖨️ Cetak</a>
                                        
                                        <?php if($row['status'] == 'menunggu'): ?>
                                            <button onclick="panggilLangsung(<?php echo $row['id_antrian']; ?>, '<?php echo $nomor_format; ?>', '<?php echo htmlspecialchars($row['nama_pasien'], ENT_QUOTES); ?>')" class="btn btn-sm btn-success fw-bold">📢 Panggil</button>
                                        <?php elseif($row['status'] == 'dipanggil'): ?>
                                            <a href="kelola_antrian.php?aksi=selesai&id=<?php echo $row['id_antrian']; ?>" class="btn btn-sm btn-secondary fw-bold">✔️ Selesai</a>
                                        <?php endif; ?>
                                        
                                        <a href="kelola_antrian.php?aksi=hapus&id=<?php echo $row['id_antrian']; ?>" class="btn btn-sm btn-danger fw-bold ms-1" onclick="return confirm('Batal?')">🗑️ Batal</a>
                                    </td>
                                </tr>
                                <?php endwhile; } else { echo "<tr><td colspan='4' class='text-muted py-4'>Belum ada antrian.</td></tr>"; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Memuat daftar suara (voices) ke browser terlebih dahulu
        window.speechSynthesis.onvoiceschanged = function() {
            window.speechSynthesis.getVoices();
        };

        function panggilLangsung(id_pasien, no_antrian, nama_pasien) {
    document.getElementById('angka-dipanggil').innerText = "🔊...";
    
    // Ambil huruf depan, misalnya "A"
    let huruf = no_antrian.charAt(0);
    
    // Ambil sisa angkanya saja, misalnya "003" (tanpa diubah jadi angka murni)
    let angkaString = no_antrian.substring(1); 
    
    // Pisahkan "003" menjadi "0, 0, 3" agar dieja satu-satu oleh robot
    let angkaDieja = angkaString.split('').join(', ');
    
    // (Opsional) Ubah pembacaan angka "0" menjadi "kosong" agar lebih natural di telinga orang Indonesia
    angkaDieja = angkaDieja.replace(/0/g, 'kosong');
    
    const teksPanggilan = `Nomor antrian, ${huruf}, ${angkaDieja}, atas nama, ${nama_pasien}. Silakan menuju ke ruangan dokter Jasmine.`;
    
    let speech = new SpeechSynthesisUtterance(teksPanggilan);
    speech.lang = 'id-ID'; 
    speech.rate = 0.9;     
    
    let voices = window.speechSynthesis.getVoices();
    let voiceIndo = voices.find(voice => voice.lang === 'id-ID' || voice.lang === 'id_ID');
    let femaleIndo = voices.find(voice => (voice.lang === 'id-ID' || voice.lang === 'id_ID') && !voice.name.toLowerCase().includes('male'));
    
    if (femaleIndo) {
        speech.voice = femaleIndo;
    } else if (voiceIndo) {
        speech.voice = voiceIndo; 
    }
    
    speech.onend = function() {
        window.location.href = "kelola_antrian.php?aksi=panggil&id=" + id_pasien;
    };
    
    window.speechSynthesis.speak(speech);
}
        
    </script>
</body>
</html>