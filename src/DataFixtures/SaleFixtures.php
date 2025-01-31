<?php

namespace App\DataFixtures;

use App\Entity\Sale;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SaleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create a new Sale object
        $sale = new Sale();
        $sale->setUserID('user123');
        $sale->setFirstname('Jane');
        $sale->setLastname('Doe');
        $sale->setNewInsurance('Health Life');
        $sale->setEmail('johndoe@example.com');
        $sale->setPhonenumber('123456789');
        $sale->setArbeitGeber('Company Inc.');
        $sale->setMehrAlsEinArbeitgeber(true);
        $sale->setArbeitgeberWechsel(false);
        $sale->setSeit24angestellt(true);

        $manager->persist($sale);

        $manager->flush();
    }
}
