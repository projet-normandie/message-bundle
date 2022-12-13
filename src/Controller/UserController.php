<?php

namespace ProjetNormandie\MessageBundle\Controller;

use ProjetNormandie\MessageBundle\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    private MessageRepository $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function getRecipients()
    {
        return $this->messageRepository->getRecipients($this->getUser());
    }

    public function getSenders()
    {
        return $this->messageRepository->getSenders($this->getUser());
    }
}
