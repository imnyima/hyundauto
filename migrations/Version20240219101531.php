<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219101531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coches (matricula VARCHAR(10) NOT NULL, id_modelo_id INT NOT NULL, precio NUMERIC(8, 2) NOT NULL, estado TINYINT(1) NOT NULL, kms INT NOT NULL, fecha DATE NOT NULL, INDEX IDX_9A1141DA439CEB49 (id_modelo_id), PRIMARY KEY(matricula)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modelos (id INT AUTO_INCREMENT NOT NULL, id_tipo_id INT NOT NULL, nombre_modelo VARCHAR(255) NOT NULL, INDEX IDX_8441FCC277BAC71C (id_tipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipos (id INT AUTO_INCREMENT NOT NULL, nombre_tipo VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coches ADD CONSTRAINT FK_9A1141DA439CEB49 FOREIGN KEY (id_modelo_id) REFERENCES modelos (id)');
        $this->addSql('ALTER TABLE modelos ADD CONSTRAINT FK_8441FCC277BAC71C FOREIGN KEY (id_tipo_id) REFERENCES tipos (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coches DROP FOREIGN KEY FK_9A1141DA439CEB49');
        $this->addSql('ALTER TABLE modelos DROP FOREIGN KEY FK_8441FCC277BAC71C');
        $this->addSql('DROP TABLE coches');
        $this->addSql('DROP TABLE modelos');
        $this->addSql('DROP TABLE tipos');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
