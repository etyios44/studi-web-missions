<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210406181656 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, speciality_id INT NOT NULL, mission_id INT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, birthday DATE NOT NULL, nationality VARCHAR(255) NOT NULL, INDEX IDX_268B9C9D3B5A08D7 (speciality_id), INDEX IDX_268B9C9DBE6CAE90 (mission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, birthday DATE NOT NULL, namecode VARCHAR(255) NOT NULL, nationality VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, target_id INT NOT NULL, type_mission_id INT NOT NULL, UNIQUE INDEX UNIQ_9067F23C158E0B66 (target_id), INDEX IDX_9067F23CA36F78B5 (type_mission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('CREATE TABLE mission_contact (mission_id INT NOT NULL, contact_id INT NOT NULL, INDEX IDX_DD5E7275BE6CAE90 (mission_id), INDEX IDX_DD5E7275E7A1254A (contact_id), PRIMARY KEY(mission_id, contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('CREATE TABLE mission_stash (mission_id INT NOT NULL, stash_id INT NOT NULL, INDEX IDX_2F567BCBE6CAE90 (mission_id), INDEX IDX_2F567BC4592380C (stash_id), PRIMARY KEY(mission_id, stash_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('CREATE TABLE mission_speciality (mission_id INT NOT NULL, speciality_id INT NOT NULL, INDEX IDX_B1D78D15BE6CAE90 (mission_id), INDEX IDX_B1D78D153B5A08D7 (speciality_id), PRIMARY KEY(mission_id, speciality_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('CREATE TABLE speciality (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, detail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('CREATE TABLE stash (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('CREATE TABLE target (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, birthday DATE NOT NULL, namecode VARCHAR(255) NOT NULL, nationality VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('CREATE TABLE type_mission (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, detail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id)');
        //$this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        //$this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C158E0B66 FOREIGN KEY (target_id) REFERENCES target (id)');
        //$this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CA36F78B5 FOREIGN KEY (type_mission_id) REFERENCES type_mission (id)');
        //$this->addSql('ALTER TABLE mission_contact ADD CONSTRAINT FK_DD5E7275BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        //$this->addSql('ALTER TABLE mission_contact ADD CONSTRAINT FK_DD5E7275E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
        //$this->addSql('ALTER TABLE mission_stash ADD CONSTRAINT FK_2F567BCBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        //$this->addSql('ALTER TABLE mission_stash ADD CONSTRAINT FK_2F567BC4592380C FOREIGN KEY (stash_id) REFERENCES stash (id) ON DELETE CASCADE');
        //$this->addSql('ALTER TABLE mission_speciality ADD CONSTRAINT FK_B1D78D15BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        //$this->addSql('ALTER TABLE mission_speciality ADD CONSTRAINT FK_B1D78D153B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id) ON DELETE CASCADE');
        //$this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        //$this->addSql('CREATE INDEX IDX_34F1D47E6BF700BD ON missions (status_id)');
        //$this->addSql('ALTER TABLE user ADD firstname VARCHAR(255) NOT NULL, ADD nationality VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission_contact DROP FOREIGN KEY FK_DD5E7275E7A1254A');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9DBE6CAE90');
        $this->addSql('ALTER TABLE mission_contact DROP FOREIGN KEY FK_DD5E7275BE6CAE90');
        $this->addSql('ALTER TABLE mission_stash DROP FOREIGN KEY FK_2F567BCBE6CAE90');
        $this->addSql('ALTER TABLE mission_speciality DROP FOREIGN KEY FK_B1D78D15BE6CAE90');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9D3B5A08D7');
        $this->addSql('ALTER TABLE mission_speciality DROP FOREIGN KEY FK_B1D78D153B5A08D7');
        $this->addSql('ALTER TABLE mission_stash DROP FOREIGN KEY FK_2F567BC4592380C');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C158E0B66');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CA36F78B5');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE mission_contact');
        $this->addSql('DROP TABLE mission_stash');
        $this->addSql('DROP TABLE mission_speciality');
        $this->addSql('DROP TABLE speciality');
        $this->addSql('DROP TABLE stash');
        $this->addSql('DROP TABLE target');
        $this->addSql('DROP TABLE type_mission');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E6BF700BD');
        $this->addSql('DROP INDEX IDX_34F1D47E6BF700BD ON missions');
        $this->addSql('ALTER TABLE user DROP firstname, DROP nationality');
    }
}
