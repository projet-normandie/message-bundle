<?php

namespace ProjetNormandie\MessageBundle\Controller;

use ProjetNormandie\MessageBundle\Service\MessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     *
     */
    public function getRecipients()
    {
        return $this->messageService->getRecipients($this->getUser());
    }

    /**
     *
     */
    public function getSenders()
    {
        return $this->messageService->getSenders($this->getUser());
    }
}
