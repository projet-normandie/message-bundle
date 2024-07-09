<?php

declare(strict_types=1);

namespace ProjetNormandie\MessageBundle\Entity;

interface UserInterface
{
    public function getId(): int;
    public function getUsername(): string;
}
