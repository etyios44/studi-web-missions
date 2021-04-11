<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210411133040 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9D17C042CF');
        $this->addSql('DROP INDEX IDX_268B9C9D17C042CF ON agent');
        $this->addSql('ALTER TABLE agent DROP missions_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent ADD missions_id INT NOT NULL');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D17C042CF FOREIGN KEY (missions_id) REFERENCES missions (id)');
        $this->addSql('CREATE INDEX IDX_268B9C9D17C042CF ON agent (missions_id)');
    }
}
