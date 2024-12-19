<?php
session_start();

// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "pemweb";

$conn = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$conn) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}

// Tangkap data yang dikirimkan melalui form
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mendapatkan data admin berdasarkan username
$sql = "SELECT * FROM admin WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
  $row = mysqli_fetch_assoc($result);
  if ($password == $row['password']) {
    // Jika username dan password cocok, set session dan redirect ke halaman ViewData.php
    $_SESSION['admin_username'] = $username;
    header("Location: ViewData.php");
    exit();
  } else {
    echo "Password salah";
  }
} else {
  echo "Username tidak ditemukan";
}

// Tutup koneksi
mysqli_close($conn);
?>
