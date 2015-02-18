<?php

namespace Claroline\CursusBundle\Migrations\drizzle_pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/02/18 03:49:18
 */
class Version20150218154915 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE claro_cursusbundle_course (
                id INT AUTO_INCREMENT NOT NULL, 
                workspace_model_id INT DEFAULT NULL, 
                code VARCHAR(255) NOT NULL, 
                title VARCHAR(255) NOT NULL, 
                description TEXT DEFAULT NULL, 
                public_registration BOOLEAN NOT NULL, 
                public_unregistration BOOLEAN NOT NULL, 
                registration_validation BOOLEAN NOT NULL, 
                manager_role_prefix VARCHAR(255) DEFAULT NULL, 
                user_role_prefix VARCHAR(255) DEFAULT NULL, 
                UNIQUE INDEX UNIQ_3359D34977153098 (code), 
                INDEX IDX_3359D349EE7F5384 (workspace_model_id), 
                PRIMARY KEY(id)
            ) COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_cursus (
                id INT AUTO_INCREMENT NOT NULL, 
                course_id INT DEFAULT NULL, 
                parent_id INT DEFAULT NULL, 
                code VARCHAR(255) DEFAULT NULL, 
                title VARCHAR(255) NOT NULL, 
                description TEXT DEFAULT NULL, 
                blocking BOOLEAN NOT NULL, 
                details TEXT DEFAULT NULL COMMENT '(DC2Type:json_array)', 
                cursus_order INT NOT NULL, 
                root INT DEFAULT NULL, 
                lvl INT NOT NULL, 
                lft INT NOT NULL, 
                rgt INT NOT NULL, 
                UNIQUE INDEX UNIQ_27921C3377153098 (code), 
                INDEX IDX_27921C33591CC992 (course_id), 
                INDEX IDX_27921C33727ACA70 (parent_id), 
                PRIMARY KEY(id)
            ) COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_course_group (
                id INT AUTO_INCREMENT NOT NULL, 
                group_id INT NOT NULL, 
                course_id INT NOT NULL, 
                registration_date DATETIME NOT NULL, 
                group_type INT DEFAULT NULL, 
                INDEX IDX_91D2ED95FE54D947 (group_id), 
                INDEX IDX_91D2ED95591CC992 (course_id), 
                UNIQUE INDEX cursus_group_unique_course_group (course_id, group_id), 
                PRIMARY KEY(id)
            ) COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_course_user (
                id INT AUTO_INCREMENT NOT NULL, 
                user_id INT NOT NULL, 
                course_id INT NOT NULL, 
                registration_date DATETIME NOT NULL, 
                user_type INT DEFAULT NULL, 
                INDEX IDX_26B2FA12A76ED395 (user_id), 
                INDEX IDX_26B2FA12591CC992 (course_id), 
                UNIQUE INDEX cursus_user_unique_course_user (course_id, user_id), 
                PRIMARY KEY(id)
            ) COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_cursus_displayed_word (
                id INT AUTO_INCREMENT NOT NULL, 
                word VARCHAR(255) NOT NULL, 
                displayed_name VARCHAR(255) DEFAULT NULL, 
                UNIQUE INDEX UNIQ_14E7B098C3F17511 (word), 
                PRIMARY KEY(id)
            ) COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_course_session (
                id INT AUTO_INCREMENT NOT NULL, 
                course_id INT NOT NULL, 
                workspace_id INT NOT NULL, 
                user_role_id INT DEFAULT NULL, 
                manager_role_id INT DEFAULT NULL, 
                cursus_id INT DEFAULT NULL, 
                session_status INT NOT NULL, 
                INDEX IDX_C5F56FDE591CC992 (course_id), 
                INDEX IDX_C5F56FDE82D40A1F (workspace_id), 
                UNIQUE INDEX UNIQ_C5F56FDE8E0E3CA6 (user_role_id), 
                UNIQUE INDEX UNIQ_C5F56FDE68CE17BA (manager_role_id), 
                INDEX IDX_C5F56FDE40AEF4B9 (cursus_id), 
                PRIMARY KEY(id)
            ) COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_cursus_group (
                id INT AUTO_INCREMENT NOT NULL, 
                group_id INT NOT NULL, 
                cursus_id INT NOT NULL, 
                registration_date DATETIME NOT NULL, 
                group_type INT DEFAULT NULL, 
                INDEX IDX_EA4DDE93FE54D947 (group_id), 
                INDEX IDX_EA4DDE9340AEF4B9 (cursus_id), 
                UNIQUE INDEX cursus_group_unique_cursus_group (cursus_id, group_id), 
                PRIMARY KEY(id)
            ) COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_course_session_registration_queue (
                id INT AUTO_INCREMENT NOT NULL, 
                user_id INT NOT NULL, 
                session_id INT NOT NULL, 
                application_date DATETIME NOT NULL, 
                INDEX IDX_334FC296A76ED395 (user_id), 
                INDEX IDX_334FC296613FECDF (session_id), 
                UNIQUE INDEX session_queue_unique_session_user (session_id, user_id), 
                PRIMARY KEY(id)
            ) COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_cursus_user (
                id INT AUTO_INCREMENT NOT NULL, 
                user_id INT NOT NULL, 
                cursus_id INT NOT NULL, 
                registration_date DATETIME NOT NULL, 
                user_type INT DEFAULT NULL, 
                INDEX IDX_8AA52D8A76ED395 (user_id), 
                INDEX IDX_8AA52D840AEF4B9 (cursus_id), 
                UNIQUE INDEX cursus_user_unique_cursus_user (cursus_id, user_id), 
                PRIMARY KEY(id)
            ) COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course 
            ADD CONSTRAINT FK_3359D349EE7F5384 FOREIGN KEY (workspace_model_id) 
            REFERENCES claro_workspace_model (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_cursus 
            ADD CONSTRAINT FK_27921C33591CC992 FOREIGN KEY (course_id) 
            REFERENCES claro_cursusbundle_course (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_cursus 
            ADD CONSTRAINT FK_27921C33727ACA70 FOREIGN KEY (parent_id) 
            REFERENCES claro_cursusbundle_cursus (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_group 
            ADD CONSTRAINT FK_91D2ED95FE54D947 FOREIGN KEY (group_id) 
            REFERENCES claro_group (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_group 
            ADD CONSTRAINT FK_91D2ED95591CC992 FOREIGN KEY (course_id) 
            REFERENCES claro_cursusbundle_course (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_user 
            ADD CONSTRAINT FK_26B2FA12A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_user 
            ADD CONSTRAINT FK_26B2FA12591CC992 FOREIGN KEY (course_id) 
            REFERENCES claro_cursusbundle_course (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_session 
            ADD CONSTRAINT FK_C5F56FDE591CC992 FOREIGN KEY (course_id) 
            REFERENCES claro_cursusbundle_course (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_session 
            ADD CONSTRAINT FK_C5F56FDE82D40A1F FOREIGN KEY (workspace_id) 
            REFERENCES claro_workspace (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_session 
            ADD CONSTRAINT FK_C5F56FDE8E0E3CA6 FOREIGN KEY (user_role_id) 
            REFERENCES claro_role (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_session 
            ADD CONSTRAINT FK_C5F56FDE68CE17BA FOREIGN KEY (manager_role_id) 
            REFERENCES claro_role (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_session 
            ADD CONSTRAINT FK_C5F56FDE40AEF4B9 FOREIGN KEY (cursus_id) 
            REFERENCES claro_cursusbundle_cursus (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_cursus_group 
            ADD CONSTRAINT FK_EA4DDE93FE54D947 FOREIGN KEY (group_id) 
            REFERENCES claro_group (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_cursus_group 
            ADD CONSTRAINT FK_EA4DDE9340AEF4B9 FOREIGN KEY (cursus_id) 
            REFERENCES claro_cursusbundle_cursus (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_session_registration_queue 
            ADD CONSTRAINT FK_334FC296A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_session_registration_queue 
            ADD CONSTRAINT FK_334FC296613FECDF FOREIGN KEY (session_id) 
            REFERENCES claro_cursusbundle_course_session (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_cursus_user 
            ADD CONSTRAINT FK_8AA52D8A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_cursus_user 
            ADD CONSTRAINT FK_8AA52D840AEF4B9 FOREIGN KEY (cursus_id) 
            REFERENCES claro_cursusbundle_cursus (id) 
            ON DELETE CASCADE
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_cursusbundle_cursus 
            DROP FOREIGN KEY FK_27921C33591CC992
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_group 
            DROP FOREIGN KEY FK_91D2ED95591CC992
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_user 
            DROP FOREIGN KEY FK_26B2FA12591CC992
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_session 
            DROP FOREIGN KEY FK_C5F56FDE591CC992
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_cursus 
            DROP FOREIGN KEY FK_27921C33727ACA70
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_session 
            DROP FOREIGN KEY FK_C5F56FDE40AEF4B9
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_cursus_group 
            DROP FOREIGN KEY FK_EA4DDE9340AEF4B9
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_cursus_user 
            DROP FOREIGN KEY FK_8AA52D840AEF4B9
        ");
        $this->addSql("
            ALTER TABLE claro_cursusbundle_course_session_registration_queue 
            DROP FOREIGN KEY FK_334FC296613FECDF
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_course
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_cursus
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_course_group
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_course_user
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_cursus_displayed_word
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_course_session
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_cursus_group
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_course_session_registration_queue
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_cursus_user
        ");
    }
}