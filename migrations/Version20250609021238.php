<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250609021238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, rue VARCHAR(255) NOT NULL, ville VARCHAR(50) NOT NULL, code_postale VARCHAR(6) NOT NULL, pays VARCHAR(30) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ecole (id INT AUTO_INCREMENT NOT NULL, adresse_id INT NOT NULL, code VARCHAR(5) NOT NULL, genre VARCHAR(20) DEFAULT NULL, nom VARCHAR(35) NOT NULL, tel VARCHAR(25) NOT NULL, email VARCHAR(255) DEFAULT NULL, active TINYINT(1) NOT NULL, create_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', UNIQUE INDEX UNIQ_9786AAC4DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE planche (id INT AUTO_INCREMENT NOT NULL, createur_id INT NOT NULL, pochette_id INT NOT NULL, nom_planche VARCHAR(35) NOT NULL, create_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_ABF41FB873A201E5 (createur_id), INDEX IDX_ABF41FB833ECB04 (pochette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE pochette (id INT AUTO_INCREMENT NOT NULL, createur_id INT NOT NULL, nom_pochette VARCHAR(35) NOT NULL, INDEX IDX_BA25DD1573A201E5 (createur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE prise_de_vue (id INT AUTO_INCREMENT NOT NULL, ecole_id INT DEFAULT NULL, photographe_id INT NOT NULL, type_de_prise_id INT NOT NULL, type_vente_id INT DEFAULT NULL, theme_id INT NOT NULL, date_prise_vue DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', crated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', nb_eleve INT NOT NULL, nb_classe INT NOT NULL, prix_ecole NUMERIC(10, 0) NOT NULL, prix_parent NUMERIC(10, 0) DEFAULT NULL, INDEX IDX_3EAEED8177EF1B1E (ecole_id), INDEX IDX_3EAEED8197DB59CB (photographe_id), INDEX IDX_3EAEED8189604D58 (type_de_prise_id), INDEX IDX_3EAEED81B03830F6 (type_vente_id), INDEX IDX_3EAEED8159027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, createur_id INT NOT NULL, nom_theme VARCHAR(35) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_9775E70873A201E5 (createur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE type_prise_vue (id INT AUTO_INCREMENT NOT NULL, nom_type_prise VARCHAR(35) NOT NULL, create_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE type_vente (id INT AUTO_INCREMENT NOT NULL, nom_type_vente VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(35) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', nom VARCHAR(35) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ecole ADD CONSTRAINT FK_9786AAC4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planche ADD CONSTRAINT FK_ABF41FB873A201E5 FOREIGN KEY (createur_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planche ADD CONSTRAINT FK_ABF41FB833ECB04 FOREIGN KEY (pochette_id) REFERENCES pochette (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pochette ADD CONSTRAINT FK_BA25DD1573A201E5 FOREIGN KEY (createur_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE prise_de_vue ADD CONSTRAINT FK_3EAEED8177EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE prise_de_vue ADD CONSTRAINT FK_3EAEED8197DB59CB FOREIGN KEY (photographe_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE prise_de_vue ADD CONSTRAINT FK_3EAEED8189604D58 FOREIGN KEY (type_de_prise_id) REFERENCES type_prise_vue (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE prise_de_vue ADD CONSTRAINT FK_3EAEED81B03830F6 FOREIGN KEY (type_vente_id) REFERENCES type_vente (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE prise_de_vue ADD CONSTRAINT FK_3EAEED8159027487 FOREIGN KEY (theme_id) REFERENCES theme (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE theme ADD CONSTRAINT FK_9775E70873A201E5 FOREIGN KEY (createur_id) REFERENCES `user` (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE ecole DROP FOREIGN KEY FK_9786AAC4DE7DC5C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planche DROP FOREIGN KEY FK_ABF41FB873A201E5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planche DROP FOREIGN KEY FK_ABF41FB833ECB04
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pochette DROP FOREIGN KEY FK_BA25DD1573A201E5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE prise_de_vue DROP FOREIGN KEY FK_3EAEED8177EF1B1E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE prise_de_vue DROP FOREIGN KEY FK_3EAEED8197DB59CB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE prise_de_vue DROP FOREIGN KEY FK_3EAEED8189604D58
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE prise_de_vue DROP FOREIGN KEY FK_3EAEED81B03830F6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE prise_de_vue DROP FOREIGN KEY FK_3EAEED8159027487
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE theme DROP FOREIGN KEY FK_9775E70873A201E5
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE adresse
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ecole
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE planche
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE pochette
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE prise_de_vue
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE theme
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE type_prise_vue
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE type_vente
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `user`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
