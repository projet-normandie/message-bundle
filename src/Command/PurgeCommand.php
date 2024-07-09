<?php

declare(strict_types=1);

namespace ProjetNormandie\MessageBundle\Command;

use ProjetNormandie\MessageBundle\Repository\MessageRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PurgeCommand extends Command
{
    private MessageRepository $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('pn-message:purge')
            ->setDescription('Delete old messages')
        ;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->messageRepository->purge();
        return 0;
    }
}
