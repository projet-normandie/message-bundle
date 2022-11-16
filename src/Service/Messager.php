<?php

namespace ProjetNormandie\MessageBundle\Service;

use ProjetNormandie\MessageBundle\Entity\Message;
use ProjetNormandie\MessageBundle\Repository\MessageRepository;

/**
 * Proxy to send a private message
 */
class Messager
{
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
     * @param string $object
     * @param string $message
     * @param        $sender
     * @param        $recipient
     * @param string $type
     * @param bool   $isDeletedSender
     */
    public function send(string $object, string $message, $sender, $recipient, string $type = 'DEFAULT', bool $isDeletedSender = true)
    {
        $entity = new Message();
        $entity->setType($type);
        $entity->setObject($object);
        $entity->setMessage($message);
        $entity->setSender($sender);
        $entity->setRecipient($recipient);
        $entity->setIsDeletedSender($isDeletedSender);
        $this->messageRepository->save($entity);
    }
}
