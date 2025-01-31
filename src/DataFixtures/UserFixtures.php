<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
public function load(ObjectManager $manager): void
{
$hashedPassword = password_hash("peppermint", PASSWORD_BCRYPT);
$johnDoe = new User();
$johnDoe->setId('1');
$johnDoe->setName('John Doe');
$johnDoe->setPassword($hashedPassword);
$manager->persist($johnDoe);

$hashedPassword2 = password_hash("strawberries", PASSWORD_BCRYPT);
$janeSmith = new User();
$janeSmith->setId('2');
$janeSmith->setName('Jane Smith');
$janeSmith->setPassword($hashedPassword2);
$manager->persist($janeSmith);

$manager->flush();
}
}
