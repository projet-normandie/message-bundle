<?php

namespace ProjetNormandie\MessageBundle\Service;

use ProjetNormandie\MessageBundle\Repository\MessageRepository;

class MessageProvider
{
    private MessageRepository $messageRepository;

    /**
     * Message constructor.
     * @param MessageRepository $messageRepository
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getRecipients($user)
    {
        return $this->messageRepository->getRecipients($user);
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getSenders($user)
    {
        return $this->messageRepository->getSenders($user);
    }
}
