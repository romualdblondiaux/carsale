<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618121022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sale_cars (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, marque VARCHAR(255) NOT NULL, modele VARCHAR(255) NOT NULL, img VARCHAR(255) NOT NULL, km VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, proprietaire VARCHAR(255) NOT NULL, cylindree VARCHAR(255) NOT NULL, puissance VARCHAR(255) NOT NULL, carburant VARCHAR(255) NOT NULL, annee VARCHAR(255) NOT NULL, transmission VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, opt VARCHAR(255) NOT NULL, INDEX IDX_298969F179F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sale_cars ADD CONSTRAINT FK_298969F179F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sale_cars');
    }
}
