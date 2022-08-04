<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="pessoa">LOGO</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-link-font-size active me-3" aria-current="page" href="pessoa">Pessoas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-font-size me-3" href="sala-de-eventos">Sala de eventos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-font-size" href="espaco-de-cafe">Espaço de café</a>
                </li>
            </ul>
            <div class="division ms-3 me-3">.</div>
            <span class="d-flex align-items-center"><i class='bx bxs-user-circle me-2' style="font-size:20px;"></i> <?= $_SESSION['usuario'] ?></span>
        </div>
    </div>
</nav>