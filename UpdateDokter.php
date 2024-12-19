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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Mengambil data dari form edit dokter
  $id = $_POST['id'];
  $nama = $_POST['nama_dokter'];
  $kode = $_POST['kode_dokter'];
  $spesialis = $_POST['spesialis'];
  $jadwal_konsul = $_POST['jadwal_konsul'];
  $harga = $_POST['harga'];

  // Cek apakah ada file gambar yang diupload
  if ($_FILES['gambar']['size'] > 0) {
    $gambar = $_FILES['gambar']['tmp_name'];
    $gambarData = addslashes(file_get_contents($gambar));

    // Query untuk mengupdate data dokter dengan gambar
    $sql = "UPDATE dokter SET nama_dokter='$nama', kode_dokter='$kode', spesialis='$spesialis', jadwal_konsul='$jadwal_konsul', harga='$harga', gambar='$gambarData' WHERE id=$id";
  } else {
    // Query untuk mengupdate data dokter tanpa gambar
    $sql = "UPDATE dokter SET nama_dokter='$nama', kode_dokter='$kode', spesialis='$spesialis', jadwal_konsul='$jadwal_konsul', harga='$harga' WHERE id=$id";
  }

  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Data dokter berhasil diperbarui');</script>";
  } else {
    echo "<script>alert('Gagal memperbarui data dokter: " . mysqli_error($conn) . "');</script>";
  }

  // Tutup koneksi
  mysqli_close($conn);

  // Redirect kembali ke halaman ViewData.php
  header("Location: datadokter.php");
  exit();
}
?>
