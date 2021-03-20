<?php
namespace WordLand\Agents\Integration;

use WordLand\Query\AgentQuery;
use WordLand\Agent;

class PropertyBuilder
{
    public function init()
    {
        add_filter('wordland_builder_get_property', array($this, 'loadAgents'), 10, 3);
    }

    public function loadAgents($property, $builder, $scope)
    {
        if ($scope !== 'single') {
            return $property;
        }
        global $wpdb;

        $queryArgs = array();
        if ($property->primaryAgent > 0) {
            $queryArgs['exclude'] = array($property->primaryAgent);
        }

        $propertyId = $property->ID;
        $agentQuery = new AgentQuery($queryArgs);
        $agentQuery->select(sprintf('%s.*, %s.*', $wpdb->users, $wpdb->prefix . 'wordland_agents'));

        $filterByProperty = function ($pre, $query) use ($propertyId) {
            global $wpdb;

            $query->query_from .= " INNER JOIN {$wpdb->prefix}wordland_agent_relationships ON {$wpdb->prefix}wordland_agent_relationships.user_id = {$wpdb->users}.ID";

            $query->query_where .= $wpdb->prepare(
                " AND {$wpdb->prefix}wordland_agent_relationships.property_id=%d",
                $propertyId
            );

            return $pre;
        };

        add_filter('users_pre_query', $filterByProperty, 30, 2);

        $agentQuery->createCustomFilterLog($filterByProperty, 30);

        $user_query = $agentQuery->getWordPressQuery();

        $users = $user_query->get_results();

        foreach ($users as $user) {
            $agent = new Agent(
                $user->display_name,
                $user->phone_number,
                $user->user_email
            );
            $agent->setUserID($user->ID);
            $agent->getAvatarUrlFromUser();

            do_action_ref_array('wordland_agents_load_agent', array(
                &$agent,
                $user
            ));

            $property->agents[$user->ID] = $agent;
        }

        return $property;
    }
}
