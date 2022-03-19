<?php
namespace WordLand\Agents;

class Installer
{
    public static function install()
    {
        static::create_new_tables();
        add_action('init', [__CLASS__, 'flush_rewrite_rules'], 99);
    }

    public static function create_new_tables()
    {
        global $wpdb;

        $tables = array(
            'wordland_agent_relationships' => '
                `ID` BIGINT NOT NULL AUTO_INCREMENT,
                `user_id` BIGINT NOT NULL,
                `property_id` BIGINT NULL,
                `is_primary` BOOLEAN DEFAULT FALSE,
                `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`ID`)
            ',
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

    public static function flush_rewrite_rules() {
        flush_rewrite_rules(false);
    }
}
