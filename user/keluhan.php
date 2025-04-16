<?php
include "../logika/koneksi.php";

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
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="inter-400 keluhan">
     <form action="../logika/keluhan_logic.php" method="post">
        <div class="form-container">
            <h2 style="text-align: center;">Form Masukan dan Keluhan<br><span class="inter-400 font-size-l">Silahkan keluhkan masalah atau masukan anda di halaman ini. <br> Gunakan bahasa yang baik dan sopan.</span></h2>
            <hr>
            <h4 class="inter-400">Pilih tipe masukan (Pilih salah satu)</h4>
            <input type="radio" name="pilihan" id="pesan" value="pesan" required>
            <label for="pesan">Pesan</label>

            <input type="radio" name="pilihan" id="keluhan" value="keluhan">
            <label for="keluhan">Keluhan</label>

            <input type="radio" name="pilihan" id="saran" value="saran">
            <label for="saran">Saran</label>
            <br>
            <br>
            <label for="email">Masukkan Email Anda : </label>
            <input type="email" name="email" id="email" placeholder="myemail@website.com" required>
            <br>
            <br>
            <div style="display: flex; align-items: center;">
               <label for="isi-keluhan">Ketikkan keluhan anda disini : </label>
               <textarea name="isi-keluhan" id="isi-keluhan" placeholder="Cth : Halo, Saya melupakan password saya...." style="max-height: 100px; max-width: 250px; min-height: 70px; min-width: 150px; margin-left: 10px;" required></textarea> 
            </div>
            <br>
            <button type="reset">Reset</button>
            <button type="submit">Kirim!</button>
            <hr>
        </div>
     </form>
</body>
<script src="../assets/javascript/scripts.js"></script>
</html>