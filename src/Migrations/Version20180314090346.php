<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180314090346 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit_intern CHANGE fournisseur fournisseur VARCHAR(255) DEFAULT NULL, CHANGE prix_achat prix_achat DOUBLE PRECISION DEFAULT NULL, CHANGE taux_vente taux_vente DOUBLE PRECISION DEFAULT NULL, CHANGE designation designation VARCHAR(255) DEFAULT NULL, CHANGE sex sex VARCHAR(255) DEFAULT NULL, CHANGE taille taille VARCHAR(255) DEFAULT NULL, CHANGE couleur couleur VARCHAR(255) DEFAULT NULL, CHANGE qty qty INT DEFAULT NULL, CHANGE prix_ventes prix_ventes DOUBLE PRECISION DEFAULT NULL, CHANGE qty_vendu qty_vendu INT DEFAULT NULL, CHANGE tva tva DOUBLE PRECISION DEFAULT NULL, CHANGE date_ajout date_ajout DATETIME DEFAULT NULL, CHANGE image_homme image_homme VARCHAR(255) DEFAULT NULL, CHANGE image_femme image_femme VARCHAR(255) DEFAULT NULL, CHANGE image_zoom_liste image_zoom_liste VARCHAR(255) DEFAULT NULL, CHANGE image_zoom_item image_zoom_item VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE produit_membre CHANGE designation designation VARCHAR(255) DEFAULT NULL, CHANGE sex sex VARCHAR(255) DEFAULT NULL, CHANGE taille taille VARCHAR(255) DEFAULT NULL, CHANGE couleur couleur VARCHAR(255) DEFAULT NULL, CHANGE qty qty INT DEFAULT NULL, CHANGE prix_ventes prix_ventes DOUBLE PRECISION DEFAULT NULL, CHANGE qty_vendu qty_vendu INT DEFAULT NULL, CHANGE tva tva DOUBLE PRECISION DEFAULT NULL, CHANGE date_ajout date_ajout DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit_intern CHANGE fournisseur fournisseur VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE image_homme image_homme VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE image_femme image_femme VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE image_zoom_liste image_zoom_liste VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE image_zoom_item image_zoom_item VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE prix_achat prix_achat DOUBLE PRECISION NOT NULL, CHANGE taux_vente taux_vente DOUBLE PRECISION NOT NULL, CHANGE designation designation VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE sex sex VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE taille taille VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE couleur couleur VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE qty qty INT NOT NULL, CHANGE prix_ventes prix_ventes DOUBLE PRECISION NOT NULL, CHANGE qty_vendu qty_vendu INT NOT NULL, CHANGE tva tva DOUBLE PRECISION NOT NULL, CHANGE date_ajout date_ajout DATETIME NOT NULL');
        $this->addSql('ALTER TABLE produit_membre CHANGE designation designation VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE sex sex VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE taille taille VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE couleur couleur VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE qty qty INT NOT NULL, CHANGE prix_ventes prix_ventes DOUBLE PRECISION NOT NULL, CHANGE qty_vendu qty_vendu INT NOT NULL, CHANGE tva tva DOUBLE PRECISION NOT NULL, CHANGE date_ajout date_ajout DATETIME NOT NULL');
    }
}
