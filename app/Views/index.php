<header>
    <!-- navbar -->
    <nav class="navbar fixed-top navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <a class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav-res" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </a>
            <div class="collapse navbar-collapse" id="nav-res">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->
</header>
<main style="padding-top: 60px;">
    <h1>Hello <?= getName() ?></h1>

    <ul>
        <?php foreach ($users as $key => $value) : ?>
            <li><?= $key + 1 ?> | <?= 'Nama : ' . $value->username . ' Password : ' . $value->password ?></li>
        <?php endforeach ?>
    </ul>

    <div id="button-container"></div>

    <div id="state-1"></div>
    <div id="state-2"></div>
</main>