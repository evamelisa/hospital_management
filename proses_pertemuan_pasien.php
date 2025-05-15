<?php
//menghubungkan file konfigurasi database
include 'config.php';

//mulai sesi
session_start();

//mendapatkan id pengguna
$pasienId = $_SESSION["pasien_id"];

// Menangani form penyimpanan data
if (isset($_POST['simpan'])) {
    //mendapatkan data dari form
    $namaPasien = $_POST['nama_pasien'];
    $tglLahir = $_POST["tgl_lahir"];
    $gender = $_POST["gender"];
    $tglPertemuan = $_POST["tanggal_pertemuan"];
    $waktuPertemuan = $_POST["waktu_pertemuan"];
    $postTitle = $_POST["post_title"];
    $content = $_POST["content"];
    $dokterId = $_POST["dokter_id"];

    // QUERY DITAMBAHKAN
    $query = "INSERT INTO pertemuan (pasien_id, nama_pasien, tgl_lahir, gender, tanggal_pertemuan, waktu_pertemuan, post_title, content, dokter_id) 
              VALUES ('$pasienId', '$namaPasien',  '$tglLahir', '$gender', '$tglPertemuan', '$waktuPertemuan', '$postTitle', '$content', '$dokterId')";

    if ($conn->query($query) === TRUE) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Post successfully added.'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Error adding post: ' . $conn->error
        ];
    }

    header('Location: dashboard.php');
    exit();
}

//proses penghapusan postingan
if (isset($_POST['delete'])) {
    //mengambil id post
    $pertemuanID = $_POST['pertemuanID'];

    // KOREKSI VARIABEL: dari $postID ke $pertemuanID
    $exec = mysqli_query($conn, "DELETE FROM pertemuan WHERE pertemuan_id='$pertemuanID'");

    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Post successfully deleted.'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Error deleting pertemuan: ' . mysqli_error($conn)
        ];
    }

    header('Location: dashboard.php');
    exit();
}

// menangani pembaruan data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $pertemuanId = $_POST['pertemuan_id'];
    $namaPasien = $_POST['nama_pasien'];
    $tglLahir = $_POST["tgl_lahir"];
    $gender = $_POST["gender"];
    $tglPertemuan = $_POST["tanggal_pertemuan"];
    $waktuPertemuan = $_POST["waktu_pertemuan"];
    $postTitle = $_POST["post_title"];
    $content = $_POST["content"];
    $dokterId = $_POST["dokter_id"];

    // PERBAIKAN: hapus koma setelah '$tglLahir'
    $queryUpdate = "UPDATE pertemuan SET post_title = '$postTitle', nama_pasien = '$namaPasien',
        content = '$content', dokter_id = $dokterId, waktu_pertemuan = '$waktuPertemuan',
        tanggal_pertemuan = '$tglPertemuan', gender = '$gender',
        tgl_lahir = '$tglLahir' WHERE pertemuan_id = $pertemuanId";

    if ($conn->query($queryUpdate) === TRUE) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Postingan berhasil diperbarui.'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal memperbarui postingan.'
        ];
    }

    header('Location: dashboard.php');
    exit();
}
