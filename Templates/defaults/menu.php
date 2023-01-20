<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">
            Sportcenter
        </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="/categories">Sport apparaten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>
            </ul>
            <?php if(isAdmin()): ?>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link"  href="/logout">Uitloggen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/member">Mijn account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/profile">Admin</a>
                </li>
            </ul>
            <?php elseif(isMember()): ?>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link"  href="/logout">Uitloggen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/member">Mijn account</a>
                </li>
            </ul>
            <?php else: ?>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link"  href="/register">Registreren</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Inloggen</a>
                </li>
            </ul>
            <?php endif ?>
        </div>
    </div>
</nav>