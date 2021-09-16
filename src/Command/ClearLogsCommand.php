<?php

namespace App\Command;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\HttpFoundation\ParameterBag as HttpFoundationParameterBag;
use Symfony\Component\Process\Process;

class ClearLogsCommand extends Command
{
    /**
     * @var SymfonyStyle
     */
    private $io;
    /**
     * @var Filesystem
     */
    private $fs;
    private $logsDir;
    private $env;

    /**
     * ClearLogsCommand constructor.
     *
     * @param null|string $logsDir
     * @param             $env
     */
    public function __construct(ContainerBagInterface $params)
    {
        parent::__construct();
        $this->logsDir = $params->get('app.dev_log');
        $this->env = $params->get('app.env');
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('formation:logs:clear')
            ->setDescription('Deletes all logfiles');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->fs = new Filesystem();

        // Pour un process        
        $process = new Process(['figlet', 'Vidage du log']);
        $process->mustRun();
        $output->write($process->getOutput());

        // Chemin du fichier à supprimer
        $log = $this->logsDir . $this->env . '.log';

        $this->io->comment(sprintf('Clearing the logs for the <info>%s</info> environment', $this->env));
        $this->fs->remove($log);

        if (!$this->fs->exists($log)) {
            $this->io->success(sprintf('Logs for the "%s" environment was successfully cleared.', $this->env));

            $out = parent::SUCCESS;
        } else {
            $this->io->error(sprintf('Logs for the "%s" environment could not be cleared.', $this->env));
            $out = parent::FAILURE;
        }

        return $out;
    }
}