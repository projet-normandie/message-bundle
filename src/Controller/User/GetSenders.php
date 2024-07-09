<?php

declare(strict_types=1);

namespace ProjetNormandie\MessageBundle\Controller\User;

use ProjetNormandie\MessageBundle\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetSenders extends AbstractController
{
    private MessageRepository $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function __invoke()
    {
        return $this->messageRepository->getSenders($this->getUser());
    }
}
