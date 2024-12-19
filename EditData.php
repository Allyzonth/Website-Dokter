<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Edit Data Konsultasi</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="Assets/EditData.css">
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
        <a href="viewdata.php">Back</a>
      </li>
      <li>
        <a href="datadokter.php">Dokter</a>
      </li>
    </ul>
  </nav>
  <main>
    <div class="container">
      <h2>Edit Data Konsultasi</h2>
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

        // Query untuk mendapatkan data konsultasi berdasarkan nama
        $sql = "SELECT * FROM form WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          ?>
          <form action="UpdateData.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            <label for="no_hp">No HP:</label>
            <input type="text" id="no_hp" name="no_hp" value="<?php echo $row['no_hp']; ?>" required>
            <label for="keluhan">Keluhan:</label>
            <textarea id="keluhan" name="keluhan" required><?php echo $row['keluhan']; ?></textarea>
            <button type="submit">Simpan</button>
          </form>
          <?php
        } else {
          echo "<p>Data tidak ditemukan</p>";
        }
      } else {
        echo "<p>ID tidak ditemukan</p>";
      }

      // Tutup koneksi
      mysqli_close($conn);
      ?>
    </div>
  </main>
  <footer>
    <div class="scroll-to-top" onclick="scrollToTop()"><i class="fas fa-arrow-up"></i></div>
    <p>Hak Cipta &copy; 2023 Profil Kesehatan</p>
  </footer>
  <script src="Script.js"></script>
</body>
</html>
