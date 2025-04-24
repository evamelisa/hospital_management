<?php

// menghubungkan ke file konfigurasi database
include("config.php");

// memulai sesi untuk menyimpan notifikasi
session_start();

// proses penambahan kategori baru
if(isset($_POST['simpan'])) {
    // mengambil data nama dokter dari form
    $nama = $_POST['nama'];

    // query untuk menambahkan data kategori ke dalam database
    $query = "INSERT INTO dokter (nama) VALUES ('$nama')";
    $exec = mysqli_query($conn, $query);

    // meyimpan notifikasi berhasil atau gagal ke dalam session
    if ($exec) {
        $_SESSION['notification'] = ['type' => 'primary', //jenis notifikasi (contoh: primary untuk keberhasilan)
        'message' => 'Gagal menambahkan dokter: ' . mysqli_error($conn)];
}

// redirect kembali ke halaman dokter
header('Location: dokter.php');
exit();
}
// proses penghapusan kategori
if (isset($_POST['delete'])) {
    // mengambil ID dokter dari parameter URL
    $dokter_id = $_POST['dokter_id'];

    //query untuk menghapus kategori berdasarkan ID
    $exec = mysqli_query($conn, "DELETE FROM dokter WHERE dokter_id='catID'");

    // menyimpan notifikasi keberhasilan atau kegagalan kegagalan dalam session
    if ($exec) {
        $_SESSION['notification'] = ['type' => 'primary', 'message' = 'Kategori berhasil dihapus!'];
    } else {
        $_SESSION['notification'] = ['type' => 'danger', 'message' => 'Gagal menghapus dokter: ' . mysqli_error($conn)];
    }

    //redirect kembali ke halaman dokter
    header('Location: dokter.php');
    exit();
}
// proses pembaruan kategori
if (isset($_POST['update'])) {
    // mengambil data dari form pembaruan
    $dokter_id= $_POST['dokter_id'];
    $nama = $_POST['nama'];

    //query untuk memperbarui data dari kategori berdasarkan ID
    $query = "UPDATE dokter SET nama = '$nama' WHERE dokter_id='$dokter_id'";
    $exec = mysqli_query($conn, $query);

    // menyimpan notifikasi keberhasilan atau kegagalan ke dalam session
    if ($exec) {
        $_SESSION['notification'] = ['type' => 'primary', 'message' => 'Dokter berhasil diperbarui!'];
    } else {
        $_SESSION['notification'] = ['type' = 'danger', 'message' => 'Gagal memperbarui dokter: ' . mysqli_error($conn)];
    }

    // redirect kembali ke halaman dokter
    header('Location: dokter.php')
    exit();
}