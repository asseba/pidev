<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227175143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe ADD origine VARCHAR(255) NOT NULL, ADD logo VARCHAR(255) NOT NULL, ADD liste_des_joueurs VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE performance_equipe ADD victoires INT DEFAULT NULL, ADD defaites INT DEFAULT NULL, ADD nuls INT DEFAULT NULL, ADD but_marque INT DEFAULT NULL, ADD but_encaisses INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP origine, DROP logo, DROP liste_des_joueurs');
        $this->addSql('ALTER TABLE performance_equipe DROP victoires, DROP defaites, DROP nuls, DROP but_marque, DROP but_encaisses');
    }
}
