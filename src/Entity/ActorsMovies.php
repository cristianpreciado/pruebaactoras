<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActorsMovies
 *
 * @ORM\Table(name="actors_movies", indexes={@ORM\Index(name="id_movies", columns={"id_movies"}), @ORM\Index(name="id_actors", columns={"id_actors"})})
 * @ORM\Entity
 */
class ActorsMovies
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
     * @var \Actors
     *
     * @ORM\ManyToOne(targetEntity="Actors")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_actors", referencedColumnName="id")
     * })
     */
    private $idActors;

    /**
     * @var \Movies
     *
     * @ORM\ManyToOne(targetEntity="Movies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_movies", referencedColumnName="id")
     * })
     */
    private $idMovies;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdActors(): ?Actors
    {
        return $this->idActors;
    }

    public function setIdActors(?Actors $idActors): self
    {
        $this->idActors = $idActors;

        return $this;
    }

    public function getIdMovies(): ?Movies
    {
        return $this->idMovies;
    }

    public function setIdMovies(?Movies $idMovies): self
    {
        $this->idMovies = $idMovies;

        return $this;
    }


}
