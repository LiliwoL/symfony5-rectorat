<?php

namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class FirstListener
{
    private $logger;

    // A la construction, on injecte la dépendance du Logger
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    // Méthode qui porte le nom on + Le nom de l'événement
    public function onKernelRequest(RequestEvent $event)
    {
        // Ajouter dans le log des infos
        $this->logger->info("**** Evenement Kernel Request");
        $this->logger->debug( "Type: " . $event->getRequestType() );
    }
}