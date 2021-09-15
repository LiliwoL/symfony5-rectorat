<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210915145910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_1599687F92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__artist AS SELECT id, country_id, name, surname FROM artist');
        $this->addSql('DROP TABLE artist');
        $this->addSql('CREATE TABLE artist (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, surname VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_1599687F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO artist (id, country_id, name, surname) SELECT id, country_id, name, surname FROM __temp__artist');
        $this->addSql('DROP TABLE __temp__artist');
        $this->addSql('CREATE INDEX IDX_1599687F92F3E70 ON artist (country_id)');
        $this->addSql('DROP INDEX IDX_1D5EF26F918D7E91');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie AS SELECT id, id_director_id, title, poster, synopsis, year FROM movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_director_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, poster VARCHAR(255) DEFAULT NULL COLLATE BINARY, synopsis CLOB DEFAULT NULL COLLATE BINARY, year INTEGER DEFAULT NULL, CONSTRAINT FK_1D5EF26F918D7E91 FOREIGN KEY (id_director_id) REFERENCES artist (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO movie (id, id_director_id, title, poster, synopsis, year) SELECT id, id_director_id, title, poster, synopsis, year FROM __temp__movie');
        $this->addSql('DROP TABLE __temp__movie');
        $this->addSql('CREATE INDEX IDX_1D5EF26F918D7E91 ON movie (id_director_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_1599687F92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__artist AS SELECT id, country_id, name, surname FROM artist');
        $this->addSql('DROP TABLE artist');
        $this->addSql('CREATE TABLE artist (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO artist (id, country_id, name, surname) SELECT id, country_id, name, surname FROM __temp__artist');
        $this->addSql('DROP TABLE __temp__artist');
        $this->addSql('CREATE INDEX IDX_1599687F92F3E70 ON artist (country_id)');
        $this->addSql('DROP INDEX IDX_1D5EF26F918D7E91');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie AS SELECT id, id_director_id, title, poster, synopsis, year FROM movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_director_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, poster VARCHAR(255) DEFAULT NULL, synopsis CLOB DEFAULT NULL, year INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO movie (id, id_director_id, title, poster, synopsis, year) SELECT id, id_director_id, title, poster, synopsis, year FROM __temp__movie');
        $this->addSql('DROP TABLE __temp__movie');
        $this->addSql('CREATE INDEX IDX_1D5EF26F918D7E91 ON movie (id_director_id)');
    }
}
