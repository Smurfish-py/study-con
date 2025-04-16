<?php
session_start();
require_once '../../vendor/autoload.php';
include '../koneksi.php';

$client = new Google_Client();
$client->setClientId('804773744896-eo2omb1dn7u8q035ms1pbgkim3k8h7v0.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/StudyCon/logika/google-login/callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    $oauth = new Google_Service_Oauth2($client);
    $userinfo = $oauth->userinfo->get();

    $email = $userinfo->email;

    $stmt = $pdo->prepare("SELECT * FROM user WHERE email=:email");
    $stmt->execute([':email'=>$email]);

    $_SESSION['username'] = $userinfo->name;
    $_SESSION['email'] = $userinfo->email;
    $_SESSION['foto_profil'] = $userinfo->picture;

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        header("Location: ../../user/".$row['status']."/");
        $_SESSION['id'] = $row['id'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['tgl_lahir'] = $row['tgl_lahir'];
        $_SESSION['sekolah'] = $row['sekolah'];
        $_SESSION['nis'] = $row['NIS'];
        $_SESSION['kelas'] = $row['kelas'];
        $_SESSION['guru_tmpt_mengajar'] = $row['guru_tmpt_mengajar'];
        $_SESSION['guru_mapel'] = $row['guru_mapel'];
        $_SESSION['status'] = $row['status'];
        $_SESSION['status-akun'] = $row['status_akun'];
        $_SESSION['foto_profil'] = $row['foto_profil'];

    } else {
        $stmt = $pdo->prepare("INSERT INTO user (email, tipe_akun, username, status, status_akun) VALUES (:email, :tipe_akun, :username, :status, 'active')");
        $stmt->execute([
        ":email"=>$_SESSION['email'],
        ":tipe_akun"=>"google",
        ":username"=>$_SESSION['username'],
        ":status"=>"default"
    ]);

        header("Location: ../../user/".$row['status']."/");
    }
} else {
    echo "Login gagal atau tidak ada kode.";
}
