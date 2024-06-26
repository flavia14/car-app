<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230405084331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE followers (user_source INT NOT NULL, user_target INT NOT NULL, INDEX IDX_8408FDA73AD8644E (user_source), INDEX IDX_8408FDA7233D34C1 (user_target), PRIMARY KEY(user_source, user_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE followers ADD CONSTRAINT FK_8408FDA73AD8644E FOREIGN KEY (user_source) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE followers ADD CONSTRAINT FK_8408FDA7233D34C1 FOREIGN KEY (user_target) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE followers DROP FOREIGN KEY FK_8408FDA73AD8644E');
        $this->addSql('ALTER TABLE followers DROP FOREIGN KEY FK_8408FDA7233D34C1');
        $this->addSql('DROP TABLE followers');
    }
}
