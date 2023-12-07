<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\HTTPException;
use App\Core\Model;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;

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
        $foods = Prispevky::getAll();
        return $this->html($foods);
    }

    /**
     * @throws \Exception
     */
    public function add() {
        $id = $this->request()->getValue("id");
        $data = [];
        if ($id) {
            $food = Prispevky::getOne($id);
            if (!$food) {
                return $this->redirect("?c=Homes");
            }
            $data["action"] = "Upraviť";
        } else {
            $food = new Prispevky();
            $data["action"] = "Pridať";
        }
        $text = $this->request()->getValue("text");
        $title = $this->request()->getValue("title");
        $obrazok = $this->request()->getValue("image");
        $category = $this->request()->getValue("kat");
        $food->setNazov($text);
        $food->setText($title);
        $food->setObrazok($obrazok);
        $food->setKategoria($category);
        if ($text && $title) {
            $food->save();
            return $this->redirect("?c=Home");
        } else {
            $data["food"] = $food;
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
        $foodToEdit = Prispevky::getOne($id);
        return $this->html($foodToEdit, viewName: "add.form");
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
        return $this->html();
    }
    public function games(): Response
    {
        return $this->html();
    }
    public function music(): Response
    {
        return $this->html();
    }
    public function postMaker(): Response
    {
        return $this->html();
    }
}