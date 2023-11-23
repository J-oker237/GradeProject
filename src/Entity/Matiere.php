<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
class Matiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    
    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $nom = null;


    #[Assert\NotBlank]
    #[ORM\Column]
    private ?int $coef = null;

    private $note;

    public function addNote(Notes $note): self
    {
    if (!$this->note->contains($note)) {
        $this->note[] = $note;
        $note->setMatiere($this);
    }

    return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCoef(): ?int
    {
        return $this->coef;
    }

    public function setCoef(int $coef): static
    {
        $this->coef = $coef;

        return $this;
    }

}
