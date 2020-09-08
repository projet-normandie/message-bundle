<?php

namespace ProjetNormandie\MessageBundle\Repository;

use Doctrine\ORM\EntityRepository;
use ProjetNormandie\MessageBundle\Entity\Message;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;

class MessageRepository extends EntityRepository
{
    /**
     * @param $data
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create($data)
    {
        $message = new Message();
        $message->setType(isset($data['type']) ? $data['type'] : 'DEFAULT');
        $message->setObject($data['object']);
        $message->setMessage($data['message']);
        $message->setSender($data['sender']);
        $message->setRecipient($data['recipient']);
        $this->_em->persist($message);
        $this->_em->flush();
    }
}
