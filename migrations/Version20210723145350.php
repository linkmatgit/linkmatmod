<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210723145350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wip_tag ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE wip_tag ADD statut SMALLINT DEFAULT -1 NOT NULL');
        $this->addSql('ALTER TABLE wip_tag RENAME COLUMN accepted TO approved');
        $this->addSql('ALTER TABLE wip_tag ADD CONSTRAINT FK_D2CFEE3F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D2CFEE3F675F31B ON wip_tag (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wip_tag DROP CONSTRAINT FK_D2CFEE3F675F31B');
        $this->addSql('DROP INDEX IDX_D2CFEE3F675F31B');
        $this->addSql('ALTER TABLE wip_tag DROP author_id');
        $this->addSql('ALTER TABLE wip_tag DROP statut');
        $this->addSql('ALTER TABLE wip_tag RENAME COLUMN approved TO accepted');
    }
}
