<?php

namespace Claroline\CursusBundle\Migrations\pdo_pgsql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/01/30 02:01:49
 */
class Version20150130140147 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE claro_cursusbundle_course (
                id SERIAL NOT NULL, 
                code VARCHAR(255) NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description TEXT DEFAULT NULL, 
                public_registration BOOLEAN NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_3359D34977153098 ON claro_cursusbundle_course (code)
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_cursus (
                id SERIAL NOT NULL, 
                parent_id INT DEFAULT NULL, 
                code VARCHAR(255) DEFAULT NULL, 
                title VARCHAR(255) NOT NULL, 
                description TEXT DEFAULT NULL, 
                cursus_order INT NOT NULL, 
                root INT DEFAULT NULL, 
                lvl INT NOT NULL, 
                lft INT NOT NULL, 
                rgt INT NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_27921C3377153098 ON claro_cursusbundle_cursus (code)
        ");
        $this->addSql("
            CREATE INDEX IDX_27921C33727ACA70 ON claro_cursusbundle_cursus (parent_id)
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_cursus_displayed_word (
                id SERIAL NOT NULL, 
                word VARCHAR(255) NOT NULL, 
                displayed_name VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_14E7B098C3F17511 ON claro_cursusbundle_cursus_displayed_word (word)
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_cursus 
            ADD CONSTRAINT FK_27921C33727ACA70 FOREIGN KEY (parent_id) 
            REFERENCES claro_cursusbundle_cursus (id) 
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_cursusbundle_cursus 
            DROP CONSTRAINT FK_27921C33727ACA70
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_course
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_cursus
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_cursus_displayed_word
        ");
    }
}