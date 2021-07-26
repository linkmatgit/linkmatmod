<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726184832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teams ADD reason_type INT DEFAULT NULL');
        $this->addSql('ALTER TABLE wip_tag ADD reason_type INT DEFAULT NULL');
        $this->addSql('ALTER TABLE wip_topic ADD reason_type INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teams DROP reason_type');
        $this->addSql('ALTER TABLE wip_tag DROP reason_type');
        $this->addSql('ALTER TABLE wip_topic DROP reason_type');
    }
}
