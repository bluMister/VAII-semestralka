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
<div class="comments-container" data-parent-id="<?= @$data["post"]?->getId() ?>">
    <h2>Comments</h2>
    <?php foreach ($data["comments"] as $comment): ?>
        <div class="comment-one" data-comment-id="<?= $comment->getId() ?>">
            <h3><?= htmlspecialchars($comment->getAuthor()) ?></h3>
            <p><?= nl2br(htmlspecialchars($comment->getText())) ?></p>

            <!-- Reply Form -->
            <form class="reply-form" action="<?= $link->url("prispevky.addReply") ?>" method="post">
                <input type="text" name="reply" placeholder="Your Reply" required>
                <button type="submit">Reply</button>
            </form>

            <!-- Display Replies -->
            <div class="replies-container">
                <?php foreach ($data["replies"] as $reply): ?>
                    <div class="comment-one">
                        <h3><?= $reply->getAuthor() ?></h3>
                        <p><?= nl2br(htmlspecialchars($reply->getText())) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Comment Form -->
    <form id="comment-form" action="<?= $link->url("prispevky.addComment") ?>" method="post">
        <input type="hidden" name="pid" value="<?= @$data["post"]?->getId() ?>">
        <input type="text" name="comment" placeholder="Your Comment" required>
        <button type="submit">Post Comment</button>
    </form>
</div>


