<?php

namespace App\Entity;

use App\Repository\ModelosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelosRepository::class)]
class Modelos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre_modelo = null;

    #[ORM\ManyToOne(inversedBy: 'modelos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tipos $id_tipo = null;

    #[ORM\OneToMany(targetEntity: Coches::class, mappedBy: 'id_modelo')]
    private Collection $coches;

    public function __construct()
    {
        $this->coches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreModelo(): ?string
    {
        return $this->nombre_modelo;
    }

    public function setNombreModelo(string $nombre_modelo): static
    {
        $this->nombre_modelo = $nombre_modelo;

        return $this;
    }

    public function getIdTipo(): ?Tipos
    {
        return $this->id_tipo;
    }

    public function setIdTipo(?Tipos $id_tipo): static
    {
        $this->id_tipo = $id_tipo;

        return $this;
    }

    /**
     * @return Collection<int, Coches>
     */
    public function getCoches(): Collection
    {
        return $this->coches;
    }

    public function addCoch(Coches $coch): static
    {
        if (!$this->coches->contains($coch)) {
            $this->coches->add($coch);
            $coch->setIdModelo($this);
        }

        return $this;
    }

    public function removeCoch(Coches $coch): static
    {
        if ($this->coches->removeElement($coch)) {
            // set the owning side to null (unless already changed)
            if ($coch->getIdModelo() === $this) {
                $coch->setIdModelo(null);
            }
        }

        return $this;
    }
}
