<?php
    session_start();
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<header class="header">
    <a href="index.php" class="logo">Księgarnia</a>
    <nav class="navbar">
        <a href="ksiazki.php">Książki</a>
        <a href="#">Home</a>
        <a href="#">Home</a>
        <a href="koszyk.php">Koszyk</a>
        <?php if(isset($_SESSION['username']) && $_SESSION['username'] === 'admin'): ?>
            <a href="#">Admin</a>
        <?php endif; ?>
        <a href="logowanie.php"><span class="material-symbols-outlined" style="font-size: 30px;">account_circle</span></a>
        <?php if(isset($_SESSION['login']) && $_SESSION['login']): ?>
            <a><span class="material-symbols-outlined" id="logout" style="font-size: 30px;">logout</span></a>
        <?php endif; ?>
    </nav>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var destroyButton = document.getElementById('logout');
    if(destroyButton) {
        destroyButton.addEventListener('click', function() {
            fetch('logout.php')
            .then(function(response) {
                if(response.ok) {
                    console.log('Wylogowano');
                    location.reload();
                    alert("test")
                } else {
                    console.error('Nie udało się wylogować');
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
        });
    }
});
</script>