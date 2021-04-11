<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210404154312 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        //$this->addSql('CREATE INDEX IDX_34F1D47E6BF700BD ON missions (status_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E6BF700BD');
        //$this->addSql('DROP INDEX IDX_34F1D47E6BF700BD ON missions');
    }
}
