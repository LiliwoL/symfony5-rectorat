<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class TestEmailCommand extends Command
{
    protected $mailer;

    /**
     * Constructeur
     * 
     */
    public function __construct(MailerInterface $mailer){
        parent::__construct();
        
        $this->mailer = $mailer;
    }

    public function configure()
    {
        $this->setName('formation:test:email');
        $this->setDescription('Test envoi email');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $message = (new Email())
        ->from('no-reply@monsite.fr')
        ->to("test@test.fr")
        ->subject("Test")
        ->text("Mssage de test")
        ->html("HTML");

        $this->mailer->send($message);

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');


        return Command::SUCCESS;
    }
}