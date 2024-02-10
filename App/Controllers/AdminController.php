<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class AdminController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        return $this->app->getAuth()->isLogged();
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        $data = User::getAll();
        return $this->html($data);
    }

    public function update(): Response {

        foreach ($this->request()->getValue("admin[]") as $uid) {
            $user = User::getOne($uid);
            $user->setAdmin(true);
        }

        foreach ($this->request()->getValue("delete[]") as $uid) {
            $user = User::getOne($uid);
            $user->delete();
        }

        $data = User::getAll();

        return $this->json($data);
    }
}
