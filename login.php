<?php
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('804773744896-eo2omb1dn7u8q035ms1pbgkim3k8h7v0.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/StudyCon/logika/google-login/callback.php');
$client->addScope('email');
$client->addScope('profile');

$login_url = $client->createAuthUrl();
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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
</head>
<body>
    <main class="center-page" style="height: 100vh;">
        <div class="container" style="height: 500px; width: 900px; display: flex; background-color: white; border: solid; border-color:rgb(235, 235, 235);">
            <div class="left-side" style="width: 450px;  ">
                <h1 class="inter-600" style="text-align: right; margin: 50px 40px;">WELCOME<br>BACK!</h1>
                <form  action="logika/login_logic.php" method="post" style="margin: 0 50px;">
                    <label class="inter-500" for="email" style="display: block;">E-mail</label>
                    <input class="inter-400 input-text" type="email" id="email" name="email" placeholder="your-email@gmail.com" required>
                    <br><br>
                    <label class="inter-500" for="password" style="display: block;">Password</label>
                    <input class="inter-400 input-text" type="password" id="password" name="password" placeholder="admin#1234" required>
                    <input type="text" style="display: none;" name="hiddenlink" value="../../login.php">
                    <br><br><br>

                    <div class="submit-area" style="max-width: 310px;">
                        <a class="inter-400 font-size-md" href="" style="text-decoration: none; color: black;">Lupa password?</a>
                        <div class="login-choice" style="display: flex; flex-direction: column; height: 100px; gap: 5px;">
                            <button class="inter-700 font-size-l submit-button" style="display: box; border: none;" type="submit">LOGIN</button>
                            <a href="<?php echo $login_url?>" class="inter-700 font-size-l google-button" style="display: box; border: none; text-align: center;" type="submit"><span><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTd7YDW4zLa_XjVZewhUPT6UdhdvScrAbvXGLy3ZIJHVqcT7JYtemSdQRhYyiQto6USWxDXW1rIi5MolUO5gNsFAMX0LZqbRNibdGMZX2g" alt="" srcset="" style="height: 20px; width: 20px; object-fit: cover;"></span> LOGIN WITH GOOGLE</a>
                        </div>
                        
                        <p class="inter-400 font-size-md" style="text-align: center; margin: 0;">Belum menjadi anggota? Ayo <a class="inter-900" href="register.php" style="text-decoration: none; color: black;">Daftar</a> Sekarang!</p>
                    </div>
                </form>
            </div>
            <div style="background-color: #000000; width: 450px; color: white; border-top-right-radius: 34px;
    border-bottom-right-radius: 34px;">
                <h1 class="inter-600" style="margin: 50px 40px;">LET'S<br>LOGIN</h1>
            </div>
        </div>
    </main>
</body>
</html>