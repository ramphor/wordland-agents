<?php
namespace WordLand\Agents\Integration\SpreadsheetImporter;

use WordLand\Agents\Query;

class MultiAgents {
    public function init() {
        add_action('imported_property', array($this, 'createPropertyAndMainAgentRelationship'), 10, 3);

        add_filter('wordland_spreadsheet_importer_create_property', array($this, 'detectOtherAgents'), 15, 2);
        add_action('wordland_spreadsheet_import_property', array($this, 'saveOtherAgents'), 15, 2);
    }

    public function createPropertyAndMainAgentRelationship($property_id, $post_data, $agent_id) {
        if ($agent_id > 0) {
            Query::create_property_agent_relationship($property_id, $agent_id);
        }
    }

    public function detectOtherAgents($property, $current_data_row) {
        $agents = array();
        foreach($current_data_row as $key => $value) {
            if (!is_null($value) && preg_match('/agent\_([^\_]{1,})\_(\d{1,})/', $key, $matches)) {
                $agents[$matches[2]][$matches[1]] = $value;
            }
        }
        $property->otherAgents = $agents;
        return $property;
    }

    public function saveOtherAgents($property_id, $propertyData) {
        if (isset($propertyData->otherAgents) && count($propertyData->otherAgents) > 0) {
            foreach($propertyData->otherAgents as $otherAgent) {
                $agentData = array(
                    'name' => array_get($otherAgent, 'name'),
                    'phone' => array_get($otherAgent, 'phone'),
                    'email' => array_get($otherAgent, 'email'),
                );

                $agentData['user_login'] = wlsi_generate_user_login($agentData);

                $user_id = $propertyData->get_or_create_agent($agentData);
                if ($user_id > 0) {
                    Query::create_property_agent_relationship($property_id, $user_id);
                }
            }
        }
    }
}
