<?php

namespace App\Auth;

use App\Core\IAuthenticator;
use App\Models\User;

class Authenticator implements IAuthenticator
{

    public function login($login, $password): bool
    {
        try {
            $user = User::getAll("login = ?", [$login]);
        } catch (\Exception $e) {
            return false;
        }

        if (sizeof($user) != 1) {
            return false;
        }

        if (password_verify(password_hash($password, PASSWORD_DEFAULT), $user[0]->getPassword())) {
            $_SESSION["user"] = $login;
            return true;
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

    public function getLoggedUserId(): mixed
    {
        return $_SESSION['user'];
    }
}