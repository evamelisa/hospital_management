<?php
require_once("../config.php");
// Mulai session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nama = $_POST["nama"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO pasien (nama, password)
            VALUES ('$nama', '$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
        // Simpan notifikasi ke dalam session
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Registrasi Berhasil!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal Registrasi: ' . mysqli_error($conn)
        ];
    }

    header('Location: login.php');
    exit();
}

$conn->close();
?>
