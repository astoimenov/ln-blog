<nav class="main">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <ul id="main-nav" class="collapse navbar-collapse">
            <li class="<?= str_is(Request::path(), '/') ? 'active' : '' ?>">
                <a href="/posts">Начало</a>
            </li>
            <li class="<?= str_contains(Request::path(), 'categories/na-fokus') ? 'active' : '' ?>">
                <a href="#">Категория 1</a>
            </li>
            <li class="<?= str_contains(Request::path(), 'categories/na-fokus') ? 'active' : '' ?>">
                <a href="#">Категория 2</a>
            </li>
            <li class="<?= str_contains(Request::path(), 'categories/na-fokus') ? 'active' : '' ?>">
                <a href="#">Категория 3</a>
            </li>
            <li class="<?= str_contains(Request::path(), 'categories/na-fokus') ? 'active' : '' ?>">
                <a href="#">Категория 4</a>
            </li>
            <li class="<?= str_contains(Request::path(), 'categories/na-fokus') ? 'active' : '' ?>">
                <a href="#">Категория 5</a>
            </li>
            <li class="<?= str_contains(Request::path(), 'categories/na-fokus') ? 'active' : '' ?>">
                <a href="#">Категория 6</a>
            </li>
            <li class="<?= str_contains(Request::path(), 'categories/na-fokus') ? 'active' : '' ?>">
                <a href="#">Категория 7</a>
            </li>
            <li class="<?= str_contains(Request::path(), 'categories/na-fokus') ? 'active' : '' ?>">
                <a href="#">Категория 8</a>
            </li>
        </ul>
    </div>
</nav>
