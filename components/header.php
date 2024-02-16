<?php
    session_start();
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<header class="header">    
    <a href="index.php" class="logo">Księgarnia</a>
    <nav class="navbar">
        <a href="ksiazki.php" class="nav-link">Książki</a>
        <a href="#" class="nav-link">Home</a>
        <a href="#" class="nav-link">Home</a>
        <a href="koszyk.php" class="nav-link">Koszyk</a>
        <?php if(isset($_SESSION['username']) && $_SESSION['username'] === 'admin'): ?>
            <a href="admin.php" class="nav-link">Admin</a>
        <?php endif; ?>
        <a href="logowanie.php" class="nav-link"><span class="material-symbols-outlined" style="font-size: 30px;">account_circle</span></a>
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
                    alert('Wylogowano')
                } else {
                    console.error('Nie udało się wylogować');
                    alert('Wystąpił błąd podczas wylogowania :(')
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
        });
    }
});


const currentUrl = window.location.href;

const navLinks = document.querySelectorAll('.nav-link');

navLinks.forEach(link => {
    if (link.href === currentUrl) {
        link.classList.add('current-page');
    }
});
</script>