<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123160243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment CHANGE createdAt createdAt DATETIME NOT NULL, CHANGE updatedAt updatedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE availability CHANGE createdAt createdAt DATETIME NOT NULL, CHANGE updatedAt updatedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE updatedAt updatedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE reviews CHANGE createdAt createdAt DATETIME NOT NULL, CHANGE updatedAt updatedAt DATETIME DEFAULT NULL, CHANGE publishedAt publishedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE status CHANGE createdAt createdAt DATETIME NOT NULL, CHANGE updatedAt updatedAt DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Appointment CHANGE createdAt createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updatedAt updatedAt DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE Availability CHANGE createdAt createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updatedAt updatedAt DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE Patient CHANGE updatedAt updatedAt DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE Reviews CHANGE createdAt createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updatedAt updatedAt DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE publishedAt publishedAt DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE Status CHANGE createdAt createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updatedAt updatedAt DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
