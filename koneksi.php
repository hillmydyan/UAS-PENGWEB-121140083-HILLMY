<?php
// Informasi koneksi database
$host = 'localhost';        // Alamat host, biasanya 'localhost' jika database ada di server yang sama
$username = 'root';         // Username database (default untuk MySQL adalah 'root')
$password = '';             // Password untuk username (kosong secara default pada beberapa instalasi MySQL lokal)
$database = 'db_nhjaya';    // Nama database yang ingin dihubungkan

// Membuat koneksi ke database MySQL menggunakan mysqli_connect
$conn = mysqli_connect($host, $username, $password, $database);

// Mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    // Jika gagal, hentikan eksekusi dengan pesan error
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
