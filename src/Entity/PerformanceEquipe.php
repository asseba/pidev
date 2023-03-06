<?php

namespace App\Entity;

use App\Repository\PerformanceEquipeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PerformanceEquipeRepository::class)]
class PerformanceEquipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\OneToOne(inversedBy: 'Equipe_Responsable')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipe $Equipe_Responsable = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Range(min:0,max:30,notInRangeMessage:"le nombre de victoires doit etre compris entre 0 et 30")]
    private ?int $victoires = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Range(min:0,max:30,notInRangeMessage:"le nombre de defaites doit etre compris entre 0 et 30")]
    private ?int $defaites = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Range(min:0,max:30,notInRangeMessage:"le nombre de nuls doit etre compris entre 0 et 30")]
    private ?int $nuls = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Range(min:0,max:30,notInRangeMessage:"le nombre de but marque doit etre compris entre 0 et 30")]
    private ?int $but_marque = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Range(min:0,max:30,notInRangeMessage:"le nombre de but encaisses doit etre compris entre 0 et 30")]
    private ?int $but_encaisses = null ;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquipeResponsable(): ?Equipe
    {
        return $this->Equipe_Responsable;
    }

    public function setEquipeResponsable(?Equipe $Equipe_Responsable): self
    {
        $this->Equipe_Responsable = $Equipe_Responsable;

        return $this;
    }
    public function getVictoires(): ?int
    {
        return $this->victoires;
    }

    public function setVictoires(?int $victoires): self
    {
        $this->victoires = $victoires;

        return $this;
    }

    public function getDefaites(): ?int
    {
        return $this->defaites;
    }

    public function setDefaites(?int $defaites): self
    {
        $this->defaites = $defaites;

        return $this;
    }

    public function getNuls(): ?int
    {
        return $this->nuls;
    }

    public function setNuls(?int $nuls): self
    {
        $this->nuls = $nuls;

        return $this;
    }

    public function getButMarque(): ?int
    {
        return $this->but_marque;
    }

    public function setButMarque(?int $but_marque): self
    {
        $this->but_marque = $but_marque;

        return $this;
    }

    public function getButEncaisses(): ?int
    {
        return $this->but_encaisses;
    }

    public function setButEncaisses(?int $but_encaisses): self
    {
        $this->but_encaisses = $but_encaisses;

        return $this;
    }
}
