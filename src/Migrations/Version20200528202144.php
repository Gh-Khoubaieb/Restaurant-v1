<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200528202144 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orderline DROP FOREIGN KEY OrderLine_ibfk_2');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE orderline');
        $this->addSql('ALTER TABLE meal CHANGE Name name VARCHAR(255) NOT NULL, CHANGE Photo photo VARCHAR(255) NOT NULL, CHANGE Description description LONGTEXT NOT NULL, CHANGE QuantityInStock quantityinstock INT NOT NULL');
        $this->addSql('DROP INDEX Email ON user');
        $this->addSql('ALTER TABLE user CHANGE FirstName firstname VARCHAR(255) NOT NULL, CHANGE LastName lastname VARCHAR(255) NOT NULL, CHANGE Email email VARCHAR(255) NOT NULL, CHANGE Password password VARCHAR(255) NOT NULL, CHANGE Address address VARCHAR(255) NOT NULL, CHANGE City city VARCHAR(255) NOT NULL, CHANGE ZipCode zipcode VARCHAR(255) NOT NULL, CHANGE Country country VARCHAR(255) NOT NULL, CHANGE Phone phone VARCHAR(255) NOT NULL, CHANGE LastLoginTimestamp lastlogintimestamp DATETIME NOT NULL, CHANGE Admin admin INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE booking (Id INT AUTO_INCREMENT NOT NULL, BookingDate DATE NOT NULL, BookingTime TIME NOT NULL, NumberOfSeats TINYINT(1) NOT NULL, User_Id INT NOT NULL, CreationTimestamp DATETIME NOT NULL, INDEX User_Id (User_Id), PRIMARY KEY(Id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE `order` (Id INT AUTO_INCREMENT NOT NULL, User_Id INT NOT NULL, TotalAmount DOUBLE PRECISION DEFAULT \'NULL\', TaxRate DOUBLE PRECISION DEFAULT \'NULL\', TaxAmount DOUBLE PRECISION DEFAULT \'NULL\', CreationTimestamp DATETIME DEFAULT \'NULL\', CompleteTimestamp DATETIME DEFAULT \'NULL\', INDEX User_Id (User_Id), PRIMARY KEY(Id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE orderline (Id INT AUTO_INCREMENT NOT NULL, QuantityOrdered INT NOT NULL, Meal_Id INT NOT NULL, Order_Id INT NOT NULL, PriceEach DOUBLE PRECISION NOT NULL, INDEX Meal_Id (Meal_Id), UNIQUE INDEX UniciteMealOrder (Meal_Id, Order_Id), INDEX Order_Id (Order_Id), PRIMARY KEY(Id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT Booking_ibfk_1 FOREIGN KEY (User_Id) REFERENCES user (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT Order_ibfk_1 FOREIGN KEY (User_Id) REFERENCES user (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orderline ADD CONSTRAINT OrderLine_ibfk_1 FOREIGN KEY (Meal_Id) REFERENCES meal (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orderline ADD CONSTRAINT OrderLine_ibfk_2 FOREIGN KEY (Order_Id) REFERENCES `order` (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal CHANGE name Name VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE photo Photo VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE description Description VARCHAR(250) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE quantityinstock QuantityInStock TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE firstname FirstName VARCHAR(40) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE lastname LastName VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE email Email VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE password Password VARCHAR(64) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE address Address VARCHAR(250) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE city City VARCHAR(40) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE zipcode ZipCode CHAR(5) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE country Country VARCHAR(20) CHARACTER SET utf8 DEFAULT \'NULL\' COLLATE `utf8_general_ci`, CHANGE phone Phone CHAR(10) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE lastlogintimestamp LastLoginTimestamp DATETIME DEFAULT \'NULL\', CHANGE admin Admin TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('CREATE UNIQUE INDEX Email ON user (Email)');
    }
}
