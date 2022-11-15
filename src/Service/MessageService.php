<?php

namespace ProjetNormandie\MessageBundle\Service;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use ProjetNormandie\MessageBundle\Entity\Message;
use ProjetNormandie\MessageBundle\Repository\MessageRepository;

/**
 * Proxy to send a AMP
 */
class MessageService
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
     * @param $user
     * @return mixed
     */
    public function getRecipients($user)
    {
        return $this->messageRepository->getRecipients($user);
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getSenders($user)
    {
        return $this->messageRepository->getSenders($user);
    }

    /**
     *
     */
    public function purge()
    {
        $this->messageRepository->purge();
    }

    /**
     * @param string $object
     * @param string $message
     * @param        $sender
     * @param        $recipient
     * @param string $type
     * @param bool   $isDeletedSender
     * @throws ORMException
     * @throws OptimisticLockException
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
