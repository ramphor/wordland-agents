<?php

class Installer
{
    public function create_new_tables()
    {
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
                $engine,
                $wpdb->charset,
                $wpdb->collate
            );
            $wpdb->query($sql);
        }
    }
}
