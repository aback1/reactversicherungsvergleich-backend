<?php

namespace App\DataFixtures;

use App\Entity\Versicherung;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VersicherungFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            ['id' => '1', 'name' => 'Core Care', 'versicherungsbeitrag' => 16.5,
                'zahnleistungen' => 'Keine Kostenübernahme Zahnreinigung ❌',
                'osteopathieleistungen' => 'Rheumatherapie ✅, Faszienmassage ✅',
                'krebsvorsorgeleistungen' => 'Vorsorgeuntersuchung ab 40 ✅, kein Hautkrebs-/Lungenkrebs-Screening ❌ ',
                'homöopathieleistungen' => 'keine Hommöopathischen Zusatzleistungen ❌'],
            ['id' => '2', 'name' => 'Lorem Ipsum', 'versicherungsbeitrag' => 16.8,
                'zahnleistungen' => 'Kostenübernahme professionelle Zahnreinigung ✅',
                'osteopathieleistungen' => 'Haltungskorrektur ✅',
                'krebsvorsorgeleistungen' => 'Vorsorgeuntersuchung ab 40 ✅, Hautkrebs-Screening ✅',
                'homöopathieleistungen' => 'keine Homöopathischen Zusatzleistungen ❌'],
            ['id' => '3', 'name' => 'Guardian Care', 'versicherungsbeitrag' => 16.3,
                'zahnleistungen' => 'Leistungen bei Zahnersatz ✅, keine Kostenübernahme bei der Zahnreinigung ❌, Paradontosebehandlung ✅',
                'osteopathieleistungen' => 'keine Osteopathische Zusatzleistung ❌ ',
                'krebsvorsorgeleistungen' => 'Krebsvorsorgeuntersuchung ab 40 ✅, Lungen- und Hautkrebs-Screening ✅',
                'homöopathieleistungen' => 'keine Homoöpathische Sonderleistung ❌'],
            ['id' => '4', 'name' => 'Health Life', 'versicherungsbeitrag' => 16.7,
                'zahnleistungen' => 'Kostenübernahme professionelle Zahnreinigung ✅',
                'osteopathieleistungen' => 'Osteopatische Behandlung ✅, Rheumabehandlung ✅',
                'krebsvorsorgeleistungen' => 'Keine Kostenübernahme bei Vorsorgeuntersuchung ❌',
                'homöopathieleistungen' => 'Homöopathische Medikamentierung ✅, Heilpraktiker Leistungen ✅'],
        ];

        foreach ($data as $item) {
            $versicherung = new Versicherung();
            $versicherung->setId($item['id']);
            $versicherung->setName($item['name']);
            $versicherung->setVersicherungsbeitrag($item['versicherungsbeitrag']);
            $versicherung->setZahnleistungen($item['zahnleistungen']);
            $versicherung->setOsteopathieleistungen($item['osteopathieleistungen']);
            $versicherung->setKrebsvorsorgeleistungen($item['krebsvorsorgeleistungen']);
            $versicherung->setHomöopathieleistungen($item['homöopathieleistungen']);
            $manager->persist($versicherung);
        }

        $manager->flush();
    }
}
