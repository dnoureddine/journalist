<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160220133137 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user ADD titre LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_domaine DROP FOREIGN KEY FK_20A214C64272FC9F');
        $this->addSql('DROP INDEX fk_20a214c64272fc9f ON user_domaine');
        $this->addSql('CREATE INDEX IDX_20A214C64272FC9F ON user_domaine (domaine_id)');
        $this->addSql('ALTER TABLE user_domaine ADD CONSTRAINT FK_20A214C64272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_langue DROP FOREIGN KEY user_langue_ibfk_1');
        $this->addSql('ALTER TABLE user_langue DROP FOREIGN KEY user_langue_ibfk_2');
        $this->addSql('ALTER TABLE user_langue DROP FOREIGN KEY user_langue_ibfk_2');
        $this->addSql('ALTER TABLE user_langue ADD CONSTRAINT FK_F6056EB3A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_langue ADD CONSTRAINT FK_F6056EB32AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX langue_id ON user_langue');
        $this->addSql('CREATE INDEX IDX_F6056EB32AADBACD ON user_langue (langue_id)');
        $this->addSql('ALTER TABLE user_langue ADD CONSTRAINT user_langue_ibfk_2 FOREIGN KEY (langue_id) REFERENCES langue (id)');
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

        $this->addSql('ALTER TABLE fos_user DROP titre');
        $this->addSql('ALTER TABLE user_domaine DROP FOREIGN KEY FK_20A214C64272FC9F');
        $this->addSql('DROP INDEX idx_20a214c64272fc9f ON user_domaine');
        $this->addSql('CREATE INDEX FK_20A214C64272FC9F ON user_domaine (domaine_id)');
        $this->addSql('ALTER TABLE user_domaine ADD CONSTRAINT FK_20A214C64272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_langue DROP FOREIGN KEY FK_F6056EB3A76ED395');
        $this->addSql('ALTER TABLE user_langue DROP FOREIGN KEY FK_F6056EB32AADBACD');
        $this->addSql('ALTER TABLE user_langue DROP FOREIGN KEY FK_F6056EB32AADBACD');
        $this->addSql('ALTER TABLE user_langue ADD CONSTRAINT user_langue_ibfk_1 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE user_langue ADD CONSTRAINT user_langue_ibfk_2 FOREIGN KEY (langue_id) REFERENCES langue (id)');
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
    }
}
