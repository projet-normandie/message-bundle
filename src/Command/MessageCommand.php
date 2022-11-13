<?php
namespace ProjetNormandie\MessageBundle\Command;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use ProjetNormandie\MessageBundle\Service\MessageService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MessageCommand extends Command
{
    protected static $defaultName = 'pn-message:message';

    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('pn-message:message')
            ->setDescription('Commands for messages')
            ->addArgument(
                'function',
                InputArgument::REQUIRED,
                'Who do you want to do?'
            )
        ;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $function = $input->getArgument('function');
        switch ($function) {
            case 'purge':
                $this->messageService->purge();
                break;
            case 'migrate':
                $this->messageService->migrate();
                break;
        }
        return 0;
    }
}
