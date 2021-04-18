<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416164904 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE contact ADD country_id INT NOT NULL, DROP nationality');
        //$this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        //$this->addSql('CREATE INDEX IDX_4C62E638F92F3E70 ON contact (country_id)');
        //$this->addSql('ALTER TABLE target ADD CONSTRAINT FK_466F2FFCF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        //$this->addSql('CREATE INDEX IDX_466F2FFCF92F3E70 ON target (country_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638F92F3E70');
        $this->addSql('DROP INDEX IDX_4C62E638F92F3E70 ON contact');
        $this->addSql('ALTER TABLE contact ADD nationality VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP country_id');
        $this->addSql('ALTER TABLE target DROP FOREIGN KEY FK_466F2FFCF92F3E70');
        $this->addSql('DROP INDEX IDX_466F2FFCF92F3E70 ON target');
    }
}
