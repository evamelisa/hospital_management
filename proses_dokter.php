<?php
// Menghubungkan ke file konfigurasi database
include("config.php");

// Memulai sesi untuk menyimpan notifikasi
session_start();

// Proses penambahan dokter baru
if (isset($_POST['simpan'])) {
    // Mengambil data nama dokter dari form
    $Dokter = $_POST['dokter'];
    $spesialisasi = $_POST['spesialisasi'];

    // Query untuk menambahkan data dokter ke dalam database
    $query = "INSERT INTO dokter (dokter, spesialisasi) VALUES ('$Dokter', '$spesialisasi')";
    $exec = mysqli_query($conn, $query);

    // Menyimpan notifikasi berhasil atau gagal ke dalam session
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary', // Jenis notifikasi (contoh: primary untuk keberhasilan)
            'message' => 'Dokter berhasil ditambahkan!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger', // Jenis notifikasi (contoh: danger untuk kegagalan)
            'message' => 'Gagal menambahkan dokter: ' . mysqli_error($conn)
        ];
    }

    // Redirect kembali ke halaman dokter
    header('Location: dokter.php');
    exit();
}
// Proses penghapusan dokter
if (isset($_POST['delete'])) {
    // Mengambil ID dokter dari parameter URL
    $catID = $_POST['catID'];

    // Query untuk menghapus dokter berdasarkan ID
    $exec = mysqli_query($conn, "DELETE FROM dokter WHERE dokter_id='$catID'");

    // Menyimpan notifikasi keberhasilan atau kegagalan ke dalam session
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Dokter berhasil dihapus!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal menghapus dokter: ' . mysqli_error($conn)
        ];
    }

    // Redirect kembali ke halaman dokter
    header('Location: dokter.php');
    exit();
}
// Proses pembaruan dokter
if (isset($_POST['update'])) {
    // Mengambil data dari form pembaruan
    $catID = $_POST['catID'];
    $Dokter = $_POST['dokter'];
    $spesialisasi = $_POST['spesialisasi'];

    // Query untuk memperbarui data dokter berdasarkan ID
    $query = "UPDATE dokter SET dokter = '$Dokter', spesialisasi = '$spesialisasi' WHERE dokter_id='$catID'";
    $exec = mysqli_query($conn, $query);

    // Menyimpan notifikasi keberhasilan atau kegagalan ke dalam session
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Dokter berhasil diperbarui!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal memperbarui dokter: ' . mysqli_error($conn)
        ];
    }

    // Redirect kembali ke halaman dokter
    header('Location: dokter.php');
    exit();
}


