<?php

declare(strict_types=1);

namespace ProjetNormandie\MessageBundle\EventListener\Entity;

use ProjetNormandie\MessageBundle\Entity\Message;
use Symfony\Bundle\SecurityBundle\Security;

class MessageListener
{
    public function __construct(private readonly Security $security)
    {
    }

    public function prePersist(Message $message): void
    {
        if (null === $message->getSender()) {
            $message->setSender($this->security->getUser());
        }
    }
}
