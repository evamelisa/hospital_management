<?php
// menghubungkan file konfigurasi database
include 'config.php';

// memulai sesi PHP
session_start();

// mendapatkan ID pengguna dari sesi
$pasienId = $_SESSION["pasien_id"];

// menangani form untuk menambahkan postingan baru
id (isset($_POST['simpan'])) {
    // mendapatkan data dari form
    $postTitle = $_POST["post_title"]; //judul postingan
    $content = $_POST["content"]; //konten postingan
    $dokterId = $_POST["kategori_id"]; //ID dokter

    //mengatur direktori penyimpanan file gambar
    $tanggal = $_POST["tanggal"]; // pastikan input name="tanggal"
    $postTitle = $_POST["post_title"];
    $content = $_POST["content"];
    $dokterId = $_POST["dokter_id"];
    $pasienId = $_POST["pasien_id"];

    //memindahkan file gambar yang diunggah ke direktori tujuan
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
        //jika unggahan berhasil, masukkan data postingan ke dalam database
        $query = "INSERT INTO jadwalkan (post_title, content, tanggal, dokter_id, pasien_id) 
          VALUES ('$postTitle', '$content', '$tanggal', $dokterId, $pasienId)";\

          if($conn->query($query) === TRUE) {
            // notifikasi berhasil jika postingan berhasil ditambahkan
           $_SESSION['notification'] = ['type' => 'primary', 'message' => 'Post successfully added.'];
          }
    } else {
        // notifikasi error jika gagal menambahkan postingan
         $_SESSION['notification'] = ['type' => 'danger', 'message' => 'Error adding post: ' . $conn->error];
    }

// arahkan ke halaman dashboard setekah selesai
header('Location: pertemuan.php');
exit();
}

// proses penghapusan postingan
if (isset($_POST['delete'])) {
    // mengambil ID post dari parameter URL
    $pasienID = $_POST['pasien_id'];

    // query untuk menghapus post berdasarkan ID
    $exec = mysqli_query($conn, "DELETE FROM posts WHERE pasien_id='$pasienID'");

    // menyimpan notifikasi keberhasilan atau kegagalan ke dalam session
    if ($exec) {
        $_SESSION['notification'] = ['type' => 'primary', 'message' => 'Pasien succesfully deleted'];
    } else {
        $_SESSION['notification'] = ['type' => 'danger', 'message' => 'Error deleting pasien: ' . mysqli_error($conn)];
    }

    // redirect kembali ke halaman pertemuan
    header('Location: pertemuan.php');
    exit();
}

// menangani pembaruan data postingan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // mendapatkan data dari form
    $pasienId = $_POST['post_title'];
    $postTitle = $_POST["post_title"];
    $content = $_POST["content"];
    $dokterId = $_POST["dokter_id"];
    $tanggal = $_POST["tanggal"]; 

    // update data postingan di database
    $queryUpdate = "UPDATE posts SET post_title = '$postTitle', 
    content = '$content', category_id = $categoryId, image_path = '$imagePath' 
    WHERE id_post = $postId";

    if ($conn->query($queryUpdate) === TRUE) {
        // Notifikasi berhasil
        $_SESSION['notification'] = ['type' => 'primary', 'message' => 'Gagal memperbarui jadwal.'];
    }

    // arahkan ke halaman dashboard
    header('Location: pertemuan.php');
    exit();
}