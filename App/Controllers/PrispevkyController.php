<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\HTTPException;
use App\Core\Model;
use App\Core\Responses\JsonResponse;
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
    public function add(): Response {
        $id = $this->request()->getValue("id");
        $data = [];
        $obrazok = null;
        if ($id) {
            $post = Prispevky::getOne($id);
            if (!$post) {
                $data["errors"]["id"] = "príspevok nenájdený";
            } else {
                $data["action"] = "Upraviť";
                $file = $this->request()->getFiles()['image'];
                if(empty($file['name'])){
                    $obrazok = $post->getObrazok();
                } else {
                    unlink($post->getObrazok());
                    $obrazok = FileStorage::saveFile($this->request()->getFiles()['image']);
                }
            }
        } else {
            $post = new Prispevky();
            $data["action"] = "Pridať";
            if($this->request()->getFiles()['image']){
                $obrazok = FileStorage::saveFile($this->request()->getFiles()['image']);
            }else{
                $obrazok = "public/images/vaiicko_logo.png";
            }
        }
        $text = nl2br(htmlspecialchars($this->request()->getValue("text")));
        $title = $this->request()->getValue("title");
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


    public function edit(): Response{
        $id = $this->request()->getValue("id");
        $postToEdit = Prispevky::getOne($id);
        return $this->html($postToEdit, viewName: "postMaker");
    }

    public function display(): Response
    {
        $id = $this->request()->getValue("id");
        $post = Prispevky::getOne($id);
        $comments = Comment::getAll("post_id = $id");
        /** @var Reply[] $replies */

        foreach ($comments as $com){
            $cid = $com->getId();
            $repliesOne = Reply::getAll("comment_id = $cid");
            if(!empty($repliesOne) && !empty($replies)){
                $replies = array_merge($replies, $repliesOne);
            }
            if(empty($replies) && !empty($repliesOne)){
                $replies = $repliesOne;
            }
        }

        if(empty($replies)){
            $replies = [];
        }

        return $this->html(["post" => $post, "comments" => $comments, "replies" => $replies], viewName: "prispevok");
    }

    public function delete(): Response {
        $id = $this->request()->getValue("id");
        $postToDelete = Prispevky::getOne($id);
        unlink($postToDelete->getObrazok());
        $cat = $postToDelete->getKategoria();
        if ($postToDelete) {
            $pcomms = Comment::getAll("post_id = $id");
            foreach ($pcomms as $pcomm){
                $pid = $pcomm->getId();
                $creplies = Reply::getAll("comment_id = $pid");
                foreach ($creplies as $creply){
                    $creply->delete();
                }
                $pcomm->delete();
            }
            $postToDelete->delete();
        }
        $posts = Prispevky::getAll("kategoria = $cat");
        if ($cat = 1)
            return $this->html($posts, "movies");

        if ($cat = 2)
            return $this->html($posts, "games");

        if ($cat = 3)
            return $this->html($posts, "music");

        return $this->html($posts, "movies");
    }

    public function addComment(): Response
    {
        $text = $this->request()->getValue("comment");
        $pid = $this->request()->getValue("pid");

        $comment = new Comment();
        $comment->setAuthor($this->app->getAuth()->getLoggedUserName());
        $comment->setText($text);
        $comment->setPostId($pid);
        $comment->save();

        //header('Content-Type: application/json');
        return $this->json(array(
            'author' => $comment->getAuthor(),
            'text' => $comment->getText()
        ));
    }

    public function addReply(): Response
    {
        $comID = $this->request()->getValue("cid");
        $text = $this->request()->getValue("reply");

        $reply = new Reply();
        $reply->setAuthor($this->app->getAuth()->getLoggedUserName());
        $reply->setText($text);
        $reply->setCommentId($comID);
        $reply->save();

        return $this->json(array(
            'author' => $reply->getAuthor(),
            'text' => $reply->getText()
        ));
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
}
