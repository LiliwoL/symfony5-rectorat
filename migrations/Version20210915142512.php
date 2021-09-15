<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210915142512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE IF NOT EXISTS  artist (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, surname VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('CREATE INDEX IF NOT EXISTS IDX_1599687F92F3E70 ON artist (country_id)');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE IF NOT EXISTS  country (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, code VARCHAR(4) NOT NULL COLLATE BINARY, name VARCHAR(30) NOT NULL COLLATE BINARY, language VARCHAR(30) DEFAULT NULL COLLATE BINARY)');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE IF NOT EXISTS  movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_director_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, poster VARCHAR(255) DEFAULT NULL COLLATE BINARY, year INTEGER DEFAULT NULL, synopsis CLOB DEFAULT NULL COLLATE BINARY)');
        $this->addSql('CREATE INDEX IF NOT EXISTS IDX_1D5EF26F918D7E91 ON movie (id_director_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE artist');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE country');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE movie');
    }
}
