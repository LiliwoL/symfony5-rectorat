<?php

namespace App\EntityImport;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artist
 *
 * @ORM\Table(name="artist")
 * @ORM\Entity
 */
class Artist
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255, nullable=false)
     */
    private $surname;


}
