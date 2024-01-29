class CustomHeader extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <header class="header">
            <a href="index.html" class="logo">Księgarnia</a>

            <nav class="navbar">
                <a href="ksiazki.html">Książki</a>
                <a href="#">Home</a>
                <a href="#">Home</a>
                <a href="#">Home</a>
                <a href="#"><span class="material-symbols-outlined" style="font-size: 35px;">account_circle</span></a>
            </nav>
        </header>
    `
    }
}

customElements.define('custom-header', CustomHeader)