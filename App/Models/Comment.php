<?php

namespace App\Models;

class Comment extends \App\Core\Model
{
    protected ?int $id = null;
    protected ?string $author;
    protected ?string $text;
    protected ?int $post_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $autor): void
    {
        $this->author = $autor;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
    public function getPostId(): ?int
    {
        return $this->post_id;
    }

    public function setPostId(int $post_id): void
    {
        $this->post_id = $post_id;
    }
}

