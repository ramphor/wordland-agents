<?php
namespace WordLand\Agents;

use WordLand\Agents\Integration\SpreadsheetImporter\MultiAgents;
use WordLand\Agents\Integration\PropertyBuilder;

class Integrations
{
    protected $multiAgents;
    protected $propertyBuilder;

    public function __construct()
    {
        $this->multiAgents = new MultiAgents();
        $this->propertyBuilder = new PropertyBuilder();
    }

    public function integrate()
    {
        add_action('init', array($this->multiAgents, 'init'));
        add_action('init', array($this->propertyBuilder, 'init'));
    }
}
