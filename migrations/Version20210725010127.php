<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210725010127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wip_message DROP CONSTRAINT fk_c61814981f55203d');
        $this->addSql('DROP INDEX idx_c61814981f55203d');
        $this->addSql('ALTER TABLE wip_message RENAME COLUMN topic_id TO topics_id');
        $this->addSql('ALTER TABLE wip_message ADD CONSTRAINT FK_C6181498BF06A414 FOREIGN KEY (topics_id) REFERENCES wip_topic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C6181498BF06A414 ON wip_message (topics_id)');
        $this->addSql('ALTER TABLE wip_topic ALTER author_id SET NOT NULL');
        $this->addSql('ALTER TABLE wip_topic ALTER tags_id SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wip_message DROP CONSTRAINT FK_C6181498BF06A414');
        $this->addSql('DROP INDEX IDX_C6181498BF06A414');
        $this->addSql('ALTER TABLE wip_message RENAME COLUMN topics_id TO topic_id');
        $this->addSql('ALTER TABLE wip_message ADD CONSTRAINT fk_c61814981f55203d FOREIGN KEY (topic_id) REFERENCES wip_topic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c61814981f55203d ON wip_message (topic_id)');
        $this->addSql('ALTER TABLE wip_topic ALTER tags_id DROP NOT NULL');
        $this->addSql('ALTER TABLE wip_topic ALTER author_id DROP NOT NULL');
    }
}
