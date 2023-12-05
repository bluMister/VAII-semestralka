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
    <title>Title</title>
</head>
<body>
<nav class="navbar">
    <div class="container">
        <div class="logo">Logo</div>
        <ul class="nav-links">
            <li><a href=<?= $link->url("home.index") ?>>Home</a></li>
            <li><a href=<?= $link->url("home.movies") ?>>Movies</a></li>
            <li><a href=<?= $link->url("home.games") ?>>Games</a></li>
            <li><a href=<?= $link->url("home.music") ?>>Music</a></li>
            <li style = "margin-left: 250%"><a href=<?= $link->url("auth.login") ?>>Login</a></li>
        </ul>
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
