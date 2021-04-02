<?php
namespace WordLand\Agents\Integration\WordLand\Query;

use WordLand\Query\AgentQuery;

class ExtendAgentQuery {
    public function init() {
        add_action('wordland_query_before_agent_query', array($this, 'searchByPropertyId'), 10, 2);
    }

    public function searchByPropertyId(&$agent_query, $args)
    {
        if (empty($args['property_id'])) {
            return;
        }

        $propertyIdFilter = function ($pre, $query) {
            global $wpdb;
            $query->query_from .= " INNER JOIN {$wpdb->prefix}wordland_agent_relationships
                ON {$wpdb->prefix}wordland_agent_relationships.user_id = {$wpdb->users}.ID";

            return $pre;
        };

        $propertyId = array_get($args, 'property_id', 0);
        $propertyTableJoinFilter = function ($pre, $query) use ($propertyId) {
            global $wpdb;
            $query->query_where .= $wpdb->prepare(
                " AND {$wpdb->prefix}wordland_agent_relationships.property_id = %d",
                intval($propertyId)
            );

            return $pre;
        };

        add_filter('users_pre_query', $propertyIdFilter, 10, 2);
        add_filter('users_pre_query', $propertyTableJoinFilter, 10, 2);

        $agent_query->createCustomFilterLog($propertyIdFilter, 10);
        $agent_query->createCustomFilterLog($propertyTableJoinFilter, 10);
    }
}
