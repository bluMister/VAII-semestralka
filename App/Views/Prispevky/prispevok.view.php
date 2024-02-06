<?php
/** @var Array $data
 * @var \App\Core\LinkGenerator $link
 * @var App\Core\IAuthenticator $auth
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
            <?php if ($auth->isLogged()) { ?>
            <form class="reply-form" action="<?= $link->url("prispevky.addReply") ?>" method="post">
                <input type="text" name="reply" placeholder="Your Reply" required>
                <button type="submit">Reply</button>
            </form>
            <?php } else {?>
            <p>For replying to comments, you must <a href="?c=auth&a=login" class="active">log in</a> first!</p>
            <?php } ?>
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
    <?php if ($auth->isLogged()) { ?>
    <form id="comment-form" action="<?= $link->url("prispevky.addComment") ?>" method="post">
        <input type="hidden" name="pid" value="<?= @$data["post"]?->getId() ?>">
        <input type="text" name="comment" placeholder="Your Comment" required>
        <button type="submit">Post Comment</button>
    </form>
    <?php } else {?>
        <p>For commenting a review, you must <a href="?c=auth&a=login" class="active">log in</a> first!</p>
    <?php } ?>
</div>


