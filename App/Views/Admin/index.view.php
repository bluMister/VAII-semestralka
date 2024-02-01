<?php

$layout = 'auth';
/** @var \App\Core\IAuthenticator $auth */ ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div>
                Vitaj, <strong><?= $auth->getLoggedUserName() ?></strong>!<br><br>
                Táto časť aplikácie je prístupná len pre administrátora.
            </div>
        </div>
    </div>
</div>