<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210403233633 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE critere_type_contrat (critere_id INT NOT NULL, type_contrat_id INT NOT NULL, INDEX IDX_73F0B0399E5F45AB (critere_id), INDEX IDX_73F0B039520D03A (type_contrat_id), PRIMARY KEY(critere_id, type_contrat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE critere_type_contrat ADD CONSTRAINT FK_73F0B0399E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE critere_type_contrat ADD CONSTRAINT FK_73F0B039520D03A FOREIGN KEY (type_contrat_id) REFERENCES type_contrat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE critere DROP FOREIGN KEY FK_7F6A8053520D03A');
        $this->addSql('DROP INDEX IDX_7F6A8053520D03A ON critere');
        $this->addSql('ALTER TABLE critere DROP type_contrat_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE critere_type_contrat');
        $this->addSql('ALTER TABLE critere ADD type_contrat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE critere ADD CONSTRAINT FK_7F6A8053520D03A FOREIGN KEY (type_contrat_id) REFERENCES type_contrat (id)');
        $this->addSql('CREATE INDEX IDX_7F6A8053520D03A ON critere (type_contrat_id)');
    }
}
