<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718010721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mods_fs ALTER release_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE mods_fs ALTER release_date DROP DEFAULT');
        $this->addSql('ALTER TABLE mods_fs ALTER uri DROP NOT NULL');
        $this->addSql('COMMENT ON COLUMN mods_fs.release_date IS NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE mods_fs ALTER release_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE mods_fs ALTER release_date DROP DEFAULT');
        $this->addSql('ALTER TABLE mods_fs ALTER uri SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN mods_fs.release_date IS \'(DC2Type:datetime_immutable)\'');
    }
}
