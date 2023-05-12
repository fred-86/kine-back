<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512152917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Appointment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, status_id INT NOT NULL, date DATE NOT NULL, time TIME NOT NULL, topic LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', comment LONGTEXT DEFAULT NULL, notification TINYINT(1) NOT NULL, createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updatedAt DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_78A47793A76ED395 (user_id), INDEX IDX_78A477936BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Patient (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, lastName VARCHAR(128) NOT NULL, firstName VARCHAR(128) NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(15) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(64) NOT NULL, zipCode VARCHAR(7) NOT NULL, role VARCHAR(20) DEFAULT \'patient\' NOT NULL, createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updatedAt DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_D567EE77E7927C74 (email), INDEX IDX_D567EE77A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Reviews (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, content LONGTEXT NOT NULL, status SMALLINT UNSIGNED DEFAULT 1 NOT NULL, createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updatedAt DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', publishedAt DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_A6CDD2936B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Status (id INT AUTO_INCREMENT NOT NULL, worded LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updatedAt DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(120) DEFAULT \'admin\' NOT NULL, createdAT DATETIME NOT NULL, updatedAT DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_2DA17977E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Appointment ADD CONSTRAINT FK_78A47793A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Appointment ADD CONSTRAINT FK_78A477936BF700BD FOREIGN KEY (status_id) REFERENCES Status (id)');
        $this->addSql('ALTER TABLE Patient ADD CONSTRAINT FK_D567EE77A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Reviews ADD CONSTRAINT FK_A6CDD2936B899279 FOREIGN KEY (patient_id) REFERENCES Patient (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Appointment DROP FOREIGN KEY FK_78A47793A76ED395');
        $this->addSql('ALTER TABLE Appointment DROP FOREIGN KEY FK_78A477936BF700BD');
        $this->addSql('ALTER TABLE Patient DROP FOREIGN KEY FK_D567EE77A76ED395');
        $this->addSql('ALTER TABLE Reviews DROP FOREIGN KEY FK_A6CDD2936B899279');
        $this->addSql('DROP TABLE Appointment');
        $this->addSql('DROP TABLE Patient');
        $this->addSql('DROP TABLE Reviews');
        $this->addSql('DROP TABLE Status');
        $this->addSql('DROP TABLE User');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
