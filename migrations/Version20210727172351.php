<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210727172351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mods_category ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mods_category ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE mods_category ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE mods_category ADD CONSTRAINT FK_2F9B9CF5F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2F9B9CF5F675F31B ON mods_category (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mods_category DROP CONSTRAINT FK_2F9B9CF5F675F31B');
        $this->addSql('DROP INDEX IDX_2F9B9CF5F675F31B');
        $this->addSql('ALTER TABLE mods_category DROP author_id');
        $this->addSql('ALTER TABLE mods_category DROP created_at');
        $this->addSql('ALTER TABLE mods_category DROP updated_at');
    }
}
