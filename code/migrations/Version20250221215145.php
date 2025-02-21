<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250221215145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE association (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_association (employee_id INT NOT NULL, association_id INT NOT NULL, INDEX IDX_7CA3E0B18C03F15C (employee_id), INDEX IDX_7CA3E0B1EFB9C8A5 (association_id), PRIMARY KEY(employee_id, association_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employee_association ADD CONSTRAINT FK_7CA3E0B18C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_association ADD CONSTRAINT FK_7CA3E0B1EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee_association DROP FOREIGN KEY FK_7CA3E0B18C03F15C');
        $this->addSql('ALTER TABLE employee_association DROP FOREIGN KEY FK_7CA3E0B1EFB9C8A5');
        $this->addSql('DROP TABLE association');
        $this->addSql('DROP TABLE employee_association');
    }
}
