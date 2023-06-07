<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Contenu = null;

    #[ORM\Column(length: 500)]
    private ?string $Slug = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date_de_publication = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date_de_creation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date_de_modification = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Auteur $Auteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->Contenu;
    }

    public function setContenu(string $Contenu): self
    {
        $this->Contenu = $Contenu;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->Slug;
    }

    public function setSlug(string $Slug): self
    {
        $this->Slug = $Slug;

        return $this;
    }

    public function getDateDePublication(): ?\DateTimeInterface
    {
        return $this->Date_de_publication;
    }

    public function setDateDePublication(\DateTimeInterface $Date_de_publication): self
    {
        $this->Date_de_publication = $Date_de_publication;

        return $this;
    }

    public function getDateDeCreation(): ?\DateTimeInterface
    {
        return $this->Date_de_creation;
    }

    public function setDateDeCreation(\DateTimeInterface $Date_de_creation): self
    {
        $this->Date_de_creation = $Date_de_creation;

        return $this;
    }

    public function getDateDeModification(): ?\DateTimeInterface
    {
        return $this->Date_de_modification;
    }

    public function setDateDeModification(\DateTimeInterface $Date_de_modification): self
    {
        $this->Date_de_modification = $Date_de_modification;

        return $this;
    }

    public function getAuteur(): ?auteur
    {
        return $this->Auteur;
    }

    public function setAuteur(?auteur $Auteur): self
    {
        $this->Auteur = $Auteur;

        return $this;
    }
}
