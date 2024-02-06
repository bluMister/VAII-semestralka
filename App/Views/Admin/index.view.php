<?php

use \App\Models\User;
$layout = 'auth';
/** @var \App\Core\IAuthenticator $auth
 * @var User[] $data
 * @var \App\Core\LinkGenerator $link
 * */ ?>

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

<h1>User Management</h1>
<form action="update_users.php" method="post">
    <table>
        <tr>
            <th>Username</th>
            <th>Is Admin</th>
        </tr>
        <?php foreach ($data as $user): ?>
            <tr>
                <td><?php echo $user->getMeno(); ?></td>
                <td><input type="checkbox" name="admin[]" value="<?php echo $user->getId(); ?>" <?php echo $user->getAdmin() ? 'checked' : ''; ?>></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <input type="submit" value="Submit">
</form>