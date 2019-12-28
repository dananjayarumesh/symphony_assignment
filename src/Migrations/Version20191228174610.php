<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191228174610 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book CHANGE price price DOUBLE PRECISION DEFAULT \'0\' NOT NULL, CHANGE qty qty INT DEFAULT 0 NOT NULL, CHANGE active active INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD email TINYTEXT DEFAULT NULL, CHANGE first_name first_name TINYTEXT DEFAULT NULL, CHANGE last_name last_name TINYTEXT DEFAULT NULL, CHANGE phone phone TINYTEXT DEFAULT NULL, CHANGE address_line_1 address_line_1 TINYTEXT DEFAULT NULL, CHANGE address_line_2 address_line_2 TINYTEXT DEFAULT NULL, CHANGE city city TINYTEXT DEFAULT NULL, CHANGE note note TINYTEXT DEFAULT NULL, CHANGE gross_total gross_total DOUBLE PRECISION DEFAULT NULL, CHANGE discount discount DOUBLE PRECISION DEFAULT \'0\' NOT NULL, CHANGE coupon_discount coupon_discount DOUBLE PRECISION DEFAULT \'0\' NOT NULL, CHANGE net_total net_total DOUBLE PRECISION DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book CHANGE price price DOUBLE PRECISION NOT NULL, CHANGE qty qty INT NOT NULL, CHANGE active active INT NOT NULL');
        $this->addSql('ALTER TABLE `order` DROP email, CHANGE first_name first_name TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone phone TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE address_line_1 address_line_1 TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE address_line_2 address_line_2 TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city city TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE note note TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE gross_total gross_total DOUBLE PRECISION NOT NULL, CHANGE discount discount DOUBLE PRECISION NOT NULL, CHANGE coupon_discount coupon_discount DOUBLE PRECISION NOT NULL, CHANGE net_total net_total DOUBLE PRECISION NOT NULL');
    }
}
