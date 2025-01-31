<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'sales')]
#[ApiResource(operations: [])]
class Sale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $userID;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255, name: 'new_insurance')]
    #[Assert\NotBlank]
    private $newInsurance;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $phonenumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true, name: 'arbeit_geber')]
    private $arbeitGeber;

    #[ORM\Column(type: 'boolean', name: 'mehr_als_ein_arbeitgeber')]
    private $mehrAlsEinArbeitgeber;

    #[ORM\Column(type: 'boolean', name: 'arbeitgeber_wechsel')] // Updated column name
    private $arbeitgeberWechsel;

    #[ORM\Column(type: 'boolean', name: 'seit_24_angestellt')] // Updated column name
    private $seit24angestellt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserID(): ?string
    {
        return $this->userID;
    }

    public function setUserID(string $userID): self
    {
        $this->userID = $userID;
        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getNewInsurance(): ?string
    {
        return $this->newInsurance;
    }

    public function setNewInsurance(string $newInsurance): self
    {
        $this->newInsurance = $newInsurance;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(?string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;
        return $this;
    }

    public function getArbeitGeber(): ?string
    {
        return $this->arbeitGeber;
    }

    public function setArbeitGeber(?string $arbeitGeber): self
    {
        $this->arbeitGeber = $arbeitGeber;
        return $this;
    }

    public function getMehrAlsEinArbeitgeber(): ?bool
    {
        return $this->mehrAlsEinArbeitgeber;
    }

    public function setMehrAlsEinArbeitgeber($mehrAlsEinArbeitgeber): self
    {
        $this->mehrAlsEinArbeitgeber = $this->convertJaNeinToBool($mehrAlsEinArbeitgeber);
        return $this;
    }

    public function getArbeitgeberWechsel(): ?bool
    {
        return $this->arbeitgeberWechsel;
    }

    public function setArbeitgeberWechsel($arbeitgeberWechsel): self
    {
        $this->arbeitgeberWechsel = $this->convertJaNeinToBool($arbeitgeberWechsel);
        return $this;
    }

    public function getSeit24angestellt(): ?bool
    {
        return $this->seit24angestellt;
    }

    public function setSeit24angestellt($seit24angestellt): self
    {
        $this->seit24angestellt = $this->convertJaNeinToBool($seit24angestellt);
        return $this;
    }

    private function convertJaNeinToBool($value): bool
    {
        if (is_bool($value)) {
            return $value;
        }
        return strtolower(trim($value)) === 'ja';
    }
}
