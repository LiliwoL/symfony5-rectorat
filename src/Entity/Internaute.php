<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Internaute
 *
 * @ORM\Table(name="Internaute")
 * @ORM\Entity(repositoryClass=InternauteRepository::class)
 */
class Internaute
{
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $email;

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
     * @var string|null
     *
     * @ORM\Column(name="codeCountry", type="string", length=4, nullable=true)
     */
    private $codecountry;

    public function getEmail(): ?string
    {
        return $this->email;
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

    public function getCodecountry(): ?string
    {
        return $this->codecountry;
    }

    public function setCodecountry(?string $codecountry): self
    {
        $this->codecountry = $codecountry;

        return $this;
    }


}
