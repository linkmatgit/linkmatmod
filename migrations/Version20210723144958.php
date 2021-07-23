<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210723144958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE reset_password_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE wip_message DROP CONSTRAINT fk_c6181498a76ed395');
        $this->addSql('DROP INDEX idx_c6181498a76ed395');
        $this->addSql('ALTER TABLE wip_message ALTER notification SET DEFAULT \'false\'');
        $this->addSql('ALTER TABLE wip_message RENAME COLUMN user_id TO author_id');
        $this->addSql('ALTER TABLE wip_message ADD CONSTRAINT FK_C6181498F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C6181498F675F31B ON wip_message (author_id)');
        $this->addSql('ALTER TABLE wip_tag DROP CONSTRAINT fk_d2cfee312469de2');
        $this->addSql('ALTER TABLE wip_tag DROP CONSTRAINT fk_d2cfee3bf396750');
        $this->addSql('DROP INDEX idx_d2cfee312469de2');
        $this->addSql('ALTER TABLE wip_tag ADD name VARCHAR(70) NOT NULL');
        $this->addSql('ALTER TABLE wip_tag ADD content VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE wip_tag ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE wip_tag ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE wip_tag DROP category_id');
        $this->addSql('ALTER TABLE wip_tag DROP statut');
        $this->addSql('CREATE SEQUENCE wip_tag_id_seq');
        $this->addSql('SELECT setval(\'wip_tag_id_seq\', (SELECT MAX(id) FROM wip_tag))');
        $this->addSql('ALTER TABLE wip_tag ALTER id SET DEFAULT nextval(\'wip_tag_id_seq\')');
        $this->addSql('ALTER TABLE wip_tag RENAME COLUMN approved TO accepted');
        $this->addSql('ALTER TABLE wip_topic DROP CONSTRAINT fk_f7bd422da76ed395');
        $this->addSql('ALTER TABLE wip_topic DROP CONSTRAINT FK_F7BD422D8D7B4FB4');
        $this->addSql('DROP INDEX idx_f7bd422da76ed395');
        $this->addSql('ALTER TABLE wip_topic ADD last_message_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE wip_topic ADD solved BOOLEAN DEFAULT \'false\' NOT NULL');
        $this->addSql('ALTER TABLE wip_topic ADD sticky BOOLEAN DEFAULT \'false\' NOT NULL');
        $this->addSql('ALTER TABLE wip_topic ADD message_count INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE wip_topic ALTER tags_id DROP NOT NULL');
        $this->addSql('ALTER TABLE wip_topic ALTER name TYPE VARCHAR(70)');
        $this->addSql('ALTER TABLE wip_topic ALTER created_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE wip_topic ALTER created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE wip_topic ALTER updated_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE wip_topic ALTER updated_at DROP DEFAULT');
        $this->addSql('ALTER TABLE wip_topic ALTER updated_at SET NOT NULL');
        $this->addSql('ALTER TABLE wip_topic RENAME COLUMN user_id TO author_id');
        $this->addSql('COMMENT ON COLUMN wip_topic.created_at IS NULL');
        $this->addSql('COMMENT ON COLUMN wip_topic.updated_at IS NULL');
        $this->addSql('ALTER TABLE wip_topic ADD CONSTRAINT FK_F7BD422DF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wip_topic ADD CONSTRAINT FK_F7BD422DBA0E79C3 FOREIGN KEY (last_message_id) REFERENCES wip_message (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wip_topic ADD CONSTRAINT FK_F7BD422D8D7B4FB4 FOREIGN KEY (tags_id) REFERENCES wip_tag (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F7BD422DF675F31B ON wip_topic (author_id)');
        $this->addSql('CREATE INDEX IDX_F7BD422DBA0E79C3 ON wip_topic (last_message_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE reset_password_request_id_seq CASCADE');
        $this->addSql('ALTER TABLE wip_message DROP CONSTRAINT FK_C6181498F675F31B');
        $this->addSql('DROP INDEX IDX_C6181498F675F31B');
        $this->addSql('ALTER TABLE wip_message ALTER notification SET DEFAULT \'true\'');
        $this->addSql('ALTER TABLE wip_message RENAME COLUMN author_id TO user_id');
        $this->addSql('ALTER TABLE wip_message ADD CONSTRAINT fk_c6181498a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c6181498a76ed395 ON wip_message (user_id)');
        $this->addSql('ALTER TABLE wip_topic DROP CONSTRAINT FK_F7BD422DF675F31B');
        $this->addSql('ALTER TABLE wip_topic DROP CONSTRAINT FK_F7BD422DBA0E79C3');
        $this->addSql('ALTER TABLE wip_topic DROP CONSTRAINT fk_f7bd422d8d7b4fb4');
        $this->addSql('DROP INDEX IDX_F7BD422DF675F31B');
        $this->addSql('DROP INDEX IDX_F7BD422DBA0E79C3');
        $this->addSql('ALTER TABLE wip_topic ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE wip_topic DROP author_id');
        $this->addSql('ALTER TABLE wip_topic DROP last_message_id');
        $this->addSql('ALTER TABLE wip_topic DROP solved');
        $this->addSql('ALTER TABLE wip_topic DROP sticky');
        $this->addSql('ALTER TABLE wip_topic DROP message_count');
        $this->addSql('ALTER TABLE wip_topic ALTER tags_id SET NOT NULL');
        $this->addSql('ALTER TABLE wip_topic ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE wip_topic ALTER created_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE wip_topic ALTER created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE wip_topic ALTER updated_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE wip_topic ALTER updated_at DROP DEFAULT');
        $this->addSql('ALTER TABLE wip_topic ALTER updated_at DROP NOT NULL');
        $this->addSql('COMMENT ON COLUMN wip_topic.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN wip_topic.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE wip_topic ADD CONSTRAINT fk_f7bd422da76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wip_topic ADD CONSTRAINT fk_f7bd422d8d7b4fb4 FOREIGN KEY (tags_id) REFERENCES wip_tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_f7bd422da76ed395 ON wip_topic (user_id)');
        $this->addSql('ALTER TABLE wip_tag ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE wip_tag ADD statut SMALLINT DEFAULT -1 NOT NULL');
        $this->addSql('ALTER TABLE wip_tag DROP name');
        $this->addSql('ALTER TABLE wip_tag DROP content');
        $this->addSql('ALTER TABLE wip_tag DROP updated_at');
        $this->addSql('ALTER TABLE wip_tag DROP created_at');
        $this->addSql('ALTER TABLE wip_tag ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE wip_tag RENAME COLUMN accepted TO approved');
        $this->addSql('ALTER TABLE wip_tag ADD CONSTRAINT fk_d2cfee312469de2 FOREIGN KEY (category_id) REFERENCES mods_category (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wip_tag ADD CONSTRAINT fk_d2cfee3bf396750 FOREIGN KEY (id) REFERENCES content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_d2cfee312469de2 ON wip_tag (category_id)');
    }
}
