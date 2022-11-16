<?php

namespace ProjetNormandie\MessageBundle\Repository;

use DateInterval;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use ProjetNormandie\MessageBundle\Entity\Message;

class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    /**
     * @param Message $message
     */
    public function save(Message $message)
    {
        $this->_em->persist($message);
        $this->_em->flush();
    }

    /**
     */
    public function flush()
    {
        $this->_em->flush();
    }

    /**
     *
     */
    public function purge(): void
    {
        //----- delete 1
        $query = $this->_em->createQuery(
            'DELETE projetNormandie\MessageBundle\Entity\Message m 
            WHERE m.isDeletedSender = :isDeletedSender
            AND m.isDeletedRecipient = :isDeletedRecipient'
        );
        $query->setParameter('isDeletedSender', true);
        $query->setParameter('isDeletedRecipient', true);
        $query->execute();

        //----- delete 2
        $date = new DateTime();
        $date = $date->sub(DateInterval::createFromDateString('2 years'));
        $query = $this->_em->createQuery('DELETE projetNormandie\MessageBundle\Entity\Message m WHERE m.createdAt < :date');
        $query->setParameter('date', $date->format('Y-m-d'));
        $query->execute();
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getRecipients($user)
    {
        $query = $this->createQueryBuilder('m')
            ->join('m.recipient', 'u')
            ->select('DISTINCT u.id,u.username')
            ->where('m.sender = :user')
            ->setParameter('user', $user)
            ->andWhere('m.isDeletedSender = :isDeletedSender')
            ->setParameter('isDeletedSender', false)
            ->orderBy("u.username", 'ASC');

        return $query->getQuery()->getResult();
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getSenders($user)
    {
        $query = $this->createQueryBuilder('m')
            ->join('m.sender', 'u')
            ->select('DISTINCT u.id,u.username')
            ->where('m.recipient = :user')
            ->setParameter('user', $user)
            ->andWhere('m.isDeletedRecipient = :isDeletedRecipient')
            ->setParameter('isDeletedRecipient', false)
            ->orderBy("u.username", 'ASC');

        return $query->getQuery()->getResult();
    }
}
