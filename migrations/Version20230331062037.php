<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331062037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE actuator ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actuator ADD CONSTRAINT FK_EEB03ECEC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_EEB03ECEC3C6F69F ON actuator (car_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE actuator DROP FOREIGN KEY FK_EEB03ECEC3C6F69F');
        $this->addSql('DROP INDEX IDX_EEB03ECEC3C6F69F ON actuator');
        $this->addSql('ALTER TABLE actuator DROP car_id');
    }
}
