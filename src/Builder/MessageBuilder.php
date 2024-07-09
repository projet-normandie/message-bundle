<?php

declare(strict_types=1);

namespace ProjetNormandie\MessageBundle\Builder;

use Doctrine\ORM\EntityManagerInterface;
use ProjetNormandie\MessageBundle\Entity\Message;

class MessageBuilder
{
    private string $type = 'DEFAULT';
    private string $object;
    private string $message;
    private $sender;
    private $recipient;

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function setType(string $type): MessageBuilder
    {
        $this->type = $type;
        return $this;
    }

    public function setObject(string $object): MessageBuilder
    {
        $this->object = $object;
        return $this;
    }

    public function setMessage(string $message): MessageBuilder
    {
        $this->message = $message;
        return $this;
    }

    public function setSender($sender): MessageBuilder
    {
        $this->sender = $sender;
        return $this;
    }

    public function setRecipient($recipient): MessageBuilder
    {
        $this->recipient = $recipient;
        return $this;
    }

    public function send(): void
    {
        $message = new Message();

        $message->setType($this->type);
        $message->setObject($this->object);
        $message->setMessage($this->message);
        $message->setSender($this->sender);
        $message->setRecipient($this->recipient);
        $message->setIsDeletedSender(true);

        $this->em->persist($message);
        $this->em->flush();
    }
}
