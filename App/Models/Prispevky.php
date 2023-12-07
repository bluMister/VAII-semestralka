<?php

namespace App\Models;
class Prispevky extends \App\Core\Model
{

    protected ?int $id = null;
    protected ?string $nazov;
    protected ?string $text;
    protected ?string $obrazok;
    protected ?int $kategoria;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNazov(): ?string
    {
        return $this->nazov;
    }

    public function setNazov(string $nazov): void
    {
        $this->nazov = $nazov;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getObrazok(): ?string
    {
        return $this->obrazok;
    }

    public function setObrazok(string $picture): void
    {
        $this->obrazok = $picture;
    }

    public function getKategoria(): ?int
    {
        return $this->kategoria;
    }

    public function setKategoria(?int $kategoria): void
    {
        $this->kategoria = $kategoria;
    }
}