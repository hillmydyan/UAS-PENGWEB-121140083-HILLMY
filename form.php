<?php
// Memulai session untuk menjaga autentikasi pengguna
session_start();

// Menyertakan file koneksi ke database
include 'koneksi.php';

// Pastikan hanya pengguna yang login dapat mengakses halaman ini
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login
    exit();
}

// Periksa apakah pengguna memiliki peran admin
$role = $_SESSION['role'];
if ($role != 'admin') {
    echo "Hanya admin yang dapat mengakses halaman ini."; // Pesan jika bukan admin
    exit();
}

// Jika form adalah untuk mengedit, ambil data barang berdasarkan ID dari URL
$barang = null;
if (isset($_GET['id'])) { // Periksa apakah parameter 'id' ada
    $id = $_GET['id'];
    $query = "SELECT * FROM tb_barang1 WHERE id = ?"; // Query untuk mendapatkan data barang
    $stmt = $conn->prepare($query); // Menggunakan prepared statement untuk keamanan
    $stmt->bind_param('i', $id); // Mengikat parameter ID sebagai integer
    $stmt->execute(); // Menjalankan query
    $result = $stmt->get_result(); // Mendapatkan hasil query
    $barang = $result->fetch_assoc(); // Mengambil data barang dalam bentuk array asosiatif
}

// Menentukan nilai default untuk form
$nama_barang = $barang['nama_barang'] ?? ''; // Jika data barang ada, ambil nilai nama_barang
$kode_huruf = $barang['kode_huruf'] ?? ''; // Jika data barang ada, ambil nilai kode_huruf
$isEdit = isset($barang); // Menentukan apakah ini adalah mode edit
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Menyertakan CSS Bootstrap untuk gaya -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Menyertakan JavaScript Bootstrap -->
    <script src="js/bootstrap.bundle.js"></script>
    <script>
        // Fungsi validasi untuk memastikan Nama Barang tidak kosong
        function validateNamaBarang() {
            const namaBarang = document.getElementById('nama_barang').value;
            if (namaBarang.trim() === '') {
                alert('Nama Barang tidak boleh kosong.');
                return false; // Hentikan proses form
            }
            return true; // Lolos validasi
        }

        // Fungsi validasi untuk memastikan Kode Barang hanya berisi huruf dan angka
        function validateKodeHuruf() {
            const kodeHuruf = document.getElementById('kode_huruf').value;
            if (!/^[A-Za-z0-9]+$/.test(kodeHuruf)) {
                alert('Kode Barang hanya boleh berisi huruf dan angka.');
                return false; // Hentikan proses form
            }
            if (kodeHuruf.length > 10) { // Periksa panjang maksimum
                alert('Kode Barang tidak boleh lebih dari 10 karakter.');
                return false; // Hentikan proses form
            }
            return true; // Lolos validasi
        }

        // Fungsi validasi keseluruhan form
        function validateForm(event) {
            if (!validateNamaBarang() || !validateKodeHuruf()) { // Jika salah satu validasi gagal
                event.preventDefault(); // Mencegah pengiriman form
                return false;
            }
            return true; // Lolos validasi
        }
    </script>
    <title>Form Barang</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TOKO NH JAYA</a> <!-- Nama toko -->
        </div>
    </nav>

    <!-- Container untuk form -->
    <div class="container">
        <!-- Judul form, menyesuaikan mode Tambah atau Edit -->
        <h2 class="mb-4 text-center"><?php echo $isEdit ? 'Edit Data Barang' : 'Tambah Data Barang'; ?></h2>

        <!-- Form untuk menambah atau mengedit data barang -->
        <form action="proses.php" method="POST" onsubmit="return validateForm(event)">
            <!-- Input tersembunyi untuk menyimpan ID (jika mode edit) -->
            <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($barang['id']); ?>">
            <?php endif; ?>

            <!-- Input Nama Barang -->
            <div class="mb-3 row">
                <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                    <input type="text" id="nama_barang" name="nama_barang" class="form-control" value="<?php echo htmlspecialchars($nama_barang); ?>" onchange="validateNamaBarang()" required>
                </div>
            </div>

            <!-- Input Kode Barang -->
            <div class="mb-3 row">
                <label for="kode_huruf" class="col-sm-2 col-form-label">Kode Barang</label>
                <div class="col-sm-10">
                    <input type="text" id="kode_huruf" name="kode_huruf" class="form-control" value="<?php echo htmlspecialchars($kode_huruf); ?>" onchange="validateKodeHuruf()" required>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="mb-3 row">
                <div class="col">
                    <button type="submit" name="<?php echo $isEdit ? 'edit' : 'tambah'; ?>" class="btn btn-primary">
                        <?php echo $isEdit ? 'Simpan Perubahan' : 'Tambah Barang'; ?>
                    </button>
                    <a href="index.php" class="btn btn-danger">Batal</a> <!-- Tombol Batal -->
                </div>
            </div>
        </form>
    </div>

</body>
</html>

