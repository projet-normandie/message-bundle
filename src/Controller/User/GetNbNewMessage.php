<?php

declare(strict_types=1);

namespace ProjetNormandie\MessageBundle\Controller\User;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use ProjetNormandie\MessageBundle\ProjetNormandieMessageEvents;
use ProjetNormandie\MessageBundle\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\EventDispatcher\Event;

class GetNbNewMessage extends AbstractController
{
    private MessageRepository $messageRepository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(MessageRepository $messageRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->messageRepository = $messageRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return int
     */
    public function __invoke(): int
    {
        $event = new Event();
        $this->eventDispatcher->dispatch($event, ProjetNormandieMessageEvents::GET_NB_NEW_MESSAGE);
        return $this->messageRepository->getNbNewMessage($this->getUser());
    }
}
