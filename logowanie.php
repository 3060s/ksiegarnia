<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Logowanie</title>
    <script type="module" src="js/main.js"></script>
</head>
<body>
    <custom-header></custom-header>
    <div class="login">
        <form action="login.php" method="post">
            <div class="header-form">
                <h1>Logowanie</h1><br>
            </div>
            <div class="input-form">
                <input type="text" class="input-field" placeholder="Login" autocomplete="off" id="login" name="login"><br><br>
                <input type="password" class="input-field" placeholder="Hasło" autocomplete="off" id="password" name="password"><br><br>
            </div>
            <div class="submit-form">
                <input type="submit" class="submit-button" value="Zaloguj"><br><br>
            </div>
            <div class="acc-link">
                <p>Nie posiadasz konta? <a href="rejestracja.php">Stwórz konto</a></p>
            </div>
        </form>
    </div>
</body>
</html>