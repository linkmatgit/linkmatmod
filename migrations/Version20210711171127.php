<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210711171127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT fk_9474526c158e0b66');
        $this->addSql('DROP INDEX idx_9474526c158e0b66');
        $this->addSql('ALTER TABLE comment ADD content_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment DROP target_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C84A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9474526C84A0A3ED ON comment (content_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C84A0A3ED');
        $this->addSql('DROP INDEX IDX_9474526C84A0A3ED');
        $this->addSql('ALTER TABLE comment ADD target_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment DROP content_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT fk_9474526c158e0b66 FOREIGN KEY (target_id) REFERENCES content (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9474526c158e0b66 ON comment (target_id)');
    }
}
