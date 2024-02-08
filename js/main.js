class CustomHeader extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <header class="header">
            <a href="index.php" class="logo">Księgarnia</a>

            <nav class="navbar">
                <a href="ksiazki.php">Książki</a>
                <a href="#">Home</a>
                <a href="#">Home</a>
                <a href="koszyk.php">Koszyk</a>
                <a href="logowanie.php"><span class="material-symbols-outlined" style="font-size: 35px;">account_circle</span></a>
            </nav>
        </header>
    `
    }
}

customElements.define('custom-header', CustomHeader)