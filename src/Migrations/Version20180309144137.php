<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180309144137 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_commande CHANGE prix prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE operation CHANGE montant montant DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE portefeuille CHANGE solde solde DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE produit_intern CHANGE prix_achat prix_achat DOUBLE PRECISION NOT NULL, CHANGE taux_vente taux_vente DOUBLE PRECISION NOT NULL, CHANGE prix_ventes prix_ventes DOUBLE PRECISION NOT NULL, CHANGE tva tva DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE produit_membre CHANGE prix_vente_membre prix_vente_membre DOUBLE PRECISION NOT NULL, CHANGE prix_ventes prix_ventes DOUBLE PRECISION NOT NULL, CHANGE tva tva DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_commande CHANGE prix prix INT NOT NULL');
        $this->addSql('ALTER TABLE operation CHANGE montant montant INT NOT NULL');
        $this->addSql('ALTER TABLE portefeuille CHANGE solde solde INT NOT NULL');
        $this->addSql('ALTER TABLE produit_intern CHANGE prix_achat prix_achat INT NOT NULL, CHANGE taux_vente taux_vente INT NOT NULL, CHANGE prix_ventes prix_ventes INT NOT NULL, CHANGE tva tva INT NOT NULL');
        $this->addSql('ALTER TABLE produit_membre CHANGE prix_vente_membre prix_vente_membre INT NOT NULL, CHANGE prix_ventes prix_ventes INT NOT NULL, CHANGE tva tva INT NOT NULL');
    }
}
