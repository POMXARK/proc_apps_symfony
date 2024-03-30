<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Заявка.
 *
 * @see Stmt
 */
final class Version20240330084014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE stmt_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE stmt (id INT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, message TEXT NOT NULL, comment TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN stmt.name IS \'Имя пользователя.\'');
        $this->addSql('COMMENT ON COLUMN stmt.email IS \'Email пользователя.\'');
        $this->addSql('COMMENT ON COLUMN stmt.status IS \'Статус.\'');
        $this->addSql('COMMENT ON COLUMN stmt.message IS \'Сообщение пользователя.\'');
        $this->addSql('COMMENT ON COLUMN stmt.comment IS \'Ответ ответственного лица.\'');
        $this->addSql('COMMENT ON COLUMN stmt.created_at IS \'Время создания заявки.(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN stmt.updated_at IS \'Время ответа на заявку.(DC2Type:datetime_immutable)\'');

        // Добавлено вручную postgres
        $this->addSql("CREATE TYPE status AS ENUM ('Active', 'Resolved')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE stmt_id_seq CASCADE');
        $this->addSql('DROP TABLE stmt');
    }
}
