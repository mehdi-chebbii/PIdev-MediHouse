<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215223221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, id_reponse INT DEFAULT NULL, reponse_des VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reclamation CHANGE id_reclamation id_reclamation INT NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE sujet sujet VARCHAR(255) NOT NULL, CHANGE descreption descreption VARCHAR(255) NOT NULL, CHANGE etat etat VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reponse');
        $this->addSql('ALTER TABLE reclamation CHANGE id_reclamation id_reclamation INT DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE sujet sujet VARCHAR(255) DEFAULT NULL, CHANGE descreption descreption VARCHAR(255) DEFAULT NULL, CHANGE etat etat VARCHAR(255) DEFAULT NULL');
    }
}
