<?php

namespace ProjetNormandie\MessageBundle\Entity;

/**
 * Interface that defines the rules that must respect the User objects instances.
 */
interface UserInterface
{
    /**
     * @return int
     */
    public function getId(): int;
    /**
     * @return string
     */
    public function getUsername(): string;
}
