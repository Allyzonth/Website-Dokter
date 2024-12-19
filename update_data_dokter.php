<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "pemweb"; // Ganti dengan nama database Anda

$conn = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$conn) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil data gambar
$gambar = $_FILES['gambar']['tmp_name'];
$gambar_type = $_FILES['gambar']['type'];

// Baca data gambar menjadi binary
$gambar_bin = file_get_contents($gambar);

// Query untuk menyimpan data dokter ke database
$sql = "INSERT INTO dokter (nama_dokter, kode_dokter, spesialis, jadwal_konsul, harga, gambar) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssss", $_POST['nama_dokter'], $_POST['kode_dokter'], $_POST['spesialis'],$_POST['jadwal_konsul'], $_POST['harga'], $gambar_bin);

// Eksekusi query
if (mysqli_stmt_execute($stmt)) {
  echo "Data dokter berhasil ditambahkan.";
  // Redirect kembali ke halaman ViewData.php atau halaman lainnya jika diperlukan
  header("Location: datadokter.php");
  exit;
} else {
  echo "Terjadi kesalahan saat menambahkan data dokter: " . mysqli_error($conn);
}


// Tutup koneksi dan statement
mysqli_stmt_close($stmt);
mysqli_close($conn);



?>