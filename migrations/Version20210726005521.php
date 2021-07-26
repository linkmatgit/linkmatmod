<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726005521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wip_attachment ADD topic_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE wip_attachment ADD CONSTRAINT FK_82A6A92F1F55203D FOREIGN KEY (topic_id) REFERENCES wip_topic (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_82A6A92F1F55203D ON wip_attachment (topic_id)');
        $this->addSql('ALTER TABLE wip_tag ADD approuve_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE wip_tag ADD approuved_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE wip_tag ADD CONSTRAINT FK_D2CFEE340ED4ED3 FOREIGN KEY (approuve_by_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D2CFEE340ED4ED3 ON wip_tag (approuve_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wip_tag DROP CONSTRAINT FK_D2CFEE340ED4ED3');
        $this->addSql('DROP INDEX IDX_D2CFEE340ED4ED3');
        $this->addSql('ALTER TABLE wip_tag DROP approuve_by_id');
        $this->addSql('ALTER TABLE wip_tag DROP approuved_at');
        $this->addSql('ALTER TABLE wip_attachment DROP CONSTRAINT FK_82A6A92F1F55203D');
        $this->addSql('DROP INDEX IDX_82A6A92F1F55203D');
        $this->addSql('ALTER TABLE wip_attachment DROP topic_id');
    }
}
