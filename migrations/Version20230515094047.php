<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515094047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Availability (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, reason VARCHAR(50) DEFAULT NULL, startTime DATETIME DEFAULT NULL, endTime DATETIME DEFAULT NULL, recurrence TINYINT(1) DEFAULT 1 NOT NULL, recurrenceDays LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', isWorkingHours TINYINT(1) DEFAULT 1 NOT NULL, daysOfWeeks LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updatedAt DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_27867947A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Availability ADD CONSTRAINT FK_27867947A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE appointment ADD patient_id INT NOT NULL');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_78A477936B899279 FOREIGN KEY (patient_id) REFERENCES Patient (id)');
        $this->addSql('CREATE INDEX IDX_78A477936B899279 ON appointment (patient_id)');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, DROP role');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Availability DROP FOREIGN KEY FK_27867947A76ED395');
        $this->addSql('DROP TABLE Availability');
        $this->addSql('ALTER TABLE Appointment DROP FOREIGN KEY FK_78A477936B899279');
        $this->addSql('DROP INDEX IDX_78A477936B899279 ON Appointment');
        $this->addSql('ALTER TABLE Appointment DROP patient_id');
        $this->addSql('ALTER TABLE User ADD role VARCHAR(120) DEFAULT \'admin\' NOT NULL, DROP roles');
    }
}
