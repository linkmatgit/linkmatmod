<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718005307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_6dc1401bf1cd3c3');
        $this->addSql('ALTER TABLE mods_fs ADD public BOOLEAN DEFAULT \'false\' NOT NULL');
        $this->addSql('ALTER TABLE mods_fs ALTER size DROP NOT NULL');
        $this->addSql('ALTER TABLE mods_fs ALTER release_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE mods_fs ALTER release_date DROP DEFAULT');
        $this->addSql('ALTER TABLE mods_fs ALTER version DROP NOT NULL');
        $this->addSql('COMMENT ON COLUMN mods_fs.release_date IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE mods_fs DROP public');
        $this->addSql('ALTER TABLE mods_fs ALTER size SET NOT NULL');
        $this->addSql('ALTER TABLE mods_fs ALTER release_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE mods_fs ALTER release_date DROP DEFAULT');
        $this->addSql('ALTER TABLE mods_fs ALTER version SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN mods_fs.release_date IS NULL');
        $this->addSql('CREATE UNIQUE INDEX uniq_6dc1401bf1cd3c3 ON mods_fs (version)');
    }
}
