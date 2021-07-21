<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721134552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mods_user (mods_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(mods_id, user_id))');
        $this->addSql('CREATE INDEX IDX_A635869C2978D09 ON mods_user (mods_id)');
        $this->addSql('CREATE INDEX IDX_A635869CA76ED395 ON mods_user (user_id)');
        $this->addSql('ALTER TABLE mods_user ADD CONSTRAINT FK_A635869C2978D09 FOREIGN KEY (mods_id) REFERENCES mods_fs (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mods_user ADD CONSTRAINT FK_A635869CA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE mods_team_users');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mods_team_users (mods_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(mods_id, user_id))');
        $this->addSql('CREATE INDEX idx_f57d4126a76ed395 ON mods_team_users (user_id)');
        $this->addSql('CREATE INDEX idx_f57d41262978d09 ON mods_team_users (mods_id)');
        $this->addSql('ALTER TABLE mods_team_users ADD CONSTRAINT fk_f57d41262978d09 FOREIGN KEY (mods_id) REFERENCES mods_fs (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mods_team_users ADD CONSTRAINT fk_f57d4126a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE mods_user');
    }
}
