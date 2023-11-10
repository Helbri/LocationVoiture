<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231025133446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, type_pi_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, num_permis VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', test_nullable_yes VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, numero_assurance VARCHAR(255) NOT NULL, num_pi VARCHAR(255) NOT NULL, INDEX IDX_C7440455EED2348E (type_pi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, voiture_id INT NOT NULL, client_id INT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, kilometrage INT NOT NULL, INDEX IDX_5E9E89CB181A8BA (voiture_id), INDEX IDX_5E9E89CB19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, marque_id INT DEFAULT NULL, motorisation_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, nbr_porte INT NOT NULL, image VARCHAR(255) NOT NULL, boite_auto TINYINT(1) NOT NULL, quatre_roues_motrices TINYINT(1) NOT NULL, nombre_places INT NOT NULL, capacite_coffre INT NOT NULL, tarif INT NOT NULL, INDEX IDX_10028558C54C8C93 (type_id), INDEX IDX_100285584827B9B2 (marque_id), INDEX IDX_10028558A3B5A725 (motorisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motorisation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, autonomie INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_pi (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, modele_id INT DEFAULT NULL, statut_id INT DEFAULT NULL, num_immat VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, kilometrage INT NOT NULL, derniere_revision DATETIME DEFAULT NULL, dernier_controle DATE DEFAULT NULL, INDEX IDX_E9E2810F19EB6921 (client_id), INDEX IDX_E9E2810FAC14B70A (modele_id), INDEX IDX_E9E2810FF6203804 (statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455EED2348E FOREIGN KEY (type_pi_id) REFERENCES type_pi (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_10028558C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_100285584827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_10028558A3B5A725 FOREIGN KEY (motorisation_id) REFERENCES motorisation (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FAC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FF6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455EED2348E');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB181A8BA');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB19EB6921');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_10028558C54C8C93');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_100285584827B9B2');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_10028558A3B5A725');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F19EB6921');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FAC14B70A');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FF6203804');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP TABLE motorisation');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE type_pi');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
