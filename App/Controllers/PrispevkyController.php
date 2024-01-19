<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\HTTPException;
use App\Core\Model;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;

use App\Models\Comment;
use http\Exception;
use PDO;
use App\Models\Prispevky;

class PrispevkyController extends AControllerBase
{
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        $posts = Prispevky::getAll();
        return $this->html($posts);
    }

    /**
     * @throws \Exception
     */
    public function add() {
        $id = $this->request()->getValue("id");
        $data = [];
        if ($id) {
            $post = Prispevky::getOne($id);
            if (!$post) {
                return $this->redirect("?c=Homes");
            }
            $data["action"] = "Upraviť";
        } else {
            $post = new Prispevky();
            $data["action"] = "Pridať";
        }
        $text = $this->request()->getValue("text");
        $title = $this->request()->getValue("title");
        $obrazok = $this->request()->getValue("image");
        $category = $this->request()->getValue("kat");
        $post->setNazov($title);
        $post->setText($text);
        $post->setObrazok($obrazok);
        $post->setKategoria($category);
        if ($text && $title) {
            $post->save();
            return $this->redirect("?c=Home");
        } else {
            $data["prispevky"] = $post;
            if (!$text) {
                $data["errors"]["text"] = "text musí byť vyplnený";
            }
            if (!$title) {
                $data["errors"]["title"] = "nazov musí byť vyplnená";
            }
            return $this->html($data, viewName: "add.form");
        }
    }


    public function edit() {
        $id = $this->request()->getValue("id");
        $postToEdit = Prispevky::getOne($id);
        return $this->html($postToEdit, viewName: "postMaker");
    }

    public function display() {
        $id = $this->request()->getValue("id");
        $post = Prispevky::getOne($id);
        $comments = Comment::getAll();
        return $this->html(["post" => $post, "comments" => $comments], viewName: "prispevok");
    }

    public function delete() {
        $id = $this->request()->getValue("id");
        $foodToDelete = Prispevky::getOne($id);
        if ($foodToDelete) {
            $foodToDelete->delete();
        }
        return $this->redirect("?c=Home");
    }

    public function movies(): Response
    {
        $posts = Prispevky::getAll();
        return $this->html($posts);
    }
    public function games(): Response
    {
        $posts = Prispevky::getAll();
        return $this->html($posts);
    }
    public function music(): Response
    {
        $posts = Prispevky::getAll();
        return $this->html($posts);
    }
    public function postMaker(): Response
    {
        return $this->html();
    }
}