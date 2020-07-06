<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movies
 *
 * @ORM\Table(name="movies")
 * @ORM\Entity
 */
class Movies
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
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="gener", type="string", length=250, nullable=false)
     */
    private $gener;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $year;

    /**
     * @var bool
     *
     * @ORM\Column(name="status_movie", type="boolean", nullable=false)
     */
    private $statusMovie;

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

    public function getGener(): ?string
    {
        return $this->gener;
    }

    public function setGener(string $gener): self
    {
        $this->gener = $gener;

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

    public function getStatusMovie(): ?bool
    {
        return $this->statusMovie;
    }

    public function setStatusMovie(bool $statusMovie): self
    {
        $this->statusMovie = $statusMovie;

        return $this;
    }


}
