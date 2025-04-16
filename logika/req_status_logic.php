<?php
session_start();

include "koneksi.php";
include "custom_function.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit();
} else if ($_SESSION['status'] != 'master' || $_SESSION['status-akun'] == 'banned') {
    session_destroy();
    header("Location: ../../");
}

$reqId = $_GET['req_id'];

if (isset($_GET['req']) && $_GET['req'] == 'setuju') {
    $new_status = $_GET['action'];
    $id_pengguna = $_GET['id'];
    $user_email = "SELECT * FROM user WHERE id=".$id_pengguna;
    $email_pengguna = $pdo->query($user_email);
    $email_req = $email_pengguna->fetch(PDO::FETCH_ASSOC);

    try {
        $sql = "UPDATE user SET status='".$new_status."' WHERE id=".$id_pengguna;
        $hasil = $pdo->query($sql);
        try {
            $delete_sql = "DELETE FROM request_status WHERE id=".$reqId;
            $delete_hasil = $pdo->query($delete_sql);
            ubahStatus_log($_SESSION['email'], $email_req['email'], $new_status);
            header("Location:../user/master/list_request.php");
            exit();
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            $pdo = null;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    } finally {
        $pdo = null;
    }
} else if (isset($_GET['req']) && $_GET['req'] == 'tolak') {
    try {
        $delete_sql = "DELETE FROM request_status WHERE id=".$reqId;
        $delete_hasil = $pdo->query($delete_sql);
        header("Location:../user/master/list_request.php");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    } finally {
        $pdo = null;
    }
}
?>