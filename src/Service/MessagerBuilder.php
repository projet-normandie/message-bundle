<?php

namespace ProjetNormandie\MessageBundle\Service;

use ProjetNormandie\MessageBundle\Entity\Message;
use ProjetNormandie\MessageBundle\Repository\MessageRepository;

/**
 * Proxy to send a private message
 */
class MessagerBuilder
{
    private string $type = 'DEFAULT';
    private string $object;
    private string $message;
    private $sender;
    private $recipient;

    private MessageRepository $messageRepository;

    /**
     * Message constructor.
     * @param MessageRepository $messageRepository
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @param string $type
     * @return MessagerBuilder
     */
    public function setType(string $type): MessagerBuilder
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $object
     * @return MessagerBuilder
     */
    public function setObject(string $object): MessagerBuilder
    {
        $this->object = $object;
        return $this;
    }

    /**
     * @param string $message
     * @return MessagerBuilder
     */
    public function setMessage(string $message): MessagerBuilder
    {
        $this->message = $message;
        return $this;
    }
    
    /**
     * @param $sender
     * @return MessagerBuilder
     */
    public function setSender($sender): MessagerBuilder
    {
        $this->sender = $sender;
        return $this;
    }
    
    /**
     * @param $recipient
     * @return MessagerBuilder
     */
    public function setRecipient($recipient): MessagerBuilder
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

        $this->messageRepository->save($message);
    }
}
