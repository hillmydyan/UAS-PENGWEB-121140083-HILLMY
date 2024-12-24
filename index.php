<?php
// Memulai sesi untuk mengelola data pengguna yang login
session_start([
    'cookie_httponly' => true,
    'cookie_secure' => true,
    'cookie_samesite' => 'Strict',
]);

// Mengimpor file koneksi ke database
include 'koneksi.php';

// Mengecek apakah pengguna sudah login. Jika tidak, arahkan ke halaman login
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect ke halaman login
    exit();
}

// Mendapatkan data dari sesi yang sudah disimpan saat login
$username = $_SESSION['username'] ?? ''; // Nama pengguna
$role = $_SESSION['role'] ?? '';         // Peran pengguna (admin/user)
$user_id = $_SESSION['user_id'] ?? '';   // ID pengguna

// Query data berdasarkan peran pengguna
if ($role == 'admin') {
    // Jika pengguna adalah admin, tampilkan semua data barang
    $query = "SELECT tb_barang1.*, users.username AS created_by_user 
              FROM tb_barang1 
              JOIN users ON tb_barang1.created_by = users.id";
} else {
    // Jika pengguna adalah user biasa, hanya tampilkan data barang yang dibuat oleh pengguna tersebut
    $query = "SELECT tb_barang1.*, users.username AS created_by_user 
              FROM tb_barang1 
              JOIN users ON tb_barang1.created_by = users.id 
              WHERE tb_barang1.created_by = ?";
}

// Mempersiapkan statement untuk mencegah SQL injection
$stmt = $conn->prepare($query);

// Jika peran bukan admin, tambahkan parameter user_id ke query
if ($role != 'admin') {
    $stmt->bind_param("i", $user_id); // Bind parameter user_id ke query
}

// Menjalankan query
$stmt->execute();
$result = $stmt->get_result(); // Mendapatkan hasil query

// Jika query gagal, hentikan eksekusi dengan pesan error
if (!$result) {
    die("Query gagal: " . $conn->error);
}
?>


<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <script src="js/bootstrap.bundle.js"></script> <!-- Bootstrap JavaScript -->
    <link rel="stylesheet" href="datatables/datatables.css"> <!-- DataTables CSS -->
    <script src="datatables/datatables.js"></script> <!-- DataTables JavaScript -->
    <title>TOKO NH JAYA</title> <!-- Judul halaman -->
</head>

<body>
    <!-- Navigasi utama -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TOKO NH JAYA</a> <!-- Nama toko -->
        </div>
    </nav>


<div class="container mt-4">
    <figure class="text-center">
        <blockquote class="blockquote">
            <!-- Judul dashboard, dinamis berdasarkan peran pengguna -->
            <h1>Dashboard <?php echo $role == 'admin' ? 'Admin' : 'User'; ?></h1>
        </blockquote>
    </figure>

    <!-- Tombol Tambah Barang hanya untuk Admin -->
    <?php if ($role == 'admin'): ?>
        <a href="form.php" class="btn btn-primary mb-3">Tambah Barang</a>
    <?php endif; ?>


    <div class="table-responsive">
        <table id="dt" class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">NO</th> <!-- Nomor urut -->
                    <th scope="col">Nama Barang</th> <!-- Nama barang -->
                    <th scope="col">Kode Huruf</th> <!-- Kode huruf barang -->
                    <th scope="col">Ditambahkan Oleh</th> <!-- Username pembuat barang -->
                    <?php if ($role == 'admin'): ?> <!-- Kolom Aksi hanya untuk Admin -->
                        <th scope="col">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; // Inisialisasi nomor urut
                while ($row = $result->fetch_assoc()): ?> <!-- Looping data barang -->
                <tr>
                    <td><?php echo $no++; ?></td> <!-- Nomor urut -->
                    <td><?php echo htmlspecialchars($row['nama_barang']); ?></td> <!-- Nama barang -->
                    <td><?php echo htmlspecialchars($row['kode_huruf']); ?></td> <!-- Kode huruf -->
                    <td><?php echo htmlspecialchars($row['created_by_user']); ?></td> <!-- Username pembuat -->
                    <?php if ($role == 'admin'): ?>
                    <td>
                        <!-- Tombol Edit -->
                        <a href="form.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <!-- Tombol Hapus dengan konfirmasi -->
                        <a href="proses.php?hapus=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Inisialisasi DataTable pada tabel dengan id "dt"
        new DataTable('#dt');
    });
</script>
</body>
</html>
