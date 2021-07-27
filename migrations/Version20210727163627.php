<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210727163627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mods_category ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mods_category ADD position INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mods_category ALTER description TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE mods_category ALTER description DROP DEFAULT');
        $this->addSql('ALTER TABLE mods_category ADD CONSTRAINT FK_2F9B9CF5727ACA70 FOREIGN KEY (parent_id) REFERENCES mods_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2F9B9CF5727ACA70 ON mods_category (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mods_category DROP CONSTRAINT FK_2F9B9CF5727ACA70');
        $this->addSql('DROP INDEX IDX_2F9B9CF5727ACA70');
        $this->addSql('ALTER TABLE mods_category DROP parent_id');
        $this->addSql('ALTER TABLE mods_category DROP position');
        $this->addSql('ALTER TABLE mods_category ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE mods_category ALTER description DROP DEFAULT');
    }
}
