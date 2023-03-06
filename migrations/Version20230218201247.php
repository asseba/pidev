<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230218201247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE performance_equipe (id INT AUTO_INCREMENT NOT NULL, equipe_responsable_id INT NOT NULL, nom_performance INT NOT NULL, description VARCHAR(255) NOT NULL, date_mise_a_jour DATE NOT NULL, INDEX IDX_44A1947723E4EB30 (equipe_responsable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE performance_equipe ADD CONSTRAINT FK_44A1947723E4EB30 FOREIGN KEY (equipe_responsable_id) REFERENCES equipe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE performance_equipe DROP FOREIGN KEY FK_44A1947723E4EB30');
        $this->addSql('DROP TABLE performance_equipe');
    }
}
