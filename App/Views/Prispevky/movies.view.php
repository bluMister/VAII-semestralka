<?php

use \App\Models\Prispevky;
/** @var Prispevky[] $data */
/** @var App\Core\IAuthenticator $auth */

?>
<div class="container3">
    <div class="news-cards">
        <?php foreach (Prispevky::getAll() as $prispevok): ?>
        <div class="card">
            <img src="<?= '/' . $prispevok->getObrazok() ?>" alt="...">
            <h2><?= $prispevok->getNazov() ?></h2>
            <p><?= $prispevok->getText() ?></p>
            <a href="#" class="read-more">Read More</a>
        </div>
        <?php endforeach; ?>
        <div class="card">
            <img src="/public/images/thumbnail.jpg" alt="News 2">
            <h2>News Title 2</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim fermentum...</p>
            <a href="#" class="read-more">Read More</a>
        </div>

    </div>
</div>


