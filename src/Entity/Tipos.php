<?php

namespace App\Entity;

use App\Repository\TiposRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TiposRepository::class)]
class Tipos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $nombre_tipo = null;

    #[ORM\OneToMany(targetEntity: Modelos::class, mappedBy: 'id_tipo')]
    private Collection $modelos;

    public function __construct()
    {
        $this->modelos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreTipo(): ?string
    {
        return $this->nombre_tipo;
    }

    public function setNombreTipo(string $nombre_tipo): static
    {
        $this->nombre_tipo = $nombre_tipo;

        return $this;
    }

    /**
     * @return Collection<int, Modelos>
     */
    public function getModelos(): Collection
    {
        return $this->modelos;
    }

    public function addModelo(Modelos $modelo): static
    {
        if (!$this->modelos->contains($modelo)) {
            $this->modelos->add($modelo);
            $modelo->setIdTipo($this);
        }

        return $this;
    }

    public function removeModelo(Modelos $modelo): static
    {
        if ($this->modelos->removeElement($modelo)) {
            // set the owning side to null (unless already changed)
            if ($modelo->getIdTipo() === $this) {
                $modelo->setIdTipo(null);
            }
        }

        return $this;
    }
}
