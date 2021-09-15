<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtistRepository::class)
 */
class Artist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\OneToMany(targetEntity=Movie::class, mappedBy="idDirector")
     */
    private $movies_director;

    public function __construct()
    {
        $this->movies_director = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getMoviesDirector(): Collection
    {
        return $this->movies_director;
    }

    public function addMoviesDirector(Movie $moviesDirector): self
    {
        if (!$this->movies_director->contains($moviesDirector)) {
            $this->movies_director[] = $moviesDirector;
            $moviesDirector->setIdDirector($this);
        }

        return $this;
    }

    public function removeMoviesDirector(Movie $moviesDirector): self
    {
        if ($this->movies_director->removeElement($moviesDirector)) {
            // set the owning side to null (unless already changed)
            if ($moviesDirector->getIdDirector() === $this) {
                $moviesDirector->setIdDirector(null);
            }
        }

        return $this;
    }
}
