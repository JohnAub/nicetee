<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180313144824 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit_intern ADD image_homme VARCHAR(255) NOT NULL, ADD image_femme VARCHAR(255) NOT NULL, ADD image_zoom_liste VARCHAR(255) NOT NULL, ADD image_zoom_item VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE produit_membre ADD image_homme VARCHAR(255) NOT NULL, ADD image_femme VARCHAR(255) NOT NULL, ADD image_zoom_liste VARCHAR(255) NOT NULL, ADD image_zoom_item VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit_intern DROP image_homme, DROP image_femme, DROP image_zoom_liste, DROP image_zoom_item');
        $this->addSql('ALTER TABLE produit_membre DROP image_homme, DROP image_femme, DROP image_zoom_liste, DROP image_zoom_item');
    }
}
