<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250610034253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE planche_pochette (planche_id INT NOT NULL, pochette_id INT NOT NULL, INDEX IDX_21282690DA8652A8 (planche_id), INDEX IDX_2128269033ECB04 (pochette_id), PRIMARY KEY(planche_id, pochette_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE prise_de_vue_pochette (prise_de_vue_id INT NOT NULL, pochette_id INT NOT NULL, INDEX IDX_D4FA72275C08B7F7 (prise_de_vue_id), INDEX IDX_D4FA722733ECB04 (pochette_id), PRIMARY KEY(prise_de_vue_id, pochette_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planche_pochette ADD CONSTRAINT FK_21282690DA8652A8 FOREIGN KEY (planche_id) REFERENCES planche (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planche_pochette ADD CONSTRAINT FK_2128269033ECB04 FOREIGN KEY (pochette_id) REFERENCES pochette (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE prise_de_vue_pochette ADD CONSTRAINT FK_D4FA72275C08B7F7 FOREIGN KEY (prise_de_vue_id) REFERENCES prise_de_vue (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE prise_de_vue_pochette ADD CONSTRAINT FK_D4FA722733ECB04 FOREIGN KEY (pochette_id) REFERENCES pochette (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planche DROP FOREIGN KEY FK_ABF41FB833ECB04
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_ABF41FB833ECB04 ON planche
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planche DROP pochette_id
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE planche_pochette DROP FOREIGN KEY FK_21282690DA8652A8
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planche_pochette DROP FOREIGN KEY FK_2128269033ECB04
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE prise_de_vue_pochette DROP FOREIGN KEY FK_D4FA72275C08B7F7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE prise_de_vue_pochette DROP FOREIGN KEY FK_D4FA722733ECB04
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE planche_pochette
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE prise_de_vue_pochette
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planche ADD pochette_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planche ADD CONSTRAINT FK_ABF41FB833ECB04 FOREIGN KEY (pochette_id) REFERENCES pochette (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_ABF41FB833ECB04 ON planche (pochette_id)
        SQL);
    }
}
