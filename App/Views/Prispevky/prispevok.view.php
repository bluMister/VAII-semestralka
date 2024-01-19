<?php
/** @var Array $data
 * @var \App\Core\LinkGenerator $link
 */
?>

<div class="review-container">
    <div class="review-text">
        <h2><?= @$data["post"]?->getNazov() ?></h2>
        <p><?= @$data["post"]?->getText() ?></p>
    </div>
    <img class="review-image" src="<?= @$data["post"]?->getObrazok() ?>" alt="">
</div>


