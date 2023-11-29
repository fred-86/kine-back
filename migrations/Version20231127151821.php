<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127151821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Pratictioner (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, lastName VARCHAR(128) NOT NULL, firstName VARCHAR(128) NOT NULL, phone VARCHAR(15) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(64) NOT NULL, zipCode VARCHAR(7) NOT NULL, link VARCHAR(620) DEFAULT NULL, subject VARCHAR(200) DEFAULT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME DEFAULT NULL, INDEX IDX_846CB348A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Pratictioner ADD CONSTRAINT FK_846CB348A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Pratictioner DROP FOREIGN KEY FK_846CB348A76ED395');
        $this->addSql('DROP TABLE Pratictioner');
    }
}
