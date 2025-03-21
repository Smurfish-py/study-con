<?php
function login_log($new_email, $new_username){
    include "koneksi.php";
    $query = "INSERT INTO website_log (log) VALUES (:log)";
    $stmt = $pdo->prepare($query);
    $log_message = htmlspecialchars("$new_email telah membuat akun dengan nama $new_username", ENT_QUOTES, 'UTF-8');
    $stmt->execute([':log' => $log_message]);
}

function ubahStatus_log($pelaku, $diubah, $status){
    include "koneksi.php";
    $query = "INSERT INTO website_log (log) VALUES (:log)";
    $stmt = $pdo->prepare($query);
    $log_message = htmlspecialchars("$pelaku telah mengubah status $diubah menjadi $status", ENT_QUOTES, 'UTF-8');
    $stmt->execute([':log' => $log_message]);
}

function generateIdKelas($pdo) {
    do {
        $randomNumber = random_int(1000, 99999);

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM kelas WHERE id = ?");
        $stmt->execute([$randomNumber]);
        $exists = $stmt->fetchColumn();
    } while ($exists > 0);

    return $randomNumber;
}
?>