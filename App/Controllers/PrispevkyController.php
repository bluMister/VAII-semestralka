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
use App\Models\Reply;
use http\Exception;
use PDO;
use App\Models\Prispevky;
use App\Core\IAuthenticator;


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
        $text = nl2br(htmlspecialchars($this->request()->getValue("text")));
        $title = $this->request()->getValue("title");
        $obrazok = FileStorage::saveFile($this->request()->getFiles()['image']);
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
        $comments = Comment::getAll("post_id = $id");
        /** @var Reply[] $replies */

        foreach ($comments as $com){
            $cid = $com->getId();
            $replies = Reply::getAll("comment_id = $cid");
        }

        if(empty($replies)){
            $replies = [];
        }

        return $this->html(["post" => $post, "comments" => $comments, "replies" => $replies], viewName: "prispevok");
    }

    public function delete() {
        $id = $this->request()->getValue("id");
        $postToDelete = Prispevky::getOne($id);
        $cat = $postToDelete->getKategoria();
        if ($postToDelete) {
            $postToDelete->delete();
        }
        $posts = Prispevky::getAll("kategoria = $cat");
        return $this->html($posts, "movies");
    }

    public function addComment() {

        $text = $this->request()->getValue("comment");
        $pid = $this->request()->getValue("pid");

        $comment = new Comment();
        $comment->setAuthor($this->app->getAuth()->getLoggedUserName());
        $comment->setText($text);
        $comment->setPostId($pid);
        $comment->save();

        //$comments = Comment::getAll("post_id = $postID");
        //return $this->json($comments);
    }

    public function addReply() {
        $comID = $this->request()->getValue("id");
        $formData = $this->app->getRequest()->getPost();
        $text = $formData["comment"];

        $reply = new Reply();
        $reply->setAuthor($this->app->getAuth()->getLoggedUserName());
        $reply->setText($text);
        $reply->setCommentId($comID);
        $reply->save();

    }

    public function movies(): Response
    {
        $posts = Prispevky::getAll("kategoria = 1");

        return $this->html($posts);
    }
    public function games(): Response
    {
        $posts = Prispevky::getAll("kategoria = 2");
        return $this->html($posts);
    }
    public function music(): Response
    {
        $posts = Prispevky::getAll("kategoria = 3");
        return $this->html($posts);
    }
    public function postMaker(): Response
    {
        return $this->html();
    }
    private function handleNewFileName(?string $oldFileName) : ?string
    {
        $resultName = $oldFileName;
        $newFileName = $this->request()->getFiles()['pictureFile']['name'];
        if (strlen($newFileName) > 0)
        {
            if ($oldFileName && strlen($oldFileName) > 0)
                FileStorage::deleteFile($oldFileName);
            $resultName = FileStorage::saveFile($this->request()->getFiles()['pictureFile']);
        }
        return $resultName;
    }
}
