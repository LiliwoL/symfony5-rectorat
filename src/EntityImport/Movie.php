<?php

namespace App\Entity\Import;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movie
 *
 * @ORM\Table(name="movie", indexes={@ORM\Index(name="IDX_1D5EF26F918D7E91", columns={"id_director_id"})})
 * @ORM\Entity
 */
class Movie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_director_id", type="integer", nullable=true)
     */
    private $idDirectorId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="poster", type="string", length=255, nullable=true)
     */
    private $poster;

    /**
     * @var int|null
     *
     * @ORM\Column(name="year", type="integer", nullable=true)
     */
    private $year;

    /**
     * @var string|null
     *
     * @ORM\Column(name="synopsis", type="text", nullable=true)
     */
    private $synopsis;


}
