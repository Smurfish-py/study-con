<?php
session_start();
require_once '../../vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('804773744896-eo2omb1dn7u8q035ms1pbgkim3k8h7v0.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/StudyCon/logika/google-login/callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    $oauth = new Google_Service_Oauth2($client);
    $userinfo = $oauth->userinfo->get();

    echo "Halo, " . $userinfo->name . "<br>";
    echo "Email: " . $userinfo->email . "<br>";
    echo "<img src='" . $userinfo->picture . "'>";
} else {
    echo "Login gagal atau tidak ada kode.";
}
