<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
#[UniqueEntity(fields: ['nom_equipe'], message: 'nom déjà utilisé')]

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"ce champ doit ètre rempli ")]
    private ?string $nom_equipe = null;

    #[ORM\Column]
    #[Assert\Range(min:11,max:30,notInRangeMessage:"le nombre de joueurs doit etre compris entre 11 et 30")]
    private ?int $nb_joueurs = null;

    #[ORM\Column(type: 'string')]
    private $logo;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"ce champ doit ètre rempli ")]
    private ?string $origine = null;

    #[ORM\OneToMany(mappedBy: 'Equipe_Responsable', targetEntity: PerformanceEquipe::class)]
    private Collection $date_mise_a_jour;

    public function __construct()
    {
        $this->date_mise_a_jour = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEquipe(): ?string
    {
        return $this->nom_equipe
        ;
    }

    public function setNomEquipe(string $nom_equipe): self
    {
        $this->nom_equipe = $nom_equipe;

        return $this;
    }

    public function getNbJoueurs(): ?int
    {
        return $this->nb_joueurs;
    }

    public function setNbJoueurs(int $nb_joueurs): self
    {
        $this->nb_joueurs = $nb_joueurs;

        return $this;
    }
    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }
    public function getOrigine(): ?string
    {
        return $this->origine;
    }

    public function setOrigine(string $origine)
    {
        $this->origine = $origine;

        return $this;
    }
   
    /**
     * @return Collection<int, PerformanceEquipe>
     */
    public function getDateMiseAJour(): Collection
    {
        return $this->date_mise_a_jour;
    }

    public function addDateMiseAJour(PerformanceEquipe $dateMiseAJour): self
    {
        if (!$this->date_mise_a_jour->contains($dateMiseAJour)) {
            $this->date_mise_a_jour->add($dateMiseAJour);
            $dateMiseAJour->setEquipeResponsable($this);
        }

        return $this;
    }
       public function removeDateMiseAJour(PerformanceEquipe $dateMiseAJour): self
       {
        if ($this->date_mise_a_jour->removeElement($dateMiseAJour)) {
            // set the owning side to null (unless already changed)
            if ($dateMiseAJour->getEquipeResponsable() === $this) {
                $dateMiseAJour->setEquipeResponsable(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom_equipe; 

    
}
}
