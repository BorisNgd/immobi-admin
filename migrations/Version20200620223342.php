<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200620223342 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attachment (id INT AUTO_INCREMENT NOT NULL, house_id INT NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_795FD9BB6BB74515 (house_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, house_id INT NOT NULL, customer_id INT DEFAULT NULL, date DATETIME NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, status INT NOT NULL, price DOUBLE PRECISION NOT NULL, information VARCHAR(255) NOT NULL, comment LONGTEXT DEFAULT NULL, payment_type INT NOT NULL, INDEX IDX_E00CEDDE6BB74515 (house_id), INDEX IDX_E00CEDDE9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, locatiom_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email_address VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, uuid VARCHAR(255) NOT NULL, INDEX IDX_81398E0914F88E60 (locatiom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE house (id INT AUTO_INCREMENT NOT NULL, house_type_id INT NOT NULL, location_id INT NOT NULL, title VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, area DOUBLE PRECISION DEFAULT NULL, price INT NOT NULL, status TINYINT(1) NOT NULL, picture VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, number_of_room INT NOT NULL, number_of_bed_room INT DEFAULT NULL, number_of_kitchen_room INT DEFAULT NULL, number_of_living_room INT DEFAULT NULL, visitor_count INT DEFAULT NULL, entrance_condition LONGTEXT DEFAULT NULL, promote TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_67D5399D519B0A8E (house_type_id), INDEX IDX_67D5399D64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE house_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, state VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, latitude VARCHAR(255) NOT NULL, longitude VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attachment ADD CONSTRAINT FK_795FD9BB6BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE6BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E0914F88E60 FOREIGN KEY (locatiom_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399D519B0A8E FOREIGN KEY (house_type_id) REFERENCES house_type (id)');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399D64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9395C3F3');
        $this->addSql('ALTER TABLE attachment DROP FOREIGN KEY FK_795FD9BB6BB74515');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE6BB74515');
        $this->addSql('ALTER TABLE house DROP FOREIGN KEY FK_67D5399D519B0A8E');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E0914F88E60');
        $this->addSql('ALTER TABLE house DROP FOREIGN KEY FK_67D5399D64D218E');
        $this->addSql('DROP TABLE attachment');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE house');
        $this->addSql('DROP TABLE house_type');
        $this->addSql('DROP TABLE location');
    }
}
