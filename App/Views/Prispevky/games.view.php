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
                <?php if ($auth->isLogged()) { ?>
                    <a href="?c=Prispevky&a=delete&id=<?php echo $prispevok->getId() ?>" class="read-more">Delete</a>
                    <a href="?c=Prispevky&a=edit&id=<?php echo $prispevok->getId() ?>" class="read-more"> Edit</a>
                <?php } ?>
            </div>
        <?php endforeach; ?>
        <div class="card">
            <img src="/public/images/thumbnail2.png" alt="News 1">
            <h2>News Title 1</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim fermentum...</p>
            <a href="#" class="read-more">Read More</a>
        </div>
        <div class="card">
            <img src="/public/images/thumbnail2.png" alt="News 2">
            <h2>News Title 2</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim fermentum...</p>
            <a href="#" class="read-more">Read More</a>
        </div>
        <div class="card">
            <img src="/public/images/thumbnail2.png" alt="News 2">
            <h2>News Title 2</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim fermentum...</p>
            <a href="#" class="read-more">Read More</a>
        </div>
        <div class="card">
            <img src="/public/images/thumbnail2.png" alt="News 2">
            <h2>News Title 2</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim fermentum...</p>
            <a href="#" class="read-more">Read More</a>
        </div>
        <div class="card">
            <img src="/public/images/thumbnail2.png" alt="News 2">
            <h2>News Title 2</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim fermentum...</p>
            <a href="#" class="read-more">Read More</a>
        </div>
        <!-- Add more cards as needed -->
    </div>
</div>
