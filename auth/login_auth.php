<?php
session_start();
require_once("../config.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM pasien WHERE nama ='$nama'";
    $result = $conn->query($sql);

    if ($result->num_rows> 0){
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            
            $_SESSION["nama"] = $row["nama"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["pasien_id"] = $row["pasien_id"];

            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'Selamat datang di Hospital Manegement'
            ];
            header('Location: ../dashboard.php');
            exit();
        }else {
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Username atau password salah'
            ];
        }
    } else {
        $_SESSION['notification'] = [
            'type' =>'danger',
            'message' => 'Username atau password salah',

        ];
    }
    header('Location: login.php');
    exit();
}
$conn->close();
?>