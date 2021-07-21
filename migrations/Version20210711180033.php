<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210711180033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE forum_message (id SERIAL NOT NULL, user_id INT DEFAULT NULL, topic_id INT DEFAULT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, notification BOOLEAN DEFAULT \'true\' NOT NULL, accepted BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_47717D0EA76ED395 ON forum_message (user_id)');
        $this->addSql('CREATE INDEX IDX_47717D0E1F55203D ON forum_message (topic_id)');
        $this->addSql('CREATE TABLE forum_tag (id SERIAL NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, position INT NOT NULL, description TEXT NOT NULL, online BOOLEAN DEFAULT \'false\' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EEA7C17EA76ED395 ON forum_tag (user_id)');
        $this->addSql('CREATE TABLE forum_topic (id SERIAL NOT NULL, user_id INT DEFAULT NULL, last_message_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, content TEXT NOT NULL, solved BOOLEAN DEFAULT \'false\' NOT NULL, sticky BOOLEAN DEFAULT \'false\' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_853478CCA76ED395 ON forum_topic (user_id)');
        $this->addSql('CREATE INDEX IDX_853478CCBA0E79C3 ON forum_topic (last_message_id)');
        $this->addSql('CREATE TABLE forum_topic_tag (forum_topic_id INT NOT NULL, forum_tag_id INT NOT NULL, PRIMARY KEY(forum_topic_id, forum_tag_id))');
        $this->addSql('CREATE INDEX IDX_E63427738A6ADDA ON forum_topic_tag (forum_topic_id)');
        $this->addSql('CREATE INDEX IDX_E634277A27D50C0 ON forum_topic_tag (forum_tag_id)');
        $this->addSql('ALTER TABLE forum_message ADD CONSTRAINT FK_47717D0EA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_message ADD CONSTRAINT FK_47717D0E1F55203D FOREIGN KEY (topic_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_tag ADD CONSTRAINT FK_EEA7C17EA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_topic ADD CONSTRAINT FK_853478CCA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_topic ADD CONSTRAINT FK_853478CCBA0E79C3 FOREIGN KEY (last_message_id) REFERENCES forum_message (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_topic_tag ADD CONSTRAINT FK_E63427738A6ADDA FOREIGN KEY (forum_topic_id) REFERENCES forum_topic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_topic_tag ADD CONSTRAINT FK_E634277A27D50C0 FOREIGN KEY (forum_tag_id) REFERENCES forum_tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE forum_topic DROP CONSTRAINT FK_853478CCBA0E79C3');
        $this->addSql('ALTER TABLE forum_topic_tag DROP CONSTRAINT FK_E634277A27D50C0');
        $this->addSql('ALTER TABLE forum_topic_tag DROP CONSTRAINT FK_E63427738A6ADDA');
        $this->addSql('DROP TABLE forum_message');
        $this->addSql('DROP TABLE forum_tag');
        $this->addSql('DROP TABLE forum_topic');
        $this->addSql('DROP TABLE forum_topic_tag');
    }
}
