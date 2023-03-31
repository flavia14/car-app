<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331061220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE back_sensor ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE back_sensor ADD CONSTRAINT FK_6DACDF9AC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_6DACDF9AC3C6F69F ON back_sensor (car_id)');
        $this->addSql('ALTER TABLE front_sensor ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE front_sensor ADD CONSTRAINT FK_5E7A5159C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_5E7A5159C3C6F69F ON front_sensor (car_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE back_sensor DROP FOREIGN KEY FK_6DACDF9AC3C6F69F');
        $this->addSql('DROP INDEX IDX_6DACDF9AC3C6F69F ON back_sensor');
        $this->addSql('ALTER TABLE back_sensor DROP car_id');
        $this->addSql('ALTER TABLE front_sensor DROP FOREIGN KEY FK_5E7A5159C3C6F69F');
        $this->addSql('DROP INDEX IDX_5E7A5159C3C6F69F ON front_sensor');
        $this->addSql('ALTER TABLE front_sensor DROP car_id');
    }
}
