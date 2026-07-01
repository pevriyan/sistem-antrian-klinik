<?php
session_start();
session_destroy(); // Menghapus semua sesi login
header("Location: index.php"); // Mengarahkan kembali ke halaman login
exit();
?>