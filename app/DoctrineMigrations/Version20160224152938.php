<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160224152938 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE state (id INT AUTO_INCREMENT NOT NULL, pays_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_A393D2FBA6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE state ADD CONSTRAINT FK_A393D2FBA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE ville ADD state_id INT NOT NULL');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C35D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('CREATE INDEX IDX_43C3D9C35D83CC1 ON ville (state_id)');
        $this->addSql('ALTER TABLE pays ADD sortname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user_langue ADD CONSTRAINT FK_F6056EB3A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_langue ADD CONSTRAINT FK_F6056EB32AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_F6056EB3A76ED395 ON user_langue (user_id)');
        $this->addSql('DROP INDEX langue_id ON user_langue');
        $this->addSql('CREATE INDEX IDX_F6056EB32AADBACD ON user_langue (langue_id)');
        $this->addSql('ALTER TABLE user_tools DROP FOREIGN KEY user_tools_ibfk_1');
        $this->addSql('ALTER TABLE user_tools DROP FOREIGN KEY user_tools_ibfk_2');
        $this->addSql('ALTER TABLE user_tools DROP FOREIGN KEY user_tools_ibfk_2');
        $this->addSql('ALTER TABLE user_tools ADD CONSTRAINT FK_838252FA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_tools ADD CONSTRAINT FK_838252F752C489C FOREIGN KEY (tools_id) REFERENCES tools (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX tools_id ON user_tools');
        $this->addSql('CREATE INDEX IDX_838252F752C489C ON user_tools (tools_id)');
        $this->addSql('ALTER TABLE user_tools ADD CONSTRAINT user_tools_ibfk_2 FOREIGN KEY (tools_id) REFERENCES domaine (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C35D83CC1');
        $this->addSql('DROP TABLE state');
        $this->addSql('ALTER TABLE pays DROP sortname');
        $this->addSql('ALTER TABLE user_langue DROP FOREIGN KEY FK_F6056EB3A76ED395');
        $this->addSql('ALTER TABLE user_langue DROP FOREIGN KEY FK_F6056EB32AADBACD');
        $this->addSql('DROP INDEX IDX_F6056EB3A76ED395 ON user_langue');
        $this->addSql('ALTER TABLE user_langue DROP FOREIGN KEY FK_F6056EB32AADBACD');
        $this->addSql('DROP INDEX idx_f6056eb32aadbacd ON user_langue');
        $this->addSql('CREATE INDEX langue_id ON user_langue (langue_id)');
        $this->addSql('ALTER TABLE user_langue ADD CONSTRAINT FK_F6056EB32AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_tools DROP FOREIGN KEY FK_838252FA76ED395');
        $this->addSql('ALTER TABLE user_tools DROP FOREIGN KEY FK_838252F752C489C');
        $this->addSql('ALTER TABLE user_tools DROP FOREIGN KEY FK_838252F752C489C');
        $this->addSql('ALTER TABLE user_tools ADD CONSTRAINT user_tools_ibfk_1 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE user_tools ADD CONSTRAINT user_tools_ibfk_2 FOREIGN KEY (tools_id) REFERENCES domaine (id)');
        $this->addSql('DROP INDEX idx_838252f752c489c ON user_tools');
        $this->addSql('CREATE INDEX tools_id ON user_tools (tools_id)');
        $this->addSql('ALTER TABLE user_tools ADD CONSTRAINT FK_838252F752C489C FOREIGN KEY (tools_id) REFERENCES tools (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX IDX_43C3D9C35D83CC1 ON ville');
        $this->addSql('ALTER TABLE ville DROP state_id');
    }
}
