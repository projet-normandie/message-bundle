<?php

namespace ProjetNormandie\MessageBundle\Controller;

use ProjetNormandie\MessageBundle\Service\MessageProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    private MessageProvider $messageProvider;

    public function __construct(MessageProvider $messageProvider)
    {
        $this->messageProvider = $messageProvider;
    }

    public function getRecipients()
    {
        return $this->messageProvider->getRecipients($this->getUser());
    }

    public function getSenders()
    {
        return $this->messageProvider->getSenders($this->getUser());
    }
}
