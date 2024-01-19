<?php

use \App\Models\Prispevky;
/** @var Prispevky[] $data */
/** @var App\Core\IAuthenticator $auth */

?>
<div class="container3">
    <div class="news-cards">
        <?php foreach ($data as $prispevok): ?>
            <div class="card">
                <img src="<?= '/' . $prispevok->getObrazok() ?>" alt="...">
                <h2><?= $prispevok->getNazov() ?></h2>
                <p><?= $prispevok->getText() ?></p>
                <a href="?c=Prispevky&a=display&id=<?php echo $prispevok->getId() ?>" class="read-more">Read More</a>
                <?php if ($auth->isLogged()) { ?>
                    <a href="?c=Prispevky&a=delete&id=<?php echo $prispevok->getId() ?>" class="read-more">Delete</a>
                    <a href="?c=Prispevky&a=edit&id=<?php echo $prispevok->getId() ?>" class="read-more"> Edit</a>
                <?php } ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
