<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/ksiazki.css">
    <title>Książki</title>
</head>
<body>
    <?php require_once "./components/header.php"; ?>
    <main>
        <div class="genres">
            <ul class="nav-list">
                <h2>Gatunki</h2><br>
                <li><a href="#Kryminaly" class="nav-ksiazki">Kryminały</a></li>
                <li><a href="#Thriller" class="nav-ksiazki">Thrillery</a></li>
                <li><a href="#Przygodowe" class="nav-ksiazki">Przygodowe</a></li>
                <li><a href="#Komedie" class="nav-ksiazki">Komedie</a></li>
                <li><a href="#Fantasy" class="nav-ksiazki">Fantasy</a></li>
            </ul>
        </div>
        <div class="book-container">
        <?php
        require_once "./class.AuthService.php";
        $books = AuthService::getBooks();
        foreach ($books as $book) {
            ?>
            <div class="book-card">
                <img src="<?php echo $book->url; ?>" alt="Okładka książki" class="book-img">
                <p><strong>Tytuł:</strong> <?php echo $book->title; ?></p>
                <p><strong>Autor:</strong> <?php echo $book->author; ?></p>
                <p><strong>Cena:</strong> <?php echo $book->price; ?>zł</p>
            </div><!--no zrobic trzeba ze mozna kliknac w calego carda (srodek diva zawinac w buttona czy cos i potem z tablicy jakos to zrobic???)-->
            <?php
        }
        ?>
    </main>
</div>
</body>
</html>

<script>
        const currentUrl = window.location.href;

        const navLinks = document.querySelectorAll('.nav-ksiazki');

        navLinks.forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add('current-page');
            }
        });
</script>