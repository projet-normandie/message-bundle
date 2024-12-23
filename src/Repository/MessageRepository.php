<?php

declare(strict_types=1);

namespace ProjetNormandie\MessageBundle\Repository;

use DateInterval;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use ProjetNormandie\MessageBundle\Entity\Message;

class MessageRepository  extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

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
        $query = $this->_em->createQuery(
            'DELETE projetNormandie\MessageBundle\Entity\Message m WHERE m.createdAt < :date'
        );
        $query->setParameter('date', $date->format('Y-m-d'));
        $query->execute();
    }

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

    public function getNbNewMessage($user)
    {
        $qb = $this->createQueryBuilder('m')
             ->select('COUNT(m.id)')
             ->where('m.recipient = :recipient')
             ->andWhere('m.isOpened = :isOpened')
             ->andWhere('m.isDeletedRecipient = :isDeletedRecipient')
             ->setParameter('recipient', $user)
             ->setParameter('isOpened', false)
             ->setParameter('isDeletedRecipient', false);

        return (int) $qb->getQuery()->getSingleScalarResult();
    }
}
