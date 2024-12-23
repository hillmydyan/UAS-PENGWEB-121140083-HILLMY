<?php
session_start(); // Memulai sesi untuk menyimpan data pengguna
include 'koneksi.php'; // Menghubungkan ke file koneksi database

// Memeriksa apakah form login dikirim dengan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Mengambil username dari input form
    $password = $_POST['password']; // Mengambil password dari input form

    // Query untuk memeriksa username di tabel `users`
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query); // Menggunakan prepared statement untuk mencegah SQL injection
    $stmt->bind_param('s', $username); // Mengikat parameter `username` ke query
    $stmt->execute();
    $result = $stmt->get_result(); // Menjalankan query dan mendapatkan hasilnya

    // Jika username ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // Mengambil data pengguna dari hasil query

        // Verifikasi password menggunakan fungsi password_verify
        if (password_verify($password, $user['password'])) {
            // Menyimpan informasi pengguna ke dalam sesi
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['user_id'] = $user['id'];

            // Redirect ke halaman dashboard (index.php)
            header('Location: index.php');
            exit();
        } else {
            $error = "Password salah."; // Pesan error jika password salah
        }
    } else {
        $error = "Username tidak ditemukan."; // Pesan error jika username tidak ditemukan
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Memuat CSS Bootstrap -->
    <script src="js/bootstrap.bundle.js"></script> <!-- Memuat JavaScript Bootstrap -->
    <title>Login</title> <!-- Judul halaman -->
</head>
<body class="bg-dark text-light"> <!-- Latar belakang gelap dan teks terang -->
<div class="container mt-5">
    <div class="card bg-transparent text-light shadow-lg" style="backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
        <div class="card-body">
            <h3 class="card-title text-center">Login</h3> <!-- Judul formulir login -->

            <!-- Menampilkan pesan error jika ada -->
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?> <!-- Pesan error -->
                </div>
            <?php endif; ?>

            <!-- Form login -->
            <form action="" method="POST">
                <div class="row mb-3">
                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" id="username" name="username" class="form-control bg-secondary text-light" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" id="password" name="password" class="form-control bg-secondary text-light" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary">Login</button> <!-- Tombol login -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
