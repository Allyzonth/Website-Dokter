<?php
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
$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$keluhan = $_POST['keluhan'];

// Query untuk mengupdate data konsultasi
$sql = "UPDATE form SET nama='$nama', email='$email', no_hp='$no_hp', keluhan='$keluhan' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
  // Jika berhasil mengupdate data, redirect kembali ke halaman ViewData.php
  header("Location: viewdata.php");
  exit();
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);
?>


