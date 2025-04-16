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
                    <br><br><br><br>

                    <div class="submit-area" style="max-width: 310px;">
                        <a class="inter-400 font-size-md" href="" style="text-decoration: none; color: black;">Lupa password?</a>
                        <button class="inter-700 font-size-l submit-button" style="display: box; border: none;" type="submit">LOGIN</button>
                        <p class="inter-400 font-size-md" style="text-align: center;">Belum menjadi anggota? Ayo <a class="inter-900" href="register.php" style="text-decoration: none; color: black;">Daftar</a> Sekarang!</p>
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