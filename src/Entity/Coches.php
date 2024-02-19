<?php

namespace App\Entity;

use App\Repository\CochesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CochesRepository::class)]
class Coches
{
    #[ORM\Id]
    #[ORM\Column(length: 10)]
    private ?string $matricula = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $precio = null;

    #[ORM\Column]
    private ?bool $estado = null;

    #[ORM\Column]
    private ?int $kms = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\ManyToOne(inversedBy: 'coches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Modelos $id_modelo = null;

    public function getMatricula(): ?string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): static
    {
        $this->matricula = $matricula;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(string $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function isEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(bool $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getKms(): ?int
    {
        return $this->kms;
    }

    public function setKms(int $kms): static
    {
        $this->kms = $kms;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getIdModelo(): ?Modelos
    {
        return $this->id_modelo;
    }

    public function setIdModelo(?Modelos $id_modelo): static
    {
        $this->id_modelo = $id_modelo;

        return $this;
    }
}
