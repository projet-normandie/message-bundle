<?php
namespace ProjetNormandie\MessageBundle\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ProjetNormandie\MessageBundle\Repository\MessageRepository;
use ProjetNormandie\MessageBundle\Filter\Bbcode as BbcodeFilter;

class MessageCommand extends Command
{
    protected static $defaultName = 'pn-message:message';

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
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
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $function = $input->getArgument('function');
        switch ($function) {
            case 'purge':
                $this->em->getRepository('ProjetNormandieMessageBundle:Message')->purge();
                break;
            case 'migrate':
                $this->migrate();
                break;
        }
        return 0;
    }

    /**
     *
     */
    private function migrate()
    {
        /** @var MessageRepository $messageRepository */
        $messageRepository = $this->em->getRepository('ProjetNormandieMessageBundle:Message');

        $bbcodeFiler = new BbcodeFilter();
        $messages = $messageRepository->findAll();
        foreach ($messages as $message) {
            $message->setMessage($bbcodeFiler->filter($message->getMessage()));
        }
        $this->em->flush();
    }
}
