<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416191704 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE missions_agent (missions_id INT NOT NULL, agent_id INT NOT NULL, INDEX IDX_FC56F9A717C042CF (missions_id), INDEX IDX_FC56F9A73414710B (agent_id), PRIMARY KEY(missions_id, agent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE missions_agent ADD CONSTRAINT FK_FC56F9A717C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_agent ADD CONSTRAINT FK_FC56F9A73414710B FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agent DROP missions_id');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47EF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_34F1D47EF92F3E70 ON missions (country_id)');
        $this->addSql('ALTER TABLE stash ADD CONSTRAINT FK_92633881F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_92633881F92F3E70 ON stash (country_id)');
        $this->addSql('ALTER TABLE target ADD CONSTRAINT FK_466F2FFCF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_466F2FFCF92F3E70 ON target (country_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE missions_agent');
        $this->addSql('ALTER TABLE agent ADD missions_id INT NOT NULL');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47EF92F3E70');
        $this->addSql('DROP INDEX IDX_34F1D47EF92F3E70 ON missions');
        $this->addSql('ALTER TABLE stash DROP FOREIGN KEY FK_92633881F92F3E70');
        $this->addSql('DROP INDEX IDX_92633881F92F3E70 ON stash');
        $this->addSql('ALTER TABLE target DROP FOREIGN KEY FK_466F2FFCF92F3E70');
        $this->addSql('DROP INDEX IDX_466F2FFCF92F3E70 ON target');
    }
}
