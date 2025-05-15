<?php
session_start();

$pasienId = $_SESSION["pasien_id"];
$nama = $_SESSION["nama"];
$role = $_SESSION["role"];

$notification = $_SESSION['notification'] ?? null;
if ($notification) {
    unset($_SESSION['notification']);
}


if (empty($_SESSION["nama"]) || empty($_SESSION["role"])) {
    $_SESSION['notification'] = [
        'type' => 'danger' ,
        'message' => 'silahkan login terlebih dahulu!'
    ];
    header('Location: ./auth/login.php');
    exit();
}