<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "hospital_management";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn->connect_error) {
    die("DATABASE GAGAL TERKONEKSI: " . $conn->connect_error);
}
?>