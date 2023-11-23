<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\NotesRepository;
use DateTimeImmutable;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotesRepository::class)]
class Notes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\LessThan(20)]
    #[Assert\PositiveOrZero]
    #[Assert\NotBlank]
    #[ORM\Column]
    private ?float $note = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date = null;

    #[ORM\ManyToOne]
    private ?Matiere $matiere = null;

    public function __construct() {
        $this->date = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): static
    {
        $this->matiere = $matiere;

        return $this;
    }

}
