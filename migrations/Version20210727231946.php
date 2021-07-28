<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210727231946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wiptag_revision DROP CONSTRAINT FK_F27672C4158E0B66');
        $this->addSql('ALTER TABLE wiptag_revision ALTER content TYPE TEXT');
        $this->addSql('ALTER TABLE wiptag_revision ALTER content DROP DEFAULT');
        $this->addSql('ALTER TABLE wiptag_revision ADD CONSTRAINT FK_F27672C4158E0B66 FOREIGN KEY (target_id) REFERENCES wip_tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wiptag_revision DROP CONSTRAINT fk_f27672c4158e0b66');
        $this->addSql('ALTER TABLE wiptag_revision ALTER content TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE wiptag_revision ALTER content DROP DEFAULT');
        $this->addSql('ALTER TABLE wiptag_revision ADD CONSTRAINT fk_f27672c4158e0b66 FOREIGN KEY (target_id) REFERENCES content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
