<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CountryRepository;

/**
 * Country
 *
 * @ORM\Table(name="Country")
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 */
class Country
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=4, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30, nullable=false, options={"default"="Unknown"})
     */
    private $name = 'Unknown';

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=30, nullable=false)
     */
    private $language;

    public function getCode(): ?string
    {
        return $this->code;
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

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    // **** Fonction d'affichage    
    public function __toString()
    {
        return $this->getName();
    }
}
