<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191216150618 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event_ope ADD galerie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event_ope ADD CONSTRAINT FK_BFE27CFD825396CB FOREIGN KEY (galerie_id) REFERENCES galerie (id)');
        $this->addSql('CREATE INDEX IDX_BFE27CFD825396CB ON event_ope (galerie_id)');
        $this->addSql('ALTER TABLE categorie ADD galerie_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634825396CB FOREIGN KEY (galerie_id) REFERENCES galerie (id)');
        $this->addSql('CREATE INDEX IDX_497DD634825396CB ON categorie (galerie_id)');
        $this->addSql('ALTER TABLE galerie ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE galerie ADD CONSTRAINT FK_9E7D1590F675F31B FOREIGN KEY (author_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_9E7D1590F675F31B ON galerie (author_id)');
        $this->addSql('ALTER TABLE product ADD galerie_id INT DEFAULT NULL, ADD commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD825396CB FOREIGN KEY (galerie_id) REFERENCES galerie (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD825396CB ON product (galerie_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD82EA2E54 ON product (commande_id)');
        $this->addSql('ALTER TABLE protocole ADD galerie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE protocole ADD CONSTRAINT FK_9078B75D825396CB FOREIGN KEY (galerie_id) REFERENCES galerie (id)');
        $this->addSql('CREATE INDEX IDX_9078B75D825396CB ON protocole (galerie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634825396CB');
        $this->addSql('DROP INDEX IDX_497DD634825396CB ON categorie');
        $this->addSql('ALTER TABLE categorie DROP galerie_id');
        $this->addSql('ALTER TABLE event_ope DROP FOREIGN KEY FK_BFE27CFD825396CB');
        $this->addSql('DROP INDEX IDX_BFE27CFD825396CB ON event_ope');
        $this->addSql('ALTER TABLE event_ope DROP galerie_id');
        $this->addSql('ALTER TABLE galerie DROP FOREIGN KEY FK_9E7D1590F675F31B');
        $this->addSql('DROP INDEX IDX_9E7D1590F675F31B ON galerie');
        $this->addSql('ALTER TABLE galerie DROP author_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD825396CB');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD82EA2E54');
        $this->addSql('DROP INDEX IDX_D34A04AD825396CB ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD82EA2E54 ON product');
        $this->addSql('ALTER TABLE product DROP galerie_id, DROP commande_id');
        $this->addSql('ALTER TABLE protocole DROP FOREIGN KEY FK_9078B75D825396CB');
        $this->addSql('DROP INDEX IDX_9078B75D825396CB ON protocole');
        $this->addSql('ALTER TABLE protocole DROP galerie_id');
    }
}
