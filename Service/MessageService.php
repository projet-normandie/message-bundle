<?php

namespace ProjetNormandie\MessageBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use ProjetNormandie\MessageBundle\Entity\Message;

/**
 * Proxy to send a AMP
 */
class MessageService
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
     * @param $user
     * @return mixed
     */
    public function getRecipients($user)
    {
        return $this->em->getRepository('ProjetNormandieMessageBundle:Message')->getRecipients($user);
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getSenders($user)
    {
        return $this->em->getRepository('ProjetNormandieMessageBundle:Message')->getSenders($user);
    }
}
