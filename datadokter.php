<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin - Data Konsultasi</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="Assets/datadokter.css" />
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
        <a href="viewdata.php">Back To Data Pasien</a>
      </li>
  </nav>
  <main>
  <section id="hero">
      <div class="hero-container">
        <h2>Data Dokter</h2>
      </div>
    </section>
    <div class="container">
      <table>
        <tr>
          <th>No</th>
          <th>Nama Dokter</th>
          <th>Kode Dokter</th>
          <th>Spesialis</th>
          <th>Jadwal Konsultasi</th>
          <th>Harga</th>
          <th>Profil</th>
          <th>Aksi</th>
        </tr>

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

        // Fungsi hapus data
        if (isset($_GET['hapus'])) {
          $id = $_GET['hapus'];

          // Query untuk menghapus data
          $sql = "DELETE FROM dokter WHERE id = '$id'";
          $result = mysqli_query($conn, $sql);

          if ($result) {
            echo "<script>alert('Data berhasil dihapus');</script>";
            echo "<script>window.location.href = 'datadokter.php';</script>";
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
            // Menampilkan gambar dari database
            echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['gambar']) . "'alt= Profil' width='80'></td>";
            echo "<td>";
            echo "<a href='EditDokter.php?id=" . $row['id'] . "' class='btn-edit'><i class='fas fa-edit'></i> Edit</a>";
            echo "<a href='datadokter.php?hapus=" . $row['id'] . "' class='btn-hapus'><i class='fas fa-trash'></i> Hapus</a>";
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
  <div class="container">
    <div class="contact-box">
        <div class="left"></div>
          <div class="right">
                <h2>Tambah Dokter</h2>
              <form method="POST" action="update_data_dokter.php" enctype="multipart/form-data">
                <input type="text" name="nama_dokter" class="field" placeholder="Nama">
                <input type="text" name="kode_dokter" class="field" placeholder="Kode Dokter">
                <input type="text" name="spesialis" class="field" placeholder="Spesialis">
                <input type="text" name="jadwal_konsul" class="field" placeholder="Jadwal Konsultasi">
                <input type="text" name="harga" class="field" placeholder="harga">     
                <input type="file" id="gambar" name="gambar" class="field" placeholder="gambar" value="<?php echo $row['gambar']; ?>" required>
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
