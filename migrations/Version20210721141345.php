<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721141345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_8d93d649f85e0677');
        $this->addSql('ALTER TABLE "user" ADD last_login_ip VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD last_login_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD theme VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD banned_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD country VARCHAR(2) DEFAULT \'CA\'');
        $this->addSql('ALTER TABLE "user" RENAME COLUMN username TO identifier');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649772E836A ON "user" (identifier)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D649772E836A');
        $this->addSql('ALTER TABLE "user" DROP last_login_ip');
        $this->addSql('ALTER TABLE "user" DROP last_login_at');
        $this->addSql('ALTER TABLE "user" DROP theme');
        $this->addSql('ALTER TABLE "user" DROP banned_at');
        $this->addSql('ALTER TABLE "user" DROP country');
        $this->addSql('ALTER TABLE "user" RENAME COLUMN identifier TO username');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649f85e0677 ON "user" (username)');
    }
}
