<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180314162318 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit_intern ADD image_homme_id INT DEFAULT NULL, ADD image_femme_id INT DEFAULT NULL, ADD image_zoom_liste_id INT DEFAULT NULL, ADD image_zoom_item_id INT DEFAULT NULL, DROP image_homme, DROP image_femme, DROP image_zoom_liste, DROP image_zoom_item');
        $this->addSql('ALTER TABLE produit_intern ADD CONSTRAINT FK_522B940CD41262A8 FOREIGN KEY (image_homme_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE produit_intern ADD CONSTRAINT FK_522B940C65E82FD4 FOREIGN KEY (image_femme_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE produit_intern ADD CONSTRAINT FK_522B940C56BFB07A FOREIGN KEY (image_zoom_liste_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE produit_intern ADD CONSTRAINT FK_522B940CF28EE02C FOREIGN KEY (image_zoom_item_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_522B940CD41262A8 ON produit_intern (image_homme_id)');
        $this->addSql('CREATE INDEX IDX_522B940C65E82FD4 ON produit_intern (image_femme_id)');
        $this->addSql('CREATE INDEX IDX_522B940C56BFB07A ON produit_intern (image_zoom_liste_id)');
        $this->addSql('CREATE INDEX IDX_522B940CF28EE02C ON produit_intern (image_zoom_item_id)');
        $this->addSql('ALTER TABLE produit_membre ADD image_homme_id INT DEFAULT NULL, ADD image_femme_id INT DEFAULT NULL, ADD image_zoom_liste_id INT DEFAULT NULL, ADD image_zoom_item_id INT DEFAULT NULL, DROP image_homme, DROP image_femme, DROP image_zoom_liste, DROP image_zoom_item');
        $this->addSql('ALTER TABLE produit_membre ADD CONSTRAINT FK_1E63013D41262A8 FOREIGN KEY (image_homme_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE produit_membre ADD CONSTRAINT FK_1E6301365E82FD4 FOREIGN KEY (image_femme_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE produit_membre ADD CONSTRAINT FK_1E6301356BFB07A FOREIGN KEY (image_zoom_liste_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE produit_membre ADD CONSTRAINT FK_1E63013F28EE02C FOREIGN KEY (image_zoom_item_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_1E63013D41262A8 ON produit_membre (image_homme_id)');
        $this->addSql('CREATE INDEX IDX_1E6301365E82FD4 ON produit_membre (image_femme_id)');
        $this->addSql('CREATE INDEX IDX_1E6301356BFB07A ON produit_membre (image_zoom_liste_id)');
        $this->addSql('CREATE INDEX IDX_1E63013F28EE02C ON produit_membre (image_zoom_item_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit_intern DROP FOREIGN KEY FK_522B940CD41262A8');
        $this->addSql('ALTER TABLE produit_intern DROP FOREIGN KEY FK_522B940C65E82FD4');
        $this->addSql('ALTER TABLE produit_intern DROP FOREIGN KEY FK_522B940C56BFB07A');
        $this->addSql('ALTER TABLE produit_intern DROP FOREIGN KEY FK_522B940CF28EE02C');
        $this->addSql('DROP INDEX IDX_522B940CD41262A8 ON produit_intern');
        $this->addSql('DROP INDEX IDX_522B940C65E82FD4 ON produit_intern');
        $this->addSql('DROP INDEX IDX_522B940C56BFB07A ON produit_intern');
        $this->addSql('DROP INDEX IDX_522B940CF28EE02C ON produit_intern');
        $this->addSql('ALTER TABLE produit_intern ADD image_homme VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD image_femme VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD image_zoom_liste VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD image_zoom_item VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, DROP image_homme_id, DROP image_femme_id, DROP image_zoom_liste_id, DROP image_zoom_item_id');
        $this->addSql('ALTER TABLE produit_membre DROP FOREIGN KEY FK_1E63013D41262A8');
        $this->addSql('ALTER TABLE produit_membre DROP FOREIGN KEY FK_1E6301365E82FD4');
        $this->addSql('ALTER TABLE produit_membre DROP FOREIGN KEY FK_1E6301356BFB07A');
        $this->addSql('ALTER TABLE produit_membre DROP FOREIGN KEY FK_1E63013F28EE02C');
        $this->addSql('DROP INDEX IDX_1E63013D41262A8 ON produit_membre');
        $this->addSql('DROP INDEX IDX_1E6301365E82FD4 ON produit_membre');
        $this->addSql('DROP INDEX IDX_1E6301356BFB07A ON produit_membre');
        $this->addSql('DROP INDEX IDX_1E63013F28EE02C ON produit_membre');
        $this->addSql('ALTER TABLE produit_membre ADD image_homme VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD image_femme VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD image_zoom_liste VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD image_zoom_item VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, DROP image_homme_id, DROP image_femme_id, DROP image_zoom_liste_id, DROP image_zoom_item_id');
    }
}
