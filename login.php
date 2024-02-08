<?php
require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $db = new dbh();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT `haslo` FROM konto WHERE `login` = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['haslo'])) {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['username'] = $login;
            header("Location: index.php");
            exit();
        } else {
            echo "Nieprawidłowe hasło!";
        }
    } else {
        echo "Nieprawidłowy login!";
    }

    $stmt->close();
    $conn->close();
}
?>