<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210702184225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chapters (id INT AUTO_INCREMENT NOT NULL, fanfic_id INT NOT NULL, name VARCHAR(255) NOT NULL, number INT NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_C7214371F4A4C6A9 (fanfic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, fanfic_id INT NOT NULL, user_id INT NOT NULL, content LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_5F9E962AF4A4C6A9 (fanfic_id), INDEX IDX_5F9E962AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fandoms (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fanfics (id INT AUTO_INCREMENT NOT NULL, fandom_id INT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, last_date_update DATETIME NOT NULL, INDEX IDX_4E37F3E0D6F3E531 (fandom_id), INDEX IDX_4E37F3E0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preferences (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, fandom_id INT NOT NULL, INDEX IDX_E931A6F5A76ED395 (user_id), INDEX IDX_E931A6F5D6F3E531 (fandom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chapters ADD CONSTRAINT FK_C7214371F4A4C6A9 FOREIGN KEY (fanfic_id) REFERENCES fanfics (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AF4A4C6A9 FOREIGN KEY (fanfic_id) REFERENCES fanfics (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE fanfics ADD CONSTRAINT FK_4E37F3E0D6F3E531 FOREIGN KEY (fandom_id) REFERENCES fandoms (id)');
        $this->addSql('ALTER TABLE fanfics ADD CONSTRAINT FK_4E37F3E0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE preferences ADD CONSTRAINT FK_E931A6F5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE preferences ADD CONSTRAINT FK_E931A6F5D6F3E531 FOREIGN KEY (fandom_id) REFERENCES fandoms (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fanfics DROP FOREIGN KEY FK_4E37F3E0D6F3E531');
        $this->addSql('ALTER TABLE preferences DROP FOREIGN KEY FK_E931A6F5D6F3E531');
        $this->addSql('ALTER TABLE chapters DROP FOREIGN KEY FK_C7214371F4A4C6A9');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AF4A4C6A9');
        $this->addSql('DROP TABLE chapters');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE fandoms');
        $this->addSql('DROP TABLE fanfics');
        $this->addSql('DROP TABLE preferences');
    }
}
