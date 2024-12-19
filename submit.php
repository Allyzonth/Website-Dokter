<?php
// Mengambil nilai yang diisi dalam form
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$keluhan = $_POST['keluhan'];

// Konfigurasi koneksi database
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'pemweb'; // Ganti dengan nama database yang ingin Anda gunakan

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}

// Menyimpan data ke database
$sql = "INSERT INTO form (nama, email, no_hp, keluhan) VALUES ('$nama', '$email', '$no_hp', '$keluhan')";

if ($conn->query($sql) === true) {
    echo 'Data berhasil disimpan ke database.';
} else {
    echo 'Error: ' . $sql . '<br>' . $conn->error;
}

// Menutup koneksi database
$conn->close();
?>