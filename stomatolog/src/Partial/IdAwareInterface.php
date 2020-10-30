<?php


namespace App\Partial;


interface IdAwareInterface
{

    public function getId(): ?int;

    /**
     * @param int $id
     */
    public function setId(int $id): void;
}