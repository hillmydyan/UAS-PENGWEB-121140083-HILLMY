<?php
// Mengimpor file koneksi untuk menghubungkan ke database
include 'koneksi.php';

// Variabel untuk menandai apakah registrasi berhasil
$success = false;

// Mengecek apakah request menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data input dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $role = $_POST['role'];
    $phone = $_POST['phone'];

    // Mengecek apakah password dan confirm password cocok
    if ($password !== $confirmPassword) {
        $error = 'Passwords do not match!'; // Menampilkan error jika password tidak cocok
    } else {
        // Meng-hash password menggunakan algoritma bcrypt
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Menyusun query SQL untuk menambahkan data pengguna ke database
        $stmt = $conn->prepare("INSERT INTO users (username, password, role, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $hashedPassword, $role, $phone);
        
        // Menjalankan query dan mengecek apakah berhasil
        if ($stmt->execute()) {
            $success = true; // Menandai bahwa registrasi berhasil
        } else {
            $error = 'Gagal registrasi'; // Menampilkan error jika registrasi gagal
        }

        // Menutup statement setelah eksekusi selesai
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Mengimpor Bootstrap CSS untuk styling -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Mengimpor Bootstrap JS untuk interaktivitas -->
    <script src="js/bootstrap.bundle.js"></script>
    <title>Register</title>
</head>
<body>
    <!-- Formulir untuk pendaftaran -->
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title text-center">Register</h3>
                <!-- Menampilkan pesan error jika ada -->
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <!-- Formulir pendaftaran -->
                <form method="POST">
                    <!-- Input untuk username -->
                    <div class="row mb-3">
                        <label for="username" class="col-sm-3 col-form-label">Username:</label>
                        <div class="col-sm-9">
                            <input type="text" name="username" class="form-control" id="username" required>
                        </div>
                    </div>
                    <!-- Input untuk password -->
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Password:</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" class="form-control" id="inputPassword" required>
                        </div>
                    </div>
                    <!-- Input untuk konfirmasi password -->
                    <div class="row mb-3">
                        <label for="inputConfirmPassword" class="col-sm-3 col-form-label">Confirm Password:</label>
                        <div class="col-sm-9">
                            <input type="password" name="confirm_password" class="form-control" id="inputConfirmPassword" required>
                        </div>
                    </div>
                    <!-- Input untuk memilih role (Admin atau User) -->
                    <div class="row mb-3">
                        <label for="role" class="col-sm-3 col-form-label">Role:</label>
                        <div class="col-sm-9">
                            <select name="role" class="form-select" id="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                    <!-- Input untuk nomor telepon -->
                    <div class="row mb-3">
                        <label for="phone" class="col-sm-3 col-form-label">Nomor Handphone:</label>
                        <div class="col-sm-9">
                            <input type="text" name="phone" class="form-control" id="phone" required>
                        </div>
                    </div>
                    <!-- Tombol submit untuk mengirim formulir -->
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script untuk validasi form sebelum submit -->
    <script>
        document.querySelector('form').addEventListener('submit', function (e) {
            // Mendapatkan nilai password dan confirm password
            const password = document.getElementById('inputPassword').value;
            const confirmPassword = document.getElementById('inputConfirmPassword').value;

            // Mengecek apakah password dan confirm password cocok
            if (password !== confirmPassword) {
                e.preventDefault(); // Menghentikan pengiriman form
                alert('Passwords do not match!'); // Menampilkan alert jika password tidak cocok
            }
        });

        <?php if ($success): ?>
        // Menampilkan notifikasi jika registrasi berhasil
        alert('Pendaftaran Berhasil, Silahkan Login.');
        window.location.href = 'login.php'; // Redirect ke halaman login
        <?php endif; ?>
    </script>
</body>
</html>
