<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210711152250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_category (id SERIAL NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_72113DE6989D9B62 ON blog_category (slug)');
        $this->addSql('CREATE INDEX IDX_72113DE6A76ED395 ON blog_category (user_id)');
        $this->addSql('CREATE TABLE comment (id SERIAL NOT NULL, author_id INT NOT NULL, target_id INT NOT NULL, content TEXT NOT NULL, publish_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('CREATE INDEX IDX_9474526C158E0B66 ON comment (target_id)');
        $this->addSql('CREATE TABLE configuration (id SERIAL NOT NULL, title VARCHAR(255) DEFAULT NULL, color_header VARCHAR(255) DEFAULT NULL, color_footer VARCHAR(255) DEFAULT NULL, copyright VARCHAR(255) DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE content (id SERIAL NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, online BOOLEAN DEFAULT \'false\' NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FEC530A92B36786B ON content (title)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FEC530A9989D9B62 ON content (slug)');
        $this->addSql('CREATE INDEX IDX_FEC530A9A76ED395 ON content (user_id)');
        $this->addSql('CREATE TABLE post (id INT NOT NULL, category_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D12469DE2 ON post (category_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(200) NOT NULL, is_verified BOOLEAN NOT NULL, avatar_name VARCHAR(255) DEFAULT NULL, avatar_size INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, header_name VARCHAR(255) DEFAULT NULL, header_size INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE blog_category ADD CONSTRAINT FK_72113DE6A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C158E0B66 FOREIGN KEY (target_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D12469DE2 FOREIGN KEY (category_id) REFERENCES blog_category (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DBF396750 FOREIGN KEY (id) REFERENCES content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8D12469DE2');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8DBF396750');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C158E0B66');
        $this->addSql('ALTER TABLE blog_category DROP CONSTRAINT FK_72113DE6A76ED395');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE content DROP CONSTRAINT FK_FEC530A9A76ED395');
        $this->addSql('DROP TABLE blog_category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE configuration');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE "user"');
    }
}
