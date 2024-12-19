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

// Proses form saat tombol submit ditekan
if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $no_hp = $_POST['no_hp'];
  $keluhan = $_POST['keluhan'];

  // Query untuk menyimpan data ke database
  $sql = "INSERT INTO form (nama, email, no_hp, keluhan) VALUES ('$nama', '$email', '$no_hp', '$keluhan')";

  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Terima kasih telah submit');</script>";;
  } else {
    echo "Terjadi kesalahan: " . mysqli_error($conn);
  }
}

// Tutup koneksi
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dokter Online</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="website icon" type="png" href="Assets/logodok.svg">
  <link rel="stylesheet" href="Assets/Konsultasi.css" />
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
    <div class="container">
      <div class="contact-box">
        <div class="left"></div>
        <div class="right">
          <h2>Konsultasi</h2>
          <form method="POST" action="">
            <input type="text" name="nama" class="field" placeholder="Nama">
            <input type="text" name="email" class="field" placeholder="Email">
            <input type="text" name="no_hp" class="field" placeholder="No Hp">
            <textarea name="keluhan" placeholder="Keluhan" class="field"></textarea>
            <button type="submit" name="submit">Kirim</button>
          </form>
        </div>
      </div>
    </div>
  </main>
  <footer>
    <div class="scroll-to-top" onclick="scrollToTop()"><i class="fas fa-arrow-up"></i></div>
    <p>Hak Cipta &copy; 2023 Profil Kesehatan</p>
  </footer>
  <script src="Script.js"></script>
</body>
</html>
