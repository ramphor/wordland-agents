<?php
namespace WordLand\Agents;

class Query {
    public static function check_relationship_is_exists($property_id, $agent_id) {
        global $wpdb;

        $sql = $wpdb->prepare(
            "SELECT ID FROM {$wpdb->prefix}wordland_agent_relationships WHERE property_id=%d AND user_id=%d LIMIT 1",
            $property_id,
            $agent_id
        );
        return intval($wpdb->get_var($sql)) > 0;
    }

    public static function create_property_agent_relationship($property_id, $agent_id) {
        global $wpdb;

        $data = array(
            'user_id' => $agent_id,
            'property_id' => $property_id,
            'created_at' => current_time('mysql'),
        );
        if (!static::check_relationship_is_exists($property_id, $agent_id)) {
            $wpdb->insert(
                sprintf('%swordland_agent_relationships', $wpdb->prefix),
                $data
            );
        }
    }
}
