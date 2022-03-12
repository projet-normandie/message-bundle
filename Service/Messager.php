<?php

namespace ProjetNormandie\MessageBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use ProjetNormandie\MessageBundle\Entity\Message;

/**
 * Proxy to send a AMP
 */
class Messager
{
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
     * @deprecated  use messageService->send()
     * @param        $object
     * @param        $message
     * @param        $sender
     * @param        $recipient
     * @param string $type
     * @param bool   $isDeletedSender
     */
    public function send($object, $message, $sender, $recipient, string $type = 'DEFAULT', bool $isDeletedSender = true)
    {
        $entity = new Message();
        $entity->setType($type);
        $entity->setObject($object);
        $entity->setMessage($message);
        $entity->setSender($sender);
        $entity->setRecipient($recipient);
        $entity->setIsDeletedSender($isDeletedSender);
        $this->em->persist($entity);
        $this->em->flush();
    }
}
