<?php

namespace App\EventSubscriber;

use App\Event\MovieCreatedEvent;
use App\Event\MovieViewedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\NoRecipient;

/**
 * Class MovieSubscriber
 * On va définir ici le comportement pour tous les événements auxquels on aura "souscrit"
 * 
 * https://symfony.com/doc/current/event_dispatcher.html#creating-an-event-subscriber
 * @package App\EventSubscriber
 */
class MovieNotificationSubscriber implements EventSubscriberInterface
{
    private $_logger;
    private $_notifier;

    public function __construct(LoggerInterface $logger, NotifierInterface $notifier)
    {
        $this->_logger = $logger;
        $this->_notifier = $notifier;
    }

    /**
     * Méthode pour inscrire cette classe à des événements
     */
    public static function getSubscribedEvents()
    {
        return [
            // Syntaxe sans passer par le fichier de déclaration de nos events personnalisés
            //'movie.created' => 'onMovieCreated',

            // Méthode (ancienne bonne pratique) avec le fichier de déclaration via App/Events.php
            // Pour un événement très générique
            //Events::MOVIE_CREATED => 'onMovieCreated'

            // Pratique plus personnalisée avec notre Event Personnalisé
            MovieCreatedEvent::NAME => 'onMovieCreated',
            MovieViewedEvent::NAME => 'onMovieViewed'
        ];
    }
    

    /**
     * Méthode lancée à l'événement MovieCreatedEvent::NAME ou movie.created
     * @param $event
     */
    public function onMovieCreated( MovieCreatedEvent $event ) : void
    {
        // Debug
        //dd($event);

        $movie = $event->getMovie();

        // Log
        $this->_logger->info("❤❤❤ Movie Created ❤❤❤");
        $this->_logger->info("❤❤❤ Movie Title: " . $movie->getTitle() . " ❤❤❤");

        // Notification
        //$notification = new Notification("Nouveau film");
        //$notification->importance(Notification::IMPORTANCE_HIGH);

        // Appel au composant Notifier
        //$this->_notifier->send($notification, new NoRecipient());
    }

    /**
     * Méthode lancée à l'événement MovieViewedEvent::NAME ou movie.viewed
     * @param $event
     */
    public function onMovieViewed( MovieViewedEvent $event ) : void
    {
        // Debug
        //dd($event);

        $movie = $event->getMovie();

        // Log
        $this->_logger->info("❤❤❤ Movie Viewed ❤❤❤");
        $this->_logger->info("❤❤❤ Movie Title: " . $movie->getTitle() . " ❤❤❤");
    }
}