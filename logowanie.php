<?php
require_once './class.AuthService.php';

if (isset($_POST["submit"])) {
    $username = trim($_POST["login"]);
    $password = trim($_POST["password"]);

    $error = null;

    if (!AuthService::login($username, $password, $error)) {
        if ($error) {
            echo $error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/account.css">
    <title>Logowanie</title>
</head>
<body>
    <?php require_once "./components/header.php"; ?>
    <div class="login">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="header-form">
                <h1>Logowanie</h1><br>
            </div>
            <div class="input-form">
                <input type="text" class="input-field" placeholder="Login" autocomplete="off" id="login" name="login"><br><br>
                <input type="password" class="input-field" placeholder="Hasło" autocomplete="off" id="password" name="password"><br><br>
            </div>
            <div class="submit-form">
                <input type="submit" class="submit-button" value="Zaloguj" name="submit"><br><br>
            </div>
            <div class="acc-link">
                <p>Nie posiadasz konta? <a href="rejestracja.php">Stwórz konto</a></p>
            </div>
        </form>
    </div>
</body>
</html>