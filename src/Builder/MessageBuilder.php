<?php

namespace ProjetNormandie\MessageBundle\Builder;

use Doctrine\ORM\EntityManagerInterface;
use ProjetNormandie\MessageBundle\Entity\Message;

/**
 * Proxy to send a private message
 */
class MessageBuilder
{
    private string $type = 'DEFAULT';
    private string $object;
    private string $message;
    private $sender;
    private $recipient;

    private EntityManagerInterface $em;

    /**
     * Message constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $type
     * @return MessageBuilder
     */
    public function setType(string $type): MessageBuilder
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $object
     * @return MessageBuilder
     */
    public function setObject(string $object): MessageBuilder
    {
        $this->object = $object;
        return $this;
    }

    /**
     * @param string $message
     * @return MessageBuilder
     */
    public function setMessage(string $message): MessageBuilder
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param $sender
     * @return MessageBuilder
     */
    public function setSender($sender): MessageBuilder
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @param $recipient
     * @return MessageBuilder
     */
    public function setRecipient($recipient): MessageBuilder
    {
        $this->recipient = $recipient;
        return $this;
    }

    public function send()
    {
        $message = new Message();
        $message
            ->setType($this->type)
            ->setObject($this->object)
            ->setMessage($this->message)
            ->setSender($this->sender)
            ->setRecipient($this->recipient)
            ->setIsDeletedSender(true)
            ;

        $this->em->persist($message);
        $this->em->flush();
    }
}
