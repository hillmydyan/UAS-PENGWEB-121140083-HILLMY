<?php
session_start();
include 'koneksi.php'; // Koneksi ke database

// Pastikan hanya pengguna yang login dapat mengakses
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Ambil data pengguna dari sesi
$username = $_SESSION['username'];
$role = $_SESSION['role']; // admin atau user
$user_id = $_SESSION['user_id']; // ID pengguna

// Tambah Data
if (isset($_POST['tambah'])) {
    if ($role != 'admin') {
        echo "Hanya admin yang dapat menambah data.";
        exit();
    }
    
    $nama_barang = $_POST['nama_barang'];
    $kode_huruf = $_POST['kode_huruf'];
    
    $query = "INSERT INTO tb_barang1 (nama_barang, kode_huruf, created_by) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $nama_barang, $kode_huruf, $user_id);
    
    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo "Gagal menambah data: " . $stmt->error;
    }
}

// Edit Data
if (isset($_POST['edit'])) {
    if ($role != 'admin') {
        echo "Hanya admin yang dapat mengedit data.";
        exit();
    }
    
    $id = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $kode_huruf = $_POST['kode_huruf'];
    
    $query = "UPDATE tb_barang1 SET nama_barang = ?, kode_huruf = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $nama_barang, $kode_huruf, $id);
    
    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo "Gagal mengedit data: " . $stmt->error;
    }
}

// Hapus Data
if (isset($_GET['hapus'])) {
    if ($role != 'admin') {
        echo "Hanya admin yang dapat menghapus data.";
        exit();
    }
    
    $id = $_GET['hapus'];
    
    $query = "DELETE FROM tb_barang1 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    
    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo "Gagal menghapus data: " . $stmt->error;
    }
}
?>
