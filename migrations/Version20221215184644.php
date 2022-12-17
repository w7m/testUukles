<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221215184644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_material (client_id INT NOT NULL, material_id INT NOT NULL, INDEX IDX_5258455019EB6921 (client_id), INDEX IDX_52584550E308AC6F (material_id), PRIMARY KEY(client_id, material_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_material ADD CONSTRAINT FK_5258455019EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_material ADD CONSTRAINT FK_52584550E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE759519EB6921');
        $this->addSql('DROP INDEX IDX_7CBE759519EB6921 ON material');
        $this->addSql('ALTER TABLE material DROP client_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_material DROP FOREIGN KEY FK_5258455019EB6921');
        $this->addSql('ALTER TABLE client_material DROP FOREIGN KEY FK_52584550E308AC6F');
        $this->addSql('DROP TABLE client_material');
        $this->addSql('ALTER TABLE material ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE759519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_7CBE759519EB6921 ON material (client_id)');
    }
}
