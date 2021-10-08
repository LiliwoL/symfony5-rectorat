<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\ArtistRepository;

/**
 * Artist
 *
 * @ORM\Table(name="Artist")
 * @ORM\Entity(repositoryClass=ArtistRepository::class)
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
     * @ORM\Column(name="name", type="string", length=30, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=30, nullable=false)
     */
    private $surname;

    /**
     * @var int|null
     *
     * @ORM\Column(name="yearOfBirth", type="integer", nullable=true)
     */
    private $yearOfBirth;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $Gender;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class)
     * @ORM\JoinColumn(name="codeCountry", referencedColumnName="code")
     */
    private $codeCountry;

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

    public function getYearOfBirth(): ?int
    {
        return $this->yearOfBirth;
    }

    public function setYearOfBirth(?int $yearOfBirth): self
    {
        $this->yearOfBirth = $yearOfBirth;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function setGender(?string $Gender): self
    {
        $this->Gender = $Gender;

        return $this;
    }

    // **** Fonction d'affichage    
    public function __toString()
    {
        return $this->getSurname() . " " . $this->getName() . " " . $this->getYearOfBirth();
    }

    public function getCodeCountry(): ?Country
    {
        return $this->codeCountry;
    }

    public function setCodeCountry(?Country $codeCountry): self
    {
        $this->codeCountry = $codeCountry;

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
}
