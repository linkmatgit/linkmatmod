<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210711233338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mods_brand (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mods_category (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mods_fs (id INT NOT NULL, brand_id INT DEFAULT NULL, category_id INT DEFAULT NULL, price VARCHAR(255) NOT NULL, size VARCHAR(255) NOT NULL, release_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, support BOOLEAN DEFAULT \'false\' NOT NULL, version VARCHAR(255) NOT NULL, uri VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6DC1401BF1CD3C3 ON mods_fs (version)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6DC1401841CB121 ON mods_fs (uri)');
        $this->addSql('CREATE INDEX IDX_6DC140144F5D008 ON mods_fs (brand_id)');
        $this->addSql('CREATE INDEX IDX_6DC140112469DE2 ON mods_fs (category_id)');
        $this->addSql('CREATE TABLE mods_team_users (mods_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(mods_id, user_id))');
        $this->addSql('CREATE INDEX IDX_F57D41262978D09 ON mods_team_users (mods_id)');
        $this->addSql('CREATE INDEX IDX_F57D4126A76ED395 ON mods_team_users (user_id)');
        $this->addSql('ALTER TABLE mods_fs ADD CONSTRAINT FK_6DC140144F5D008 FOREIGN KEY (brand_id) REFERENCES mods_brand (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mods_fs ADD CONSTRAINT FK_6DC140112469DE2 FOREIGN KEY (category_id) REFERENCES mods_category (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mods_fs ADD CONSTRAINT FK_6DC1401BF396750 FOREIGN KEY (id) REFERENCES content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mods_team_users ADD CONSTRAINT FK_F57D41262978D09 FOREIGN KEY (mods_id) REFERENCES mods_fs (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mods_team_users ADD CONSTRAINT FK_F57D4126A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE mods_fs DROP CONSTRAINT FK_6DC140144F5D008');
        $this->addSql('ALTER TABLE mods_fs DROP CONSTRAINT FK_6DC140112469DE2');
        $this->addSql('ALTER TABLE mods_team_users DROP CONSTRAINT FK_F57D41262978D09');
        $this->addSql('DROP TABLE mods_brand');
        $this->addSql('DROP TABLE mods_category');
        $this->addSql('DROP TABLE mods_fs');
        $this->addSql('DROP TABLE mods_team_users');
    }
}
