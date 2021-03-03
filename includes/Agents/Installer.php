<?php
namespace WordLand\Agents;

class Installer
{
    public static function install() {
        static::create_new_tables();
    }

    public static function create_new_tables()
    {
        global $wpdb;

        $tables = array(
            'wordland_agent_relationships' => '`ID` BIGINT NOT NULL AUTO_INCREMENT,
                `user_id` BIGINT NOT NULL,
                `property_id` BIGINT NULL,
                `created_at` TIMESTAMP NOT NULL,
                PRIMARY KEY (`ID`)',
        );

        foreach ($tables as $table_name => $sql_syntax) {
            $sql = sprintf(
                'CREATE TABLE IF NOT EXISTS %s%s (%s) ENGINE = %s CHARSET=%s COLLATE=%s',
                $wpdb->prefix,
                $table_name,
                $sql_syntax,
                'InnoDB',
                $wpdb->charset,
                $wpdb->collate
            );
            $wpdb->query($sql);
        }
    }
}
