<?php

namespace App\Event;

use App\Entity\Movie;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Cette classe définit un évenement (héritage de Event)
 * 
 * on lui affecte une constante de NOM
 * ainsi que des méthodes souhaitées
 * 
 */
class MovieCreatedEvent extends Event
{
    public const NAME = 'movie.created';

    protected $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }
}