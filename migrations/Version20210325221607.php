<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325221607 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, fichier_cv LONGBLOB DEFAULT NULL, picture LONGBLOB DEFAULT NULL, date_naiss DATE DEFAULT NULL, UNIQUE INDEX UNIQ_6AB5B471A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critere (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, metier LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', mobilite LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', secteur_activite LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', type_contrat VARCHAR(255) DEFAULT NULL, renumeration INT DEFAULT NULL, langues LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', disponibilite INT NOT NULL, UNIQUE INDEX UNIQ_7F6A8053A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cv (id INT AUTO_INCREMENT NOT NULL, candidat_id INT NOT NULL, niveau_etude INT NOT NULL, niveau_experience INT NOT NULL, UNIQUE INDEX UNIQ_B66FFE928D0EB82 (candidat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, site VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, cv_id INT NOT NULL, poste VARCHAR(255) NOT NULL, entreprise VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_590C103CFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, cv_id INT NOT NULL, titre VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, nom_ecole VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_404021BFCFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_emploi (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, poste VARCHAR(255) NOT NULL, nb_poste INT NOT NULL, description_poste LONGTEXT NOT NULL, description_profil LONGTEXT NOT NULL, secteur_activite LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', metier LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', langue LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', type_contrat VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, niveau_etude INT NOT NULL, niveau_experience INT NOT NULL, langues LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_132AD0D1A4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, civilite VARCHAR(255) NOT NULL, num_tel VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, nationalite VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_offre_emploi (user_id INT NOT NULL, offre_emploi_id INT NOT NULL, INDEX IDX_93E6ACD3A76ED395 (user_id), INDEX IDX_93E6ACD3B08996ED (offre_emploi_id), PRIMARY KEY(user_id, offre_emploi_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE critere ADD CONSTRAINT FK_7F6A8053A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE928D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFCFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D1A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE user_offre_emploi ADD CONSTRAINT FK_93E6ACD3A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_offre_emploi ADD CONSTRAINT FK_93E6ACD3B08996ED FOREIGN KEY (offre_emploi_id) REFERENCES offre_emploi (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE928D0EB82');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103CFE419E2');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFCFE419E2');
        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D1A4AEAFEA');
        $this->addSql('ALTER TABLE user_offre_emploi DROP FOREIGN KEY FK_93E6ACD3B08996ED');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471A76ED395');
        $this->addSql('ALTER TABLE critere DROP FOREIGN KEY FK_7F6A8053A76ED395');
        $this->addSql('ALTER TABLE user_offre_emploi DROP FOREIGN KEY FK_93E6ACD3A76ED395');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE critere');
        $this->addSql('DROP TABLE cv');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE offre_emploi');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_offre_emploi');
    }
}
