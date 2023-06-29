<?php

namespace ProjetNormandie\MessageBundle\EventListener\Entity;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use ProjetNormandie\MessageBundle\Entity\Message;
use Symfony\Component\Security\Core\Security;

class MessageListener
{
    private Security $security;

    /**
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @param Message       $message
     * @param LifecycleEventArgs $event
     */
    public function prePersist(Message $message, LifecycleEventArgs $event): void
    {
        if (null === $message->getSender()) {
            $message->setSender($this->security->getUser());
        }
    }
}
