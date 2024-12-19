<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dokter Online</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="website icon" type="png" href="Assets/logodok.svg">
  <link rel="stylesheet" href="assets/Home.css" />
</head>

<body>
  <nav>
    <div class="navbar">
      <img src="Assets/dokter.png" alt="Logo" />
    </div>
    <header>Dokter Online</header>
    <ul>
      <li>
        <a href="index.php">Beranda</a>
      </li>
      <li>
        <a href="Konsultasi.php">Konsultasi</a>
      </li>
      <li>
        <a href="Tentang.php">Tentang</a>
      </li>
      <li>
        <a href="login_user.php">Log out</a>
      </li>
    </ul>
  </nav>


  <main>
    <section id="hero">
      <div class="hero-container">
        <h2>Selamat Datang</h2>
        <p>Di Dokter Online</p>
      </div>
    </section>
    <section id="dokterf">
      <div class="slideshow-container">
        <div class="mySlides fade">
          <img src="Assets/dokter 1.jpg" alt="Slide 1" class="center">
        </div>
        <div class="mySlides fade">
          <img src="Assets/dokter 2.jpg" alt="Slide 2" class="center">
        </div>
        <div class="mySlides fade">
          <img src="Assets/dokter 3.jpg" alt="Slide 3" class="center">
        </div>
      </div>
    </section>
    <section id="hero">
      <div class="hero-container2">
        <div class="icons">
          <i class="fas fa-heartbeat"></i>
          <i class="fas fa-apple-alt"></i>
          <i class="fas fa-dumbbell"></i>
          <i class="fas fa-leaf"></i>
          <i class="fas fa-smile"></i>
        </div>
        <h2>Layanan Kami</h2>
        <ul>
          <p>Pemeriksaan kesehatan rutin</p>
          <p>Konsultasi medis online</p>
          <p>Program diet dan nutrisi</p>
        </ul>
        <p>Temukan informasi kesehatan terkini untuk hidup sehat dan bahagia</p>
      </div>
    </section>
    <div class="container">
      <table>
        <tr>
          <th>No</th>
          <th>Nama Dokter</th>
          <th>Kode Dokter</th>
          <th>Spesialis</th>
          <th>jadwal konsul</th>
          <th>Harga</th>
          <th>Profil</th>
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
          $nama = $_GET['hapus'];

          // Query untuk menghapus data
          $sql = "DELETE FROM form WHERE nama = '$nama'";
          $result = mysqli_query($conn, $sql);

          if ($result) {
            echo "<script>alert('Data berhasil dihapus');</script>";
            echo "<script>window.location.href = 'ViewData.php';</script>";
          } else {
            echo "<script>alert('Gagal menghapus data');</script>";
          }
        }

        // Query untuk mendapatkan data konsultasi
        $sql = "SELECT * FROM dokter";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          $no = 1;
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $row['nama_dokter'] . "</td>";
            echo "<td>" . $row['kode_dokter'] . "</td>";
            echo "<td>" . $row['spesialis'] . "</td>";
            echo "<td>" . $row['jadwal_konsul'] . "</td>";
            echo "<td>" . $row['harga'] . "</td>";
            echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['gambar']) . "' width='100'></td>";
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
