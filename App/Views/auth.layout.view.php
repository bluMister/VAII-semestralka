<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <script src="public/js/script.js"></script>
    <title>Pop some help!</title>
</head>
<body>
<nav class="navbar">
    <div class="container">
        <div class="logo">Logo</div>
        <ul class="nav-links">
            <li><a href=<?= $link->url("home.index") ?>>Home</a></li>
            <li><a href=<?= $link->url("prispevky.movies") ?>>Movies</a></li>
            <li><a href=<?= $link->url("prispevky.games") ?>>Games</a></li>
            <li><a href=<?= $link->url("prispevky.music") ?>>Music</a></li>
            <?php if ($auth->isLogged()) { ?>
                <li><a href=<?= $link->url("prispevky.postMaker") ?>>new</a></li>
            <?php } ?>
            <li class="right-align"><?php if ($auth->isLogged()) { ?>
                    <a href="?c=auth&a=logout" class="active">Logout</a>
                <?php } else { ?>
                    <a href="?c=auth&a=login" class="active">Login</a>
                <?php } ?></li>
        </ul>
        <div class="mobile-menu-toggle">&#9776;</div
    </div>
</nav>
<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>
</body>
<footer class="footer">
    <div class="container">
        <div class="contact-info">
            <h3>Contact Us</h3>
            <p>Email: contact@example.com</p>
            <p>Phone: +421 420 419 469</p>
        </div>
    </div>
</footer>
</html>

