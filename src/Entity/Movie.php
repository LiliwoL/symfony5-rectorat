<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Movie
 *
 * @ORM\Table(name="Movie")
 * @ORM\Entity(repositoryClass=MovieRepository::class)
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
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\Length(     
     *  max = "50",
     *  maxMessage = "50 maxi"
     * )
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="original_title", type="text", nullable=true)
     */
    private $originalTitle;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer", nullable=false)
     */
    private $year;

    /**
     * Fetch EAGER va permettre de charger directement l'objet lié
     * 
     * @ORM\ManyToOne(targetEntity=Artist::class)
     * @ORM\JoinColumn(name="idDirector", referencedColumnName="id")
     */
    private $idDirector;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=20, nullable=false)
     */
    private $genre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="synopsis", type="text", nullable=true)
     */
    private $synopsis;

    /**
     * @var string|null
     *
     * @ORM\Column(name="codeCountry", type="string", length=4, nullable=true)
     */
    private $codecountry;

    /**
     * @var int|null
     *
     * @ORM\Column(name="imdbId", type="integer", nullable=true)
     */
    private $imdbid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="website", type="text", nullable=true)
     */
    private $website;

    /**
     * @var string|null
     *
     * @ORM\Column(name="releaseDate", type="text", nullable=true)
     */
    private $releasedate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="runtime", type="integer", nullable=true)
     */
    private $runtime;

    /**
     * @var int|null
     *
     * @ORM\Column(name="budget", type="integer", nullable=true)
     */
    private $budget;

    /**
     * @var int|null
     *
     * @ORM\Column(name="revenue", type="integer", nullable=true)
     */
    private $revenue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="text", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poster;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(?string $originalTitle): self
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getIdDirector(): ?Artist
    {
        return $this->idDirector;
    }

    public function setIdDirector(?Artist $idDirector): self
    {
        $this->idDirector = $idDirector;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getCodecountry(): ?string
    {
        return $this->codecountry;
    }

    public function setCodecountry(?string $codecountry): self
    {
        $this->codecountry = $codecountry;

        return $this;
    }

    public function getImdbid(): ?int
    {
        return $this->imdbid;
    }

    public function setImdbid(?int $imdbid): self
    {
        $this->imdbid = $imdbid;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getReleasedate(): ?string
    {
        return $this->releasedate;
    }

    public function setReleasedate(?string $releasedate): self
    {
        $this->releasedate = $releasedate;

        return $this;
    }

    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    public function setRuntime(?int $runtime): self
    {
        $this->runtime = $runtime;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(?int $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getRevenue(): ?int
    {
        return $this->revenue;
    }

    public function setRevenue(?int $revenue): self
    {
        $this->revenue = $revenue;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }


}
