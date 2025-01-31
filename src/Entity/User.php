<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: "users", schema: "public")]
#[ApiResource(operations: [])]

class User implements PasswordAuthenticatedUserInterface
{
#[ORM\Id]
#[ORM\GeneratedValue(strategy: "NONE")]
#[ORM\Column(type: "string", length: 40)]
private string $id;

#[ORM\Column(length: 255)]
#[Assert\NotBlank(message: "Name cannot be empty.")]
#[Assert\Length(min: 3, max: 255, minMessage: "Name should be at least {{ limit }} characters long.")]
private string $name;

#[ORM\Column(length: 255)]
#[Assert\NotBlank(message: "Password cannot be empty.")]
#[Assert\Length(min: 8, max: 255, minMessage: "Password should be at least {{ limit }} characters long.")]
private string $password;


public function __construct() {}

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

public function getPassword(): string
{
return $this->password;
}

public function setPassword(string $password): void
{
$this->password = $password;
}

public function getUserIdentifier(): string
{
return $this->id;
}


}
