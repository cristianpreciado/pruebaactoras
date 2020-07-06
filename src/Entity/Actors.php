<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actors
 *
 * @ORM\Table(name="actors")
 * @ORM\Entity(repositoryClass="App\Repository\ActorsRepository")
 */
class Actors
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=false)
     */
    private $nombre;

    /**
     * @var bool
     *
     * @ORM\Column(name="status_actors", type="boolean", nullable=false)
     */
    private $statusActors;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getStatusActors(): ?bool
    {
        return $this->statusActors;
    }

    public function setStatusActors(bool $statusActors): self
    {
        $this->statusActors = $statusActors;

        return $this;
    }


}
