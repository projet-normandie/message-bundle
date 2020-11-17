<?php

namespace ProjetNormandie\MessageBundle\Repository;

use DateInterval;
use DateTime;
use Doctrine\ORM\EntityRepository;
use VideoGamesRecords\CoreBundle\Entity\Chart;

class MessageRepository extends EntityRepository
{
    /**
     *
     */
    public function purge()
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
}
