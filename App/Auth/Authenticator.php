<?php

namespace App\Auth;

use App\Core\IAuthenticator;
use App\Models\User;

class Authenticator
{

    public function login($login, $password): bool
    {
        $users = User::getAll();
        foreach ($users as $user) {
            if ($user->getName() == $login && $user->getPassword() == $password) {
                $_SESSION['user'] = $login;
                return true;
            }
        }
        return false;
    }

    public function logout(): void
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            session_destroy();
        }
    }

    public function getLoggedUserName(): string
    {
        return $_SESSION['user'] ?? throw new \Exception("User not logged in");
    }

    public function getLoggedUserContext(): mixed
    {
        return null;
    }

    public function isLogged(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user'] != null;
    }

}