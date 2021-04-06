<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402115618 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, fichier_cv LONGBLOB DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, date_naiss VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_6AB5B471A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidat_offre_emploi (candidat_id INT NOT NULL, offre_emploi_id INT NOT NULL, INDEX IDX_B1E2339A8D0EB82 (candidat_id), INDEX IDX_B1E2339AB08996ED (offre_emploi_id), PRIMARY KEY(candidat_id, offre_emploi_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critere (id INT AUTO_INCREMENT NOT NULL, candidat_id INT NOT NULL, metier_id INT DEFAULT NULL, type_contrat_id INT DEFAULT NULL, renumeration INT DEFAULT NULL, disponiblilite VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_7F6A80538D0EB82 (candidat_id), INDEX IDX_7F6A8053ED16FA20 (metier_id), INDEX IDX_7F6A8053520D03A (type_contrat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critere_secteur_activite (critere_id INT NOT NULL, secteur_activite_id INT NOT NULL, INDEX IDX_29A2BFEA9E5F45AB (critere_id), INDEX IDX_29A2BFEA5233A7FC (secteur_activite_id), PRIMARY KEY(critere_id, secteur_activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critere_langue (critere_id INT NOT NULL, langue_id INT NOT NULL, INDEX IDX_8637AAD99E5F45AB (critere_id), INDEX IDX_8637AAD92AADBACD (langue_id), PRIMARY KEY(critere_id, langue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critere_region (critere_id INT NOT NULL, region_id INT NOT NULL, INDEX IDX_1A022E219E5F45AB (critere_id), INDEX IDX_1A022E2198260155 (region_id), PRIMARY KEY(critere_id, region_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cv (id INT AUTO_INCREMENT NOT NULL, candidat_id INT NOT NULL, niveau_experience_id INT DEFAULT NULL, niveau_etude_id INT DEFAULT NULL, competence LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_B66FFE928D0EB82 (candidat_id), INDEX IDX_B66FFE925649FBA6 (niveau_experience_id), INDEX IDX_B66FFE92FEAD13D1 (niveau_etude_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nom VARCHAR(255) NOT NULL, site VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, code_postal INT DEFAULT NULL, UNIQUE INDEX UNIQ_D19FA60A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_secteur_activite (entreprise_id INT NOT NULL, secteur_activite_id INT NOT NULL, INDEX IDX_743F81E1A4AEAFEA (entreprise_id), INDEX IDX_743F81E15233A7FC (secteur_activite_id), PRIMARY KEY(entreprise_id, secteur_activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, cv_id INT NOT NULL, poste VARCHAR(255) NOT NULL, entreprise VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_590C103CFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, cv_id INT NOT NULL, titre VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, nom_ecole VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_404021BFCFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue (id INT AUTO_INCREMENT NOT NULL, libele VARCHAR(255) NOT NULL, niveau INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, libele VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau_etude (id INT AUTO_INCREMENT NOT NULL, libele VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau_experience (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_emploi (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, region_id INT DEFAULT NULL, metier_id INT DEFAULT NULL, niveau_etude_id INT DEFAULT NULL, niveau_experience_id INT DEFAULT NULL, type_contrat_id INT DEFAULT NULL, poste VARCHAR(255) NOT NULL, nb_poste INT NOT NULL, description_poste LONGTEXT NOT NULL, description_profil LONGTEXT NOT NULL, slug VARCHAR(255) DEFAULT NULL, INDEX IDX_132AD0D1A4AEAFEA (entreprise_id), INDEX IDX_132AD0D198260155 (region_id), INDEX IDX_132AD0D1ED16FA20 (metier_id), INDEX IDX_132AD0D1FEAD13D1 (niveau_etude_id), INDEX IDX_132AD0D15649FBA6 (niveau_experience_id), INDEX IDX_132AD0D1520D03A (type_contrat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_emploi_langue (offre_emploi_id INT NOT NULL, langue_id INT NOT NULL, INDEX IDX_BC334907B08996ED (offre_emploi_id), INDEX IDX_BC3349072AADBACD (langue_id), PRIMARY KEY(offre_emploi_id, langue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_emploi_secteur_activite (offre_emploi_id INT NOT NULL, secteur_activite_id INT NOT NULL, INDEX IDX_E39849D8B08996ED (offre_emploi_id), INDEX IDX_E39849D85233A7FC (secteur_activite_id), PRIMARY KEY(offre_emploi_id, secteur_activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, libele VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur_activite (id INT AUTO_INCREMENT NOT NULL, libele VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_contrat (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, civilite VARCHAR(255) NOT NULL, num_tel VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, nationalite VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, hash VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_offre_emploi (user_id INT NOT NULL, offre_emploi_id INT NOT NULL, INDEX IDX_93E6ACD3A76ED395 (user_id), INDEX IDX_93E6ACD3B08996ED (offre_emploi_id), PRIMARY KEY(user_id, offre_emploi_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE candidat_offre_emploi ADD CONSTRAINT FK_B1E2339A8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidat_offre_emploi ADD CONSTRAINT FK_B1E2339AB08996ED FOREIGN KEY (offre_emploi_id) REFERENCES offre_emploi (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE critere ADD CONSTRAINT FK_7F6A80538D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE critere ADD CONSTRAINT FK_7F6A8053ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id)');
        $this->addSql('ALTER TABLE critere ADD CONSTRAINT FK_7F6A8053520D03A FOREIGN KEY (type_contrat_id) REFERENCES type_contrat (id)');
        $this->addSql('ALTER TABLE critere_secteur_activite ADD CONSTRAINT FK_29A2BFEA9E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE critere_secteur_activite ADD CONSTRAINT FK_29A2BFEA5233A7FC FOREIGN KEY (secteur_activite_id) REFERENCES secteur_activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE critere_langue ADD CONSTRAINT FK_8637AAD99E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE critere_langue ADD CONSTRAINT FK_8637AAD92AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE critere_region ADD CONSTRAINT FK_1A022E219E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE critere_region ADD CONSTRAINT FK_1A022E2198260155 FOREIGN KEY (region_id) REFERENCES region (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE928D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE925649FBA6 FOREIGN KEY (niveau_experience_id) REFERENCES niveau_experience (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92FEAD13D1 FOREIGN KEY (niveau_etude_id) REFERENCES niveau_etude (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE entreprise_secteur_activite ADD CONSTRAINT FK_743F81E1A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_secteur_activite ADD CONSTRAINT FK_743F81E15233A7FC FOREIGN KEY (secteur_activite_id) REFERENCES secteur_activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFCFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D1A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D198260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D1ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id)');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D1FEAD13D1 FOREIGN KEY (niveau_etude_id) REFERENCES niveau_etude (id)');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D15649FBA6 FOREIGN KEY (niveau_experience_id) REFERENCES niveau_experience (id)');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D1520D03A FOREIGN KEY (type_contrat_id) REFERENCES type_contrat (id)');
        $this->addSql('ALTER TABLE offre_emploi_langue ADD CONSTRAINT FK_BC334907B08996ED FOREIGN KEY (offre_emploi_id) REFERENCES offre_emploi (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_emploi_langue ADD CONSTRAINT FK_BC3349072AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_emploi_secteur_activite ADD CONSTRAINT FK_E39849D8B08996ED FOREIGN KEY (offre_emploi_id) REFERENCES offre_emploi (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_emploi_secteur_activite ADD CONSTRAINT FK_E39849D85233A7FC FOREIGN KEY (secteur_activite_id) REFERENCES secteur_activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_offre_emploi ADD CONSTRAINT FK_93E6ACD3A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_offre_emploi ADD CONSTRAINT FK_93E6ACD3B08996ED FOREIGN KEY (offre_emploi_id) REFERENCES offre_emploi (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat_offre_emploi DROP FOREIGN KEY FK_B1E2339A8D0EB82');
        $this->addSql('ALTER TABLE critere DROP FOREIGN KEY FK_7F6A80538D0EB82');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE928D0EB82');
        $this->addSql('ALTER TABLE critere_secteur_activite DROP FOREIGN KEY FK_29A2BFEA9E5F45AB');
        $this->addSql('ALTER TABLE critere_langue DROP FOREIGN KEY FK_8637AAD99E5F45AB');
        $this->addSql('ALTER TABLE critere_region DROP FOREIGN KEY FK_1A022E219E5F45AB');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103CFE419E2');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFCFE419E2');
        $this->addSql('ALTER TABLE entreprise_secteur_activite DROP FOREIGN KEY FK_743F81E1A4AEAFEA');
        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D1A4AEAFEA');
        $this->addSql('ALTER TABLE critere_langue DROP FOREIGN KEY FK_8637AAD92AADBACD');
        $this->addSql('ALTER TABLE offre_emploi_langue DROP FOREIGN KEY FK_BC3349072AADBACD');
        $this->addSql('ALTER TABLE critere DROP FOREIGN KEY FK_7F6A8053ED16FA20');
        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D1ED16FA20');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92FEAD13D1');
        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D1FEAD13D1');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE925649FBA6');
        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D15649FBA6');
        $this->addSql('ALTER TABLE candidat_offre_emploi DROP FOREIGN KEY FK_B1E2339AB08996ED');
        $this->addSql('ALTER TABLE offre_emploi_langue DROP FOREIGN KEY FK_BC334907B08996ED');
        $this->addSql('ALTER TABLE offre_emploi_secteur_activite DROP FOREIGN KEY FK_E39849D8B08996ED');
        $this->addSql('ALTER TABLE user_offre_emploi DROP FOREIGN KEY FK_93E6ACD3B08996ED');
        $this->addSql('ALTER TABLE critere_region DROP FOREIGN KEY FK_1A022E2198260155');
        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D198260155');
        $this->addSql('ALTER TABLE critere_secteur_activite DROP FOREIGN KEY FK_29A2BFEA5233A7FC');
        $this->addSql('ALTER TABLE entreprise_secteur_activite DROP FOREIGN KEY FK_743F81E15233A7FC');
        $this->addSql('ALTER TABLE offre_emploi_secteur_activite DROP FOREIGN KEY FK_E39849D85233A7FC');
        $this->addSql('ALTER TABLE critere DROP FOREIGN KEY FK_7F6A8053520D03A');
        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D1520D03A');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471A76ED395');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60A76ED395');
        $this->addSql('ALTER TABLE user_offre_emploi DROP FOREIGN KEY FK_93E6ACD3A76ED395');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE candidat_offre_emploi');
        $this->addSql('DROP TABLE critere');
        $this->addSql('DROP TABLE critere_secteur_activite');
        $this->addSql('DROP TABLE critere_langue');
        $this->addSql('DROP TABLE critere_region');
        $this->addSql('DROP TABLE cv');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE entreprise_secteur_activite');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP TABLE niveau_etude');
        $this->addSql('DROP TABLE niveau_experience');
        $this->addSql('DROP TABLE offre_emploi');
        $this->addSql('DROP TABLE offre_emploi_langue');
        $this->addSql('DROP TABLE offre_emploi_secteur_activite');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE secteur_activite');
        $this->addSql('DROP TABLE type_contrat');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_offre_emploi');
    }
}
