<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180314103338 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit_membre CHANGE image_homme image_homme VARCHAR(255) DEFAULT NULL, CHANGE image_femme image_femme VARCHAR(255) DEFAULT NULL, CHANGE image_zoom_liste image_zoom_liste VARCHAR(255) DEFAULT NULL, CHANGE image_zoom_item image_zoom_item VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit_membre CHANGE image_homme image_homme VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE image_femme image_femme VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE image_zoom_liste image_zoom_liste VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE image_zoom_item image_zoom_item VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
