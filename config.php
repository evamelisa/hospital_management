<?php
 
// kofigurasi koneksi database
$host = "localhost";
$username = "root";
$password = "";
$database = "hospital_management";

// membuat koneksi ke database menggunakan MySQLi
$conn = mysqli_connect($host, $username, $password, $database);

// mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    // menampilkan pesan error jika koneksi gagal
    die("Database gagal terkoneksi: " . $conn->connect_error);
}

// jika oneksi berhasil, script akan terus berjalan tanpa pesan error
?>