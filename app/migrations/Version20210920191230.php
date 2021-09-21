<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210920191230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campervans (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipments (id INT AUTO_INCREMENT NOT NULL, station_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_6F6C254427C2E161 (station_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental_order_equipments (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, equipment_id_id INT NOT NULL, equipment_pickup_date DATE NOT NULL, equipment_drop_date DATE NOT NULL, INDEX IDX_5A3E0153FCDAEAAA (order_id_id), INDEX IDX_5A3E0153961DBFB3 (equipment_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental_orders (id INT AUTO_INCREMENT NOT NULL, campervan_id_id INT NOT NULL, start_station_id INT NOT NULL, end_station_id INT DEFAULT NULL, rental_start_date DATE NOT NULL, rental_end_date DATE NOT NULL, INDEX IDX_D501E9892B27E883 (campervan_id_id), INDEX IDX_D501E98953721DCB (start_station_id), INDEX IDX_D501E9892FF5EABB (end_station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stations (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipments ADD CONSTRAINT FK_6F6C254427C2E161 FOREIGN KEY (station_id_id) REFERENCES stations (id)');
        $this->addSql('ALTER TABLE rental_order_equipments ADD CONSTRAINT FK_5A3E0153FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES rental_orders (id)');
        $this->addSql('ALTER TABLE rental_order_equipments ADD CONSTRAINT FK_5A3E0153961DBFB3 FOREIGN KEY (equipment_id_id) REFERENCES equipments (id)');
        $this->addSql('ALTER TABLE rental_orders ADD CONSTRAINT FK_D501E9892B27E883 FOREIGN KEY (campervan_id_id) REFERENCES campervans (id)');
        $this->addSql('ALTER TABLE rental_orders ADD CONSTRAINT FK_D501E98953721DCB FOREIGN KEY (start_station_id) REFERENCES stations (id)');
        $this->addSql('ALTER TABLE rental_orders ADD CONSTRAINT FK_D501E9892FF5EABB FOREIGN KEY (end_station_id) REFERENCES stations (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rental_orders DROP FOREIGN KEY FK_D501E9892B27E883');
        $this->addSql('ALTER TABLE rental_order_equipments DROP FOREIGN KEY FK_5A3E0153961DBFB3');
        $this->addSql('ALTER TABLE rental_order_equipments DROP FOREIGN KEY FK_5A3E0153FCDAEAAA');
        $this->addSql('ALTER TABLE equipments DROP FOREIGN KEY FK_6F6C254427C2E161');
        $this->addSql('ALTER TABLE rental_orders DROP FOREIGN KEY FK_D501E98953721DCB');
        $this->addSql('ALTER TABLE rental_orders DROP FOREIGN KEY FK_D501E9892FF5EABB');
        $this->addSql('DROP TABLE campervans');
        $this->addSql('DROP TABLE equipments');
        $this->addSql('DROP TABLE rental_order_equipments');
        $this->addSql('DROP TABLE rental_orders');
        $this->addSql('DROP TABLE stations');
    }
}
