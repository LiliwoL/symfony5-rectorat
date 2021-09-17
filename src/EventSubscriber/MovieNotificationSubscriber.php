<?php

namespace App\EventSubscriber;

use App\Event\MovieCreatedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MovieNotificationSubscriber implements EventSubscriberInterface
{
    private $_logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            // Pratique plus personnalisée avec notre Event personnalisé
            MovieCreatedEvent::NAME => 'onMovieCreated',

            // Syntaxe sans passer par le fichier Event
            //'kernel.request' => 'onKernelRequest'
        ];
    }

    public function onMovieCreated ( MovieCreatedEvent $event ) : void
    {
        // Debug
        // dd($event);

        // Instance Movie
        $movie = $event->getMovie();

        // Log
        $this->_logger->info("❤❤❤ Movie Created ❤❤❤");
        $this->_logger->info("❤❤❤ Movie Title: " . $movie->getTitle() . " ❤❤❤");
    }
}