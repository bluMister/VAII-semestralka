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
    <div class="nav-container">
        <div class="logo">Logo</div>
        <div class="nav-links">
            <a href=<?= $link->url("home.index") ?>>Home</a>
            <a href=<?= $link->url("prispevky.movies") ?>>Movies</a>
            <a href=<?= $link->url("prispevky.games") ?>>Games</a>
            <a href=<?= $link->url("prispevky.music") ?>>Music</a>
            <?php if ($auth->isLogged() && $auth->isAdmin()) { ?>
                <a href=<?= $link->url("prispevky.postMaker") ?>>new</a>
            <?php } ?>
            <?php if ($auth->isLogged()) { ?>
                    <a href="?c=auth&a=logout" class="right-align">Logout</a>
                <?php } else { ?>
                    <a href="?c=auth&a=login" class="right-align">Login</a>
                <?php } ?>
        </di>
        <div class="mobile-menu-toggle">&#9776;</div
    </div>
</nav>
<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>
</body>
</html>

