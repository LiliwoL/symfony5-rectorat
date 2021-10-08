<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="Role")
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
{
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
     * @ORM\Column(name="idActor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idactor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="roleName", type="string", length=255, nullable=true)
     */
    private $rolename;

    public function getIdmovie(): ?int
    {
        return $this->idmovie;
    }

    public function getIdactor(): ?int
    {
        return $this->idactor;
    }

    public function getRolename(): ?string
    {
        return $this->rolename;
    }

    public function setRolename(?string $rolename): self
    {
        $this->rolename = $rolename;

        return $this;
    }


}
