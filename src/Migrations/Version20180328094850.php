<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180328094850 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_commande ADD produit_interne_id INT DEFAULT NULL, ADD produit_membre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BF765A62A FOREIGN KEY (produit_interne_id) REFERENCES produit_intern (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BEE0EA9A6 FOREIGN KEY (produit_membre_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_3170B74BF765A62A ON ligne_commande (produit_interne_id)');
        $this->addSql('CREATE INDEX IDX_3170B74BEE0EA9A6 ON ligne_commande (produit_membre_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BF765A62A');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BEE0EA9A6');
        $this->addSql('DROP INDEX IDX_3170B74BF765A62A ON ligne_commande');
        $this->addSql('DROP INDEX IDX_3170B74BEE0EA9A6 ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande DROP produit_interne_id, DROP produit_membre_id');
    }
}
