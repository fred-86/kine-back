<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129094532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_78A47793A76ED395');
        $this->addSql('DROP INDEX IDX_78A47793A76ED395 ON appointment');
        $this->addSql('ALTER TABLE appointment ADD pratictioner_id INT DEFAULT NULL, DROP user_id');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_78A477931BE1F75A FOREIGN KEY (pratictioner_id) REFERENCES Pratictioner (id)');
        $this->addSql('CREATE INDEX IDX_78A477931BE1F75A ON appointment (pratictioner_id)');
        $this->addSql('ALTER TABLE availability DROP FOREIGN KEY FK_27867947A76ED395');
        $this->addSql('DROP INDEX IDX_27867947A76ED395 ON availability');
        $this->addSql('ALTER TABLE availability ADD pratictioner_id INT DEFAULT NULL, DROP user_id');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_278679471BE1F75A FOREIGN KEY (pratictioner_id) REFERENCES Pratictioner (id)');
        $this->addSql('CREATE INDEX IDX_278679471BE1F75A ON availability (pratictioner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Appointment DROP FOREIGN KEY FK_78A477931BE1F75A');
        $this->addSql('DROP INDEX IDX_78A477931BE1F75A ON Appointment');
        $this->addSql('ALTER TABLE Appointment ADD user_id INT NOT NULL, DROP pratictioner_id');
        $this->addSql('ALTER TABLE Appointment ADD CONSTRAINT FK_78A47793A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_78A47793A76ED395 ON Appointment (user_id)');
        $this->addSql('ALTER TABLE Availability DROP FOREIGN KEY FK_278679471BE1F75A');
        $this->addSql('DROP INDEX IDX_278679471BE1F75A ON Availability');
        $this->addSql('ALTER TABLE Availability ADD user_id INT NOT NULL, DROP pratictioner_id');
        $this->addSql('ALTER TABLE Availability ADD CONSTRAINT FK_27867947A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_27867947A76ED395 ON Availability (user_id)');
    }
}
