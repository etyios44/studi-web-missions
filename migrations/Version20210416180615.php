<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416180615 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE missions ADD country_id INT NOT NULL, DROP country_mission');
        //$this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47EF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        //$this->addSql('CREATE INDEX IDX_34F1D47EF92F3E70 ON missions (country_id)');
        //$this->addSql('ALTER TABLE stash ADD CONSTRAINT FK_92633881F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        //$this->addSql('CREATE INDEX IDX_92633881F92F3E70 ON stash (country_id)');
        //$this->addSql('ALTER TABLE target ADD CONSTRAINT FK_466F2FFCF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        //$this->addSql('CREATE INDEX IDX_466F2FFCF92F3E70 ON target (country_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47EF92F3E70');
        $this->addSql('DROP INDEX IDX_34F1D47EF92F3E70 ON missions');
        $this->addSql('ALTER TABLE missions ADD country_mission VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP country_id');
        $this->addSql('ALTER TABLE stash DROP FOREIGN KEY FK_92633881F92F3E70');
        $this->addSql('DROP INDEX IDX_92633881F92F3E70 ON stash');
        $this->addSql('ALTER TABLE target DROP FOREIGN KEY FK_466F2FFCF92F3E70');
        $this->addSql('DROP INDEX IDX_466F2FFCF92F3E70 ON target');
    }
}
