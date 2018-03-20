<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180319084430 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD roles JSON NOT NULL, DROP full_name, CHANGE username username VARCHAR(255) NOT NULL, CHANGE pseudo pseudo VARCHAR(255) NOT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE code_postal code_postal INT NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE pays pays VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64986CC499D ON user (pseudo)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D64986CC499D ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD full_name VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, DROP nom, DROP prenom, DROP roles, CHANGE username username VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE pseudo pseudo VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE code_postal code_postal INT DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE pays pays VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE email email VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE password password VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
