<?php

/** @var string $contentHTML */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="container2">
    <div class="box">
        <a href=<?= $link->url("home.movies") ?>>
            <img src="/public/images/mov.jpg" alt="Image 1">
            <div class="box-overlay">
                <p>Movies</p>
            </div>
        </a>
    </div>
    <div class="box">
        <a href=<?= $link->url("home.games") ?>>
            <img src="/public/images/gam.png" alt="Image 2">
            <div class="box-overlay">
                <p>Games</p>
            </div>
        </a>
    </div>
    <div class="box">
        <a href=<?= $link->url("home.music") ?>>
            <img src="/public/images/mus.jpg" alt="Image 3">
            <div class="box-overlay">
                <p>Music</p>
            </div>
        </a>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="contact-info">
            <h3>Contact Us</h3>
            <p>Email: contact@example.com</p>
            <p>Phone: +421 420 419 469</p>
        </div>
    </div>
</footer>
