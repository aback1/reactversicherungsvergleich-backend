<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity]
class Versicherung
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "NONE")]
    #[ORM\Column(type: "string", length: 40)]
    private string $id;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Name cannot be empty.")]
    #[Assert\Length(min: 3, max: 255, minMessage: "Name should be at least {{ limit }} characters long.")]
    private string $name;

    #[ORM\Column(type: "float", nullable: true)]
    #[Assert\NotBlank(message: "Versicherungsbeitrag cannot be empty.")]
    #[Assert\Range(min: 16, max: 17, notInRangeMessage: "Versicherungsbeitrag must be between {{ min }} and {{ max }}.")]
    private ?float $versicherungsbeitrag = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Bitte geben Sie ihre angebotenen Leistungen an.")]
    #[Assert\Length(min: 5, max: 255, minMessage: "Bitte geben Sie ihre angebotenen Leistungen an.")]
    private string $zahnleistungen;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Bitte geben Sie ihre angebotenen Leistungen an.")]
    #[Assert\Length(min: 5, max: 255, minMessage: "Bitte geben Sie ihre angebotenen Leistungen an.")]
    private string $osteopathieleistungen;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Bitte geben Sie ihre angebotenen Leistungen an.")]
    #[Assert\Length(min: 5, max: 255, minMessage: "Bitte geben Sie ihre angebotenen Leistungen an.")]
    private string $krebsvorsorgeleistungen;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Bitte geben Sie ihre angebotenen Leistungen an.")]
    #[Assert\Length(min: 5, max: 255, minMessage: "Bitte geben Sie ihre angebotenen Leistungen an.")]
    private string $homöopathieleistungen;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getVersicherungsbeitrag(): ?float
    {
        return $this->versicherungsbeitrag;
    }

    public function setVersicherungsbeitrag(?float $versicherungsbeitrag): void
    {
        $this->versicherungsbeitrag = $versicherungsbeitrag;
    }

    public function getZahnleistungen(): string
    {
        return $this->zahnleistungen;
    }

    public function setZahnleistungen(string $zahnleistungen): void
    {
        $this->zahnleistungen = $zahnleistungen;
    }

    public function getOsteopathieleistungen(): string
    {
        return $this->osteopathieleistungen;
    }

    public function setOsteopathieleistungen(string $osteopathieleistungen): void
    {
        $this->osteopathieleistungen = $osteopathieleistungen;
    }

    public function getKrebsvorsorgeleistungen(): string
    {
        return $this->krebsvorsorgeleistungen;
    }

    public function setKrebsvorsorgeleistungen(string $krebsvorsorgeleistungen): void
    {
        $this->krebsvorsorgeleistungen = $krebsvorsorgeleistungen;
    }

    public function getHomöopathieleistungen(): string
    {
        return $this->homöopathieleistungen;
    }

    public function setHomöopathieleistungen(string $homöopathieleistungen): void
    {
        $this->homöopathieleistungen = $homöopathieleistungen;
    }
}
