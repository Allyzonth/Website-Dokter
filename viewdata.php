<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin - Data Konsultasi</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="assets/viewdata.css" />
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
        <a href="login.php">Log out</a>
      </li>
      <li>
        <a href="datadokter.php">Dokter</a>
      </li>
  </nav>
  <main>
  <section id="hero">
      <div class="hero-container">
        <h2>Data Pasien</h2>
      </div>
    </section>
    <div class="container">
      <table>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Email</th>
          <th>No HP</th>
          <th>Keluhan</th>
          <th>Aksi</th>
        </tr>

        <?php
        session_start();

        // Cek apakah admin sudah login
        if (!isset($_SESSION['admin_username'])) {
          header("Location: login.php");
          exit();
        }
        
        // Logout admin
        if (isset($_POST['logout'])) {
          // Hapus semua session
          session_destroy();
        
          // Redirect ke halaman beranda
          header("Location: index.php");
          exit();
        }

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

        // Fungsi hapus data
        if (isset($_GET['hapus'])) {
          $id = $_GET['hapus'];

          // Query untuk menghapus data
          $sql = "DELETE FROM form WHERE id = '$id'";
          $result = mysqli_query($conn, $sql);

          if ($result) {
            echo "<script>alert('Data berhasil dihapus');</script>";
            echo "<script>window.location.href = 'viewdata.php';</script>";
          } else {
            echo "<script>alert('Gagal menghapus data');</script>";
          }
        }

        // Query untuk mendapatkan data konsultasi
        $sql = "SELECT * FROM form";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          $no = 1;
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['no_hp'] . "</td>";
            echo "<td>" . $row['keluhan'] . "</td>";
            echo "<td>";
            echo "<a href='EditData.php?id=" . $row['id'] . "' class='btn-edit'><i class='fas fa-edit'></i> Edit</a>";
            echo "<a href='viewdata.php?hapus=" . $row['id'] . "' class='btn-hapus'><i class='fas fa-trash'></i> Hapus</a>";
            echo "</td>";
            echo "</tr>";
            $no++;
          }
        } else {
          echo "<tr>";
          echo "<td colspan='6'>Tidak ada data konsultasi</td>";
          echo "</tr>";
        }

        // Tutup koneksi
        mysqli_close($conn);
        ?>

      </table>
    </div>
  </main>
  <footer>
    <div class="scroll-to-top" onclick="scrollToTop()"><i class="fas fa-arrow-up"></i></div>
    <p>Hak Cipta &copy; 2023 Profil Kesehatan</p>
  </footer>
  <script src="Script.js"></script>
</body>
</html>
