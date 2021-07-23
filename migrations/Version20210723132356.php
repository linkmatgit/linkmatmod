<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210723132356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_category (id SERIAL NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, description TEXT NOT NULL, posts_count INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_72113DE6989D9B62 ON blog_category (slug)');
        $this->addSql('CREATE INDEX IDX_72113DE6A76ED395 ON blog_category (user_id)');
        $this->addSql('CREATE TABLE comment (id SERIAL NOT NULL, author_id INT NOT NULL, content_id INT DEFAULT NULL, content TEXT NOT NULL, publish_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('CREATE INDEX IDX_9474526C84A0A3ED ON comment (content_id)');
        $this->addSql('CREATE TABLE configuration (id SERIAL NOT NULL, title VARCHAR(255) DEFAULT NULL, color_header VARCHAR(255) DEFAULT NULL, color_footer VARCHAR(255) DEFAULT NULL, copyright VARCHAR(255) DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN configuration.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE content (id SERIAL NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, online BOOLEAN DEFAULT \'false\' NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FEC530A92B36786B ON content (title)');
        $this->addSql('CREATE INDEX IDX_FEC530A9A76ED395 ON content (user_id)');
        $this->addSql('CREATE TABLE forum_message (id SERIAL NOT NULL, user_id INT DEFAULT NULL, topic_id INT DEFAULT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, notification BOOLEAN DEFAULT \'true\' NOT NULL, accepted BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_47717D0EA76ED395 ON forum_message (user_id)');
        $this->addSql('CREATE INDEX IDX_47717D0E1F55203D ON forum_message (topic_id)');
        $this->addSql('CREATE TABLE forum_tag (id SERIAL NOT NULL, user_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, title TEXT NOT NULL, slug TEXT NOT NULL, position INT NOT NULL, description TEXT NOT NULL, online BOOLEAN DEFAULT \'false\' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, color VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EEA7C17EA76ED395 ON forum_tag (user_id)');
        $this->addSql('CREATE INDEX IDX_EEA7C17E727ACA70 ON forum_tag (parent_id)');
        $this->addSql('CREATE TABLE forum_topic (id SERIAL NOT NULL, user_id INT DEFAULT NULL, last_message_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, content TEXT NOT NULL, solved BOOLEAN DEFAULT \'false\' NOT NULL, sticky BOOLEAN DEFAULT \'false\' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_853478CCA76ED395 ON forum_topic (user_id)');
        $this->addSql('CREATE INDEX IDX_853478CCBA0E79C3 ON forum_topic (last_message_id)');
        $this->addSql('CREATE TABLE forum_topic_tag (forum_topic_id INT NOT NULL, forum_tag_id INT NOT NULL, PRIMARY KEY(forum_topic_id, forum_tag_id))');
        $this->addSql('CREATE INDEX IDX_E63427738A6ADDA ON forum_topic_tag (forum_topic_id)');
        $this->addSql('CREATE INDEX IDX_E634277A27D50C0 ON forum_topic_tag (forum_tag_id)');
        $this->addSql('CREATE TABLE mods_brand (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mods_category (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mods_fs (id INT NOT NULL, brand_id INT DEFAULT NULL, category_id INT DEFAULT NULL, price VARCHAR(255) NOT NULL, size VARCHAR(255) DEFAULT NULL, release_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, support BOOLEAN DEFAULT \'false\' NOT NULL, version VARCHAR(255) DEFAULT NULL, uri VARCHAR(255) DEFAULT NULL, public BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6DC1401841CB121 ON mods_fs (uri)');
        $this->addSql('CREATE INDEX IDX_6DC140144F5D008 ON mods_fs (brand_id)');
        $this->addSql('CREATE INDEX IDX_6DC140112469DE2 ON mods_fs (category_id)');
        $this->addSql('CREATE TABLE mods_user (mods_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(mods_id, user_id))');
        $this->addSql('CREATE INDEX IDX_A635869C2978D09 ON mods_user (mods_id)');
        $this->addSql('CREATE INDEX IDX_A635869CA76ED395 ON mods_user (user_id)');
        $this->addSql('CREATE TABLE notification (id SERIAL NOT NULL, user_id INT DEFAULT NULL, message VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, chanel VARCHAR(255) DEFAULT NULL, string VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BF5476CAA76ED395 ON notification (user_id)');
        $this->addSql('COMMENT ON COLUMN notification.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE post (id INT NOT NULL, category_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D12469DE2 ON post (category_id)');
        $this->addSql('CREATE TABLE reset_password_request (id INT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('COMMENT ON COLUMN reset_password_request.requested_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reset_password_request.expires_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE revision (id SERIAL NOT NULL, author_id INT NOT NULL, target_id INT NOT NULL, content VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6D6315CCF675F31B ON revision (author_id)');
        $this->addSql('CREATE INDEX IDX_6D6315CC158E0B66 ON revision (target_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(200) NOT NULL, is_verified BOOLEAN NOT NULL, avatar_name VARCHAR(255) DEFAULT NULL, avatar_size INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, header_name VARCHAR(255) DEFAULT NULL, header_size INT DEFAULT NULL, last_login_ip VARCHAR(255) DEFAULT NULL, last_login_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, theme VARCHAR(255) DEFAULT NULL, banned_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, country VARCHAR(2) DEFAULT \'CA\', PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE wip_message (id SERIAL NOT NULL, user_id INT DEFAULT NULL, topic_id INT DEFAULT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, notification BOOLEAN DEFAULT \'true\' NOT NULL, accepted BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C6181498A76ED395 ON wip_message (user_id)');
        $this->addSql('CREATE INDEX IDX_C61814981F55203D ON wip_message (topic_id)');
        $this->addSql('CREATE TABLE wip_tag (id INT NOT NULL, category_id INT DEFAULT NULL, statut SMALLINT DEFAULT -1 NOT NULL, approved BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D2CFEE312469DE2 ON wip_tag (category_id)');
        $this->addSql('CREATE TABLE wip_topic (id SERIAL NOT NULL, user_id INT DEFAULT NULL, tags_id INT NOT NULL, name VARCHAR(255) NOT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F7BD422DA76ED395 ON wip_topic (user_id)');
        $this->addSql('CREATE INDEX IDX_F7BD422D8D7B4FB4 ON wip_topic (tags_id)');
        $this->addSql('COMMENT ON COLUMN wip_topic.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN wip_topic.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE blog_category ADD CONSTRAINT FK_72113DE6A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C84A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_message ADD CONSTRAINT FK_47717D0EA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_message ADD CONSTRAINT FK_47717D0E1F55203D FOREIGN KEY (topic_id) REFERENCES forum_topic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_tag ADD CONSTRAINT FK_EEA7C17EA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_tag ADD CONSTRAINT FK_EEA7C17E727ACA70 FOREIGN KEY (parent_id) REFERENCES forum_tag (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_topic ADD CONSTRAINT FK_853478CCA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_topic ADD CONSTRAINT FK_853478CCBA0E79C3 FOREIGN KEY (last_message_id) REFERENCES forum_message (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_topic_tag ADD CONSTRAINT FK_E63427738A6ADDA FOREIGN KEY (forum_topic_id) REFERENCES forum_topic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_topic_tag ADD CONSTRAINT FK_E634277A27D50C0 FOREIGN KEY (forum_tag_id) REFERENCES forum_tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mods_fs ADD CONSTRAINT FK_6DC140144F5D008 FOREIGN KEY (brand_id) REFERENCES mods_brand (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mods_fs ADD CONSTRAINT FK_6DC140112469DE2 FOREIGN KEY (category_id) REFERENCES mods_category (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mods_fs ADD CONSTRAINT FK_6DC1401BF396750 FOREIGN KEY (id) REFERENCES content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mods_user ADD CONSTRAINT FK_A635869C2978D09 FOREIGN KEY (mods_id) REFERENCES mods_fs (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mods_user ADD CONSTRAINT FK_A635869CA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D12469DE2 FOREIGN KEY (category_id) REFERENCES blog_category (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DBF396750 FOREIGN KEY (id) REFERENCES content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE revision ADD CONSTRAINT FK_6D6315CCF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE revision ADD CONSTRAINT FK_6D6315CC158E0B66 FOREIGN KEY (target_id) REFERENCES content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wip_message ADD CONSTRAINT FK_C6181498A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wip_message ADD CONSTRAINT FK_C61814981F55203D FOREIGN KEY (topic_id) REFERENCES wip_topic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wip_tag ADD CONSTRAINT FK_D2CFEE312469DE2 FOREIGN KEY (category_id) REFERENCES mods_category (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wip_tag ADD CONSTRAINT FK_D2CFEE3BF396750 FOREIGN KEY (id) REFERENCES content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wip_topic ADD CONSTRAINT FK_F7BD422DA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wip_topic ADD CONSTRAINT FK_F7BD422D8D7B4FB4 FOREIGN KEY (tags_id) REFERENCES wip_tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8D12469DE2');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C84A0A3ED');
        $this->addSql('ALTER TABLE mods_fs DROP CONSTRAINT FK_6DC1401BF396750');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8DBF396750');
        $this->addSql('ALTER TABLE revision DROP CONSTRAINT FK_6D6315CC158E0B66');
        $this->addSql('ALTER TABLE wip_tag DROP CONSTRAINT FK_D2CFEE3BF396750');
        $this->addSql('ALTER TABLE forum_topic DROP CONSTRAINT FK_853478CCBA0E79C3');
        $this->addSql('ALTER TABLE forum_tag DROP CONSTRAINT FK_EEA7C17E727ACA70');
        $this->addSql('ALTER TABLE forum_topic_tag DROP CONSTRAINT FK_E634277A27D50C0');
        $this->addSql('ALTER TABLE forum_message DROP CONSTRAINT FK_47717D0E1F55203D');
        $this->addSql('ALTER TABLE forum_topic_tag DROP CONSTRAINT FK_E63427738A6ADDA');
        $this->addSql('ALTER TABLE mods_fs DROP CONSTRAINT FK_6DC140144F5D008');
        $this->addSql('ALTER TABLE mods_fs DROP CONSTRAINT FK_6DC140112469DE2');
        $this->addSql('ALTER TABLE wip_tag DROP CONSTRAINT FK_D2CFEE312469DE2');
        $this->addSql('ALTER TABLE mods_user DROP CONSTRAINT FK_A635869C2978D09');
        $this->addSql('ALTER TABLE blog_category DROP CONSTRAINT FK_72113DE6A76ED395');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE content DROP CONSTRAINT FK_FEC530A9A76ED395');
        $this->addSql('ALTER TABLE forum_message DROP CONSTRAINT FK_47717D0EA76ED395');
        $this->addSql('ALTER TABLE forum_tag DROP CONSTRAINT FK_EEA7C17EA76ED395');
        $this->addSql('ALTER TABLE forum_topic DROP CONSTRAINT FK_853478CCA76ED395');
        $this->addSql('ALTER TABLE mods_user DROP CONSTRAINT FK_A635869CA76ED395');
        $this->addSql('ALTER TABLE notification DROP CONSTRAINT FK_BF5476CAA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP CONSTRAINT FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE revision DROP CONSTRAINT FK_6D6315CCF675F31B');
        $this->addSql('ALTER TABLE wip_message DROP CONSTRAINT FK_C6181498A76ED395');
        $this->addSql('ALTER TABLE wip_topic DROP CONSTRAINT FK_F7BD422DA76ED395');
        $this->addSql('ALTER TABLE wip_topic DROP CONSTRAINT FK_F7BD422D8D7B4FB4');
        $this->addSql('ALTER TABLE wip_message DROP CONSTRAINT FK_C61814981F55203D');
        $this->addSql('DROP TABLE blog_category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE configuration');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE forum_message');
        $this->addSql('DROP TABLE forum_tag');
        $this->addSql('DROP TABLE forum_topic');
        $this->addSql('DROP TABLE forum_topic_tag');
        $this->addSql('DROP TABLE mods_brand');
        $this->addSql('DROP TABLE mods_category');
        $this->addSql('DROP TABLE mods_fs');
        $this->addSql('DROP TABLE mods_user');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE revision');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE wip_message');
        $this->addSql('DROP TABLE wip_tag');
        $this->addSql('DROP TABLE wip_topic');
    }
}
