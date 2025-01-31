<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250102121816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE public.users (id VARCHAR(40) NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, aktuelleversicherung VARCHAR(255) NOT NULL, jahresbrutto INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE versicherung (id VARCHAR(40) NOT NULL, name VARCHAR(255) NOT NULL, versicherungsbeitrag DOUBLE PRECISION DEFAULT NULL, zahnleistungen VARCHAR(255) NOT NULL, osteopathieleistungen VARCHAR(255) NOT NULL, krebsvorsorgeleistungen VARCHAR(255) NOT NULL, homöopathieleistungen VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE users');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users (id VARCHAR(40) NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, aktuelleversicherung VARCHAR(255) NOT NULL, jahresbrutto INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE public.users');
        $this->addSql('DROP TABLE versicherung');
    }
}
