<?php
namespace WordLand\Agents;

use WordLand\Agents\Integration\SpreadsheetImporter\MultiAgents;

class Integrations
{
    protected $multiAgents;

    public function __construct()
    {
        $this->multiAgents = new MultiAgents();
    }

    public function integrate()
    {
        add_action('init', array($this->multiAgents, 'init'));
    }
}
