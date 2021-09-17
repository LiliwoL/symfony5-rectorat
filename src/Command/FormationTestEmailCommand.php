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

class FormationTestEmailCommand extends Command
{
    protected static $defaultName = 'formation:test:email';
    protected static $defaultDescription = 'Test envoi mail';

    protected $mailer;

    public function  __construct( MailerInterface $mailer )
    {
        parent::__construct();

        $this->mailer = $mailer;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $message = (new Email())
        ->from('no-reply@formation.fr')
        ->to('test@test.fr')
        ->subject('Test email depuis la commande')
        ->text('Test')
        ->html('HTML');

        $this->mailer->send($message);

        $io->success('Mail envoyé');

        return Command::SUCCESS;
    }
}
