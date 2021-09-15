<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210915121622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout de la table Artiste et realtion';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie AS SELECT id, title, poster, year FROM movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_director_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, poster VARCHAR(255) DEFAULT NULL COLLATE BINARY, year INTEGER DEFAULT NULL, CONSTRAINT FK_1D5EF26F918D7E91 FOREIGN KEY (id_director_id) REFERENCES artist (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO movie (id, title, poster, year) SELECT id, title, poster, year FROM __temp__movie');
        $this->addSql('DROP TABLE __temp__movie');
        $this->addSql('CREATE INDEX IDX_1D5EF26F918D7E91 ON movie (id_director_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP INDEX IDX_1D5EF26F918D7E91');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie AS SELECT id, title, poster, year FROM movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, poster VARCHAR(255) DEFAULT NULL, year INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO movie (id, title, poster, year) SELECT id, title, poster, year FROM __temp__movie');
        $this->addSql('DROP TABLE __temp__movie');
    }
}
