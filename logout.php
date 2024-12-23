<?php
// Memulai sesi
session_start();

// Menghancurkan semua data sesi
session_destroy();

// Mengarahkan pengguna kembali ke halaman login
header('Location: login.php');
?>
