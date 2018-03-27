<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180321112728 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dessin ADD image_dessin_id INT DEFAULT NULL, ADD image_dessin_miniature_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dessin ADD CONSTRAINT FK_427D511821E28D7A FOREIGN KEY (image_dessin_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE dessin ADD CONSTRAINT FK_427D511883DB9F9C FOREIGN KEY (image_dessin_miniature_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_427D511821E28D7A ON dessin (image_dessin_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_427D511883DB9F9C ON dessin (image_dessin_miniature_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dessin DROP FOREIGN KEY FK_427D511821E28D7A');
        $this->addSql('ALTER TABLE dessin DROP FOREIGN KEY FK_427D511883DB9F9C');
        $this->addSql('DROP INDEX UNIQ_427D511821E28D7A ON dessin');
        $this->addSql('DROP INDEX UNIQ_427D511883DB9F9C ON dessin');
        $this->addSql('ALTER TABLE dessin DROP image_dessin_id, DROP image_dessin_miniature_id');
    }
}
