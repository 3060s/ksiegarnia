<?php
session_start();

if(isset($_SESSION['username']) && $_SESSION['username'] === 'admin') 
{
    error_reporting(E_ALL & ~E_NOTICE);
} 
else
{
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin</title>
</head>
<body>
    <?php require_once "./components/header.php"; ?>
    <div class="insert">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="header-form">
                <h1>Dodawanie książki</h1><br>
            </div>
            <div class="input-form">
                <input type="text" class="input-field" placeholder="Tytuł" autocomplete="off" id="tytul" name="tytul" maxlength="50"><br><br>
                <input type="text" class="input-field" placeholder="Autor" autocomplete="off" id="autor" name="autor" maxlength="50"><br><br>
                <input type="text" class="input-field" placeholder="Cena (kropka)" autocomplete="off" id="cena" name="cena" maxlength="7"><br><br>
                <input type="text" class="input-field" placeholder="Rok wydania" autocomplete="off" id="rok_wydania" name="rok_wydania" maxlength="4"><br><br>
            </div> <!--No trzeba dodac input z urlem do zdjecia jakis empik czy cos xd-->
            <div class="opis">
                <textarea class="input-field" placeholder="Opis" autocomplete="off" id="opis" name="opis" maxlength="500"></textarea><br><br>
            </div>
            <div class="submit-form">
                <input type="submit" class="submit-button" value="Wprowadź książke" name="submit"><br><br>
            </div>
        </form>
    </div>
</body>
</html>

<script>
        document.addEventListener("DOMContentLoaded", function() {
            var textarea = document.getElementById("opis");

            var charCount = document.createElement("div");
            charCount.id = "charCount";
            charCount.textContent = "Zostało " + textarea.maxLength + " znaków!";
            textarea.parentNode.appendChild(charCount);

            textarea.addEventListener("input", function() {
                var remainingChars = textarea.maxLength - textarea.value.length;
                charCount.textContent ="Zostało " + remainingChars + " znaków!";
            });
        });  
</script>

<?php
session_start();

require_once "./class.AuthService.php";

if (isset($_POST['submit'])) {
    $title = $_POST['tytul'];
    $description = $_POST['opis'];
    $author = $_POST['autor'];
    $price = $_POST['cena'];
    $releaseYear = $_POST['rok_wydania'];


    $error = null;
    if (AuthService::insertBook($title, $description, $author, $price, $releaseYear, $error)) {
        echo "Poprawnie wprowadzono książke do bazy danych.";
    } else {
        echo "Error: " . $error;
    }
}
?>