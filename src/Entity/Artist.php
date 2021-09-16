<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtistRepository::class)
 * @ORM\Table(name="artist")
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
    private $moviesAsDirector;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="artists")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $yearOfBirth;

    public function __construct()
    {
        $this->moviesAsDirector = new ArrayCollection();
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
    public function getMoviesAsDirector(): Collection
    {
        return $this->moviesAsDirector;
    }

    public function addMoviesAsDirector(Movie $moviesAsDirector): self
    {
        if (!$this->moviesAsDirector->contains($moviesAsDirector)) {
            $this->moviesAsDirector[] = $moviesAsDirector;
            $moviesAsDirector->setIdDirector($this);
        }

        return $this;
    }

    public function removeMoviesAsDirector(Movie $moviesAsDirector): self
    {
        if ($this->moviesAsDirector->removeElement($moviesAsDirector)) {
            // set the owning side to null (unless already changed)
            if ($moviesAsDirector->getIdDirector() === $this) {
                $moviesAsDirector->setIdDirector(null);
            }
        }

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getYearOfBirth(): ?int
    {
        return $this->yearOfBirth;
    }

    public function setYearOfBirth(?int $yearOfBirth): self
    {
        $this->yearOfBirth = $yearOfBirth;

        return $this;
    }

    // **** Fonction d'affichage    
    public function __toString()
    {
        return $this->getSurname() . " " . $this->getName() . " " . $this->getYearOfBirth();
    }
}
