<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="Rating")
 * @ORM\Entity(repositoryClass=RatingRepository::class)
 */
class Rating
{
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="idMovie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idmovie;

    /**
     * @var int
     *
     * @ORM\Column(name="rate", type="integer", nullable=false)
     */
    private $rate;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getIdmovie(): ?int
    {
        return $this->idmovie;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }


}
