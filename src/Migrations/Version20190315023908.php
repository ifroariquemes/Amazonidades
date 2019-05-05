<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190315023908 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Cria base para clãs, membros, campanhas e suas pontuações.';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE campanha (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(100) NOT NULL, data_inicio DATE NOT NULL, data_fim DATE DEFAULT NULL, descricao LONGTEXT DEFAULT NULL, visivel TINYINT(1) NOT NULL, encerrada TINYINT(1) NOT NULL, UNIQUE INDEX campanha_nome_unique (nome), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cla (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(100) NOT NULL, logo VARCHAR(255) DEFAULT NULL, descricao LONGTEXT DEFAULT NULL, UNIQUE INDEX cla_nome_unique (nome), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membro (cpf VARCHAR(11) NOT NULL, cla_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, data_vinculo DATE DEFAULT NULL, INDEX IDX_1661123779FACA5F (cla_id), PRIMARY KEY(cpf)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pontuacao (id INT AUTO_INCREMENT NOT NULL, cla_id INT NOT NULL, campanha_id INT NOT NULL, descricao LONGTEXT NOT NULL, pontos INT NOT NULL, INDEX IDX_D89B18C79FACA5F (cla_id), INDEX IDX_D89B18C310F404B (campanha_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pontuacao_membro (pontuacao_id INT NOT NULL, membro_cpf VARCHAR(11) NOT NULL, INDEX IDX_3FEEBFDCE7D483A4 (pontuacao_id), INDEX IDX_3FEEBFDC893950BB (membro_cpf), PRIMARY KEY(pontuacao_id, membro_cpf)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE membro ADD CONSTRAINT FK_1661123779FACA5F FOREIGN KEY (cla_id) REFERENCES cla (id)');
        $this->addSql('ALTER TABLE pontuacao ADD CONSTRAINT FK_D89B18C79FACA5F FOREIGN KEY (cla_id) REFERENCES cla (id)');
        $this->addSql('ALTER TABLE pontuacao ADD CONSTRAINT FK_D89B18C310F404B FOREIGN KEY (campanha_id) REFERENCES campanha (id)');
        $this->addSql('ALTER TABLE pontuacao_membro ADD CONSTRAINT FK_3FEEBFDCE7D483A4 FOREIGN KEY (pontuacao_id) REFERENCES pontuacao (id)');
        $this->addSql('ALTER TABLE pontuacao_membro ADD CONSTRAINT FK_3FEEBFDC893950BB FOREIGN KEY (membro_cpf) REFERENCES membro (cpf)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pontuacao DROP FOREIGN KEY FK_D89B18C310F404B');
        $this->addSql('ALTER TABLE membro DROP FOREIGN KEY FK_1661123779FACA5F');
        $this->addSql('ALTER TABLE pontuacao DROP FOREIGN KEY FK_D89B18C79FACA5F');
        $this->addSql('ALTER TABLE pontuacao_membro DROP FOREIGN KEY FK_3FEEBFDC893950BB');
        $this->addSql('ALTER TABLE pontuacao_membro DROP FOREIGN KEY FK_3FEEBFDCE7D483A4');
        $this->addSql('DROP TABLE campanha');
        $this->addSql('DROP TABLE cla');
        $this->addSql('DROP TABLE membro');
        $this->addSql('DROP TABLE pontuacao');
        $this->addSql('DROP TABLE pontuacao_membro');
    }
}
