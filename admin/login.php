<?php
session_start();
$servername = "localhost";
$username = "root";  // Ganti dengan username database kamu
$password = "";  // Ganti dengan password database kamu
$dbname = "palletcafe";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Query untuk mencari username di database
    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika username ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password_from_db = $row['password'];

        // Verifikasi password
        if ($input_password === $hashed_password_from_db) {
            // Jika password benar, set session dan redirect ke halaman admin.php
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $input_username;
            header("Location: admin.php");
            exit;
        } else {
            // Jika password salah, tampilkan pesan error
            $error_message = "Password yang Anda masukkan salah.";
        }
    } else {
        // Jika username tidak ditemukan, tampilkan pesan error
        $error_message = "Username tidak ditemukan.";
    }
    $stmt->close();
}
// Tutup statement dan koneksi database
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="admin_styles.css">
    <title>Login</title>
    <script>
        function showError(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <?php
    if (!empty($error_message)) {
        echo "<script>showError('$error_message');</script>";
    }
    ?>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <div class="login-header">
                <img src="asset/logo.png" alt="Login Image" class="login-image">
                <p class="login-text" style="font-size: 2rem; font-weight: 800;">LOGIN</p>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="password" name="password" required>
            </div>
            <div class="input-group">
                <button type="submit" name="submit" class="btn">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
