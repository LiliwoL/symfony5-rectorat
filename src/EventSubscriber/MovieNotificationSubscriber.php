<?php

namespace App\EventSubscriber;

use App\Event\MovieCreatedEvent;
use App\Service\Slugifier;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\NoRecipient;
use Symfony\Component\Notifier\Recipient\Recipient;

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
            // Pratique plus personnalisée avec notre Event personnalisé
            MovieCreatedEvent::NAME => 'onMovieCreated',

            // Syntaxe sans passer par le fichier Event
            //'kernel.request' => 'onKernelRequest'
        ];
    }

    /**
     * Méthode lancée à l'événement MovieCreatedEvent::NAME ou movie.created
     * @param $event
     */
    public function onMovieCreated ( MovieCreatedEvent $event ) : void
    {
        // Debug
        // dd($event);

        // Instance Movie
        $movie = $event->getMovie();

        // Log
        $this->_logger->info("❤❤❤ Movie Created ❤❤❤");
        $this->_logger->info("❤❤❤ Movie Title: " . $movie->getTitle() . " ❤❤❤");

        // ********
        
        // Notification
        $notification = new Notification('Nouveau film ' . $movie->getTitle());
        $notification->content('Content of notif');
        $notification->importance(Notification::IMPORTANCE_URGENT);

        // Destinataire Notif
        $recipient = new Recipient('test@recipient.fr');

        // Appel du composant Notifier        
        $this->_notifier->send($notification, $recipient);

        // Arret de la propagation de cet événement
        $event->stopPropagation();
        // Ainsi tous les Listeners ou Subscribers de cet événement qui n'ont pas encore été appelés, ne seront PAS appelés!
    }
}