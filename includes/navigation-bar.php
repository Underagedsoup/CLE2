<ul class="col-md-12 nav p-0 d-flex justify-content-around align-items-center">
    <li class="nav-brand">
        <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/CLE/">
            <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/CLE/images/SRDC-Logo.png" alt="">
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-maroon" href="http://<?= $_SERVER['HTTP_HOST']; ?>/CLE/schedule">Lessen</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-maroon" href="#">Workshops</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-maroon" href="http://<?= $_SERVER['HTTP_HOST']; ?>/CLE/parties">Parties</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-maroon" href="#">Shows</a>
    </li>
    <?php if (isset($_SESSION['user'])) { ?>
        <li class="nav-item dropdown">
            <a class="nav-link text-maroon dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Admin</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Profiel</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="http://<?= $_SERVER['HTTP_HOST']; ?>/CLE/logout.php?user=<?= $_SESSION['user']; ?>">Uitloggen</a></li>
            </ul>
        </li>
    <?php } else { ?>
        <li class="nav-item">
            <a class="nav-link text-maroon" href="http://<?= $_SERVER['HTTP_HOST']; ?>/CLE/login.php">Inloggen</a>
        </li>
    <?php } ?>
</ul>