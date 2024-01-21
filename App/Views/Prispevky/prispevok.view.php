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
<div class="comments-container">
    <h2>Comments</h2>
    <?php foreach ($data["comments"] as $comment): ?>
        <div class="comment-one">
            <h3><?= @$comment?->getAuthor() ?></h3>
            <p><?= @$comment?->getText() ?></p>
        </div>
    <?php endforeach; ?>
</div>


