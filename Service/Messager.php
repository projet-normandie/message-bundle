<?php

namespace ProjetNormandie\MessageBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use ProjetNormandie\MessageBundle\Entity\Message;

/**
 * Proxy to send a AMP
 */
class Messager
{
    private $em;

    /**
     * Message constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param        $object
     * @param        $message
     * @param        $sender
     * @param        $recipient
     * @param string $type
     */
    public function send($object, $message, $sender, $recipient, $type = 'DEFAULT')
    {
        $entity = new Message();
        $entity->setType($type);
        $entity->setObject($object);
        $entity->setMessage($message);
        $entity->setSender($sender);
        $entity->setRecipient($recipient);
        $this->em->persist($entity);
        $this->em->flush();
    }
}
