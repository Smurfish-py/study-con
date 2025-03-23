<?php
session_start();

include "../../logika/koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit();
} else if ($_SESSION['status'] != 'teacher' || $_SESSION['status-akun'] == 'banned') {
    session_destroy();
    header("Location: ../../");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyCon | Study and Connect With Everyone!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body style="display: flex; align-items: center; justify-content: center; height: 100vh;">
    <main class="container" style="height: fit-content; width: 50vw; box-shadow: none; background-color: white; border: 1px solid rgba(0, 0, 0, 0.2); padding: 10px 80px 10px 60px;">
        <h2 class="inter-600" style="text-align: center;">BUAT SUBJEK</h2>
        <hr>
        <form action="../../logika/buat_tugas_logic.php" method="post" style="display: flex; gap: 10px; flex-direction: column; align-items: center; width: 100%;" enctype="multipart/form-data" >
            <input class="inter-400 input-kelas" type="hidden" name="id-kelas" value="<?php echo $_GET['id']?>"> 
            <div>
                <label class="inter-600" for="judul-subjek">Judul Subjek</label><br>
                <input class="inter-400 input-kelas" type="text" name="judul-subjek" id="judul-subjek" placeholder="Masukkan judul untuk subjek anda..." required> 
            </div>
            <div>
                <label class="inter-600" for="tipe-subjek">Tipe Subjek</label><br>
                <select class="inter-400 input-kelas" name="tipe-subjek" id="tipe-subjek" style="width: 530px;">
                    <option value="materi">Materi</option>
                    <option value="tugas">Tugas</option>
                </select>
            </div>
            <div>
               <label class="inter-600" for="deskripsi-subjek">Keterangan Subjek</label><br>
               <textarea class="inter-400 deskripsi-kelas" name="deskripsi-subjek" id="deskripsi-subjek" placeholder="Masukkan deskripsi untuk subjek anda.." style="width: 505px; height: 180px;" required></textarea>
            </div>
            <div>
                <p class="inter-600" style="margin: 0;">Upload File (Opsional)</p>
                <label class="inter-400 btn-pfp" for="file-subjek" style="color: black; width: 500px; text-align: center; border: 1px solid rgba(0, 0, 0, 0.5); border-radius: 7px; padding: 10px:">Klik disini untuk upload <i class="fa-solid fa-image"></i></label>
                <input type="file" name="file-subjek[]" id="file-subjek" multiple>
            </div>
            <input type="submit" value="Buat" class="inter-600 submit-kelas" style="width: 525px;">
        </form>
        <br>
        <a href="kelas.php?id=<?php echo $_GET['id']?>" class="inter-400" style="display: inline-block; text-decoration: none; color: black; width: 100%; text-align: center;">Kembali</a>
    </main>
    <script src=".p./assets/javascript/scripts.js"></script>
</body>
</html>