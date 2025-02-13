<?php
/** @var Array $data
 * @var \App\Core\LinkGenerator $link
 */
 ?>
<form action="<?= $link->url("prispevky.add") ?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" >

    <input type="hidden" name="id" value="<?= @$data?->getId() ?>">

    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?= @$data?->getNazov() ?>" required>

    <label for="text">Text:</label>
    <textarea id="text" name="text" rows="4"  required><?= @$data?->getText() ?></textarea>

    <label>Choose category:</label>
    <div class="checkbox-group">
        <input type="checkbox" id="option1" name="kat" value="1" onchange="uncheckOthers('option1')" <?php if (@$data?->getKategoria() == 1){ ?>checked="checked" <?php } ?>>
        <label for="option1">Movie</label>

        <input type="checkbox" id="option2" name="kat" value="2" onchange="uncheckOthers('option2')" <?php if (@$data?->getKategoria() == 2){ ?>checked="checked" <?php } ?>>
        <label for="option2">Game</label>

        <input type="checkbox" id="option3" name="kat" value="3" onchange="uncheckOthers('option3')" <?php if (@$data?->getKategoria() == 3){ ?>checked="checked" <?php } ?>>
        <label for="option3">Music</label>
    </div>

        <label for="file-input"> Upload Image</label>
        <input type="file" id="text" name="image">


    <button type="submit">Submit</button>
</form>
