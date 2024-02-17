<?php
require_once "./class.Database.php";

final class AuthService 
{
    public static function login(string $username, string $password, string|null &$error): bool 
    {
        $connection = Database::getConnection();

        $stmt = $connection->prepare("SELECT `haslo` FROM konto WHERE `login` = ?");
        $stmt->bind_param("s", $username);

        if (!$stmt->execute()) {
            return false;
        }

        $result = $stmt->get_result();
        $stmt->close();

        if (!$result) {
            return false;
        }

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['haslo'])) {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['username'] = $username;
                header("Location: index.php");
            } else {
                $error = "Nieprawidłowy login lub hasło!";
                return false;
            }
        } else {
            $error = "Nieprawidłowy login lub hasło!";
            return false;
        }

        return true;
    }


    public static function register(string $username, string $password, string|null &$error): bool 
    {
        $connection = Database::getConnection();

        $stmt = $connection->prepare("SELECT COUNT(*) AS count FROM konto WHERE `login` = ?");
        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            return false;
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row['count'] > 0) {
            $error = "Użytkownik o podanej nazwie już istnieje!";
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $connection->prepare("INSERT INTO konto (`login`, `haslo`) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashedPassword);

        if (!$stmt->execute()) {
            $error = "Wystąpił problem podczas rejestracji użytkownika.";
            return false;
        }

        $stmt->close();

        return true;
    }


    public static function insertBook(string $title, string $description, string $author, string $genre, float $price, int $releaseYear, string $url, string|null &$error): bool
    {
        $connection = Database::getConnection();

        $stmt = $connection->prepare("INSERT INTO ksiazka (tytul, opis, autor, gatunek, cena, rok_wydania, `url`) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssids", $title, $description, $author, $genre, $price, $releaseYear, $url);

        if (!$stmt->execute()) {
            $error = "Nie udało się wprowadzić książki do bazy danych!.";
            return false;
        }

        $stmt->close();

        return true;
    }


    public static function getBooks(): array
    {
        $connection = Database::getConnection();
        
        $query = "SELECT * FROM ksiazka";
        
        $result = $connection->query($query);
        
        if (!$result) {
            return [];
        }
        
        $books = [];
        while ($row = $result->fetch_assoc()) {
            $book = new stdClass();
            $book->title = $row['tytul'];
            $book->description = $row['opis'];
            $book->author = $row['autor'];
            $book->genre = $row['gatunek'];
            $book->price = $row['cena'];
            $book->releaseYear = $row['rok_wydania'];
            $book->url = $row['url'];
            
            $books[] = $book;
        }
        
        return $books;
    }
}