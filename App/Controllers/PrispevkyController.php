<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Prispevky;

class PrispevkyController extends AControllerBase
{
    public function index(): Response
    {
        return $this->html();
    }
    public function add() : Response
    {
        if ($this->request()->getValue('id')) {

            $newPost = new Prispevky();
            $newPost->setNazov($this->request()->getValue('nazov'));
            $newPost->setText($this->request()->getValue('text'));
            $newPost->setPicture($this->request()->getValue('obrazok'));

            $newPost->save();

            return $this->redirect("?");
        }
        return $this->html();
    }

    public function edit() : response {

        return $this->html();
    }
}