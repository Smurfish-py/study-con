<?php
include "koneksi.php";
include "custom_function.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $reType = $_POST['re-type'];

    if ($password != $reType || $reType != $password){
        header("location: multifunction_page/error.php?message=Password%20%26%20Re%2Dtype%20password%20tidak%20sama%2E&link=login%2Ephp&type=Login%20page");
    } else {
        $query = "INSERT INTO user (email, username, password, status, status_akun) VALUES ('$email', '$username', '$password', 'default', 'active')";

        $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $stmt->execute(['email'=>$email]);

        if ($stmt->rowCount()>0){
            header("location: multifunction_page/error.php?message=Email%20sudah%20terdaftar%20dalam website%2E%20Silahkan%20login%20atau gunakan%20email%20lain%2E&link=login%2Ephp&type=Login%20page");
        } else {
            $stmt = $pdo->prepare($query);
            if($stmt->execute()){
                login_log($email, $username);
                header ("location: multifunction_page/success.php?message=Pendaftaran%20berhasil%2E%20Selamat%20datang%20$username%21&link=login%2Ephp&type=Login%20page");
                exit;
            } else {
                header("location: multifunction_page/error.php?Terjadi%20kesalahan%2C%20Silakan%20daftar%20lagi%2E&link=register%2Ephp&type=Register%20page");
            }
        }
    }
}
?>