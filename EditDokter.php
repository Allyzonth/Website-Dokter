<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data Dokter</title>
  <link rel="stylesheet" href="Assets/EditDokter.css"> <!-- Sesuaikan dengan CSS yang digunakan -->
  <link rel="website icon" type="png" href="Assets/adminlogoo.png">
</head>

<body>
<nav>
    <div class="navbar">
      <img src="Assets/dokter.png" alt="Logo" />
    </div>
    <header>Admin - Dokter Online</header>
    <ul>
      <li>
        <a href="datadokter.php">Back</a>
      </li>
    </ul>
  </nav>
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

  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data dokter berdasarkan ID
    $sql = "SELECT * FROM dokter WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    } else {
      echo "<h3>Data dokter tidak ditemukan.</h3>";
      exit;
    }
  } else {
    echo "<h3>ID dokter tidak ditemukan.</h3>";
    exit;
  }

  // Tutup koneksi
  mysqli_close($conn);
  ?>

  <h2>Edit Data Dokter</h2>
  <form action="UpdateDokter.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="nama_dokter">Nama:</label>
    <input type="text" id="nama_dokter" name="nama_dokter" value="<?php echo $row['nama_dokter']; ?>" required>
    <label for="kode_dokter">Kode Dokter:</label>
    <input type="text" id="kode_dokter" name="kode_dokter" value="<?php echo $row['kode_dokter']; ?>" required>
    <label for="spesialis">Spesialis:</label>
    <input type="text" id="spesialis" name="spesialis" value="<?php echo $row['spesialis']; ?>" required>
    <label for="jadwal_konsul">jadwal konsultasi:</label>
    <input type="text" id="jadwal_konsul" name="jadwal_konsul" value="<?php echo $row['jadwal_konsul']; ?>" required>
    <label for="harga">harga:</label>
    <input type="text" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
    <label for="gambar">Gambar:</label>
    <input type="file" id="gambar" name="gambar">
    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['gambar']); ?>" alt="Gambar Dokter" width="100">
    <button type="submit" name="submit">Simpan</button>
  </form>
</body>

</html>
