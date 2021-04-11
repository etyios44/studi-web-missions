<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210410150807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE missions_status (missions_id INT NOT NULL, status_id INT NOT NULL, INDEX IDX_BDD661CB17C042CF (missions_id), INDEX IDX_BDD661CB6BF700BD (status_id), PRIMARY KEY(missions_id, status_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE missions_status ADD CONSTRAINT FK_BDD661CB17C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_status ADD CONSTRAINT FK_BDD661CB6BF700BD FOREIGN KEY (status_id) REFERENCES status (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E6BF700BD');
        $this->addSql('DROP INDEX IDX_34F1D47E6BF700BD ON missions');
        $this->addSql('ALTER TABLE missions DROP status_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE missions_status');
        $this->addSql('ALTER TABLE missions ADD status_id INT NOT NULL');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_34F1D47E6BF700BD ON missions (status_id)');
    }
}
