<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726032848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wip_topic ADD approuve_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE wip_topic ADD approuved_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE wip_topic ADD CONSTRAINT FK_F7BD422D40ED4ED3 FOREIGN KEY (approuve_by_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F7BD422D40ED4ED3 ON wip_topic (approuve_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wip_topic DROP CONSTRAINT FK_F7BD422D40ED4ED3');
        $this->addSql('DROP INDEX IDX_F7BD422D40ED4ED3');
        $this->addSql('ALTER TABLE wip_topic DROP approuve_by_id');
        $this->addSql('ALTER TABLE wip_topic DROP approuved_at');
    }
}
