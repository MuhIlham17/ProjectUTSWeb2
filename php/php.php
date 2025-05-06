<?php
// Koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "login_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

// Query login
$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ? AND password = ?");
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Cek login berhasil
if (mysqli_num_rows($result) > 0) {
    // Arahkan ke halaman dashboard
    header("Location: dashboard.php");
    exit();
} else {
    echo "Username atau password salah.";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
