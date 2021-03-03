<?php
use WordLand\Agents\Integration\Integrator;

use WordLand\Agents\Admin as AgentsDashboard;

final class WordLand_Agents
{
    protected static $instance;

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        // If the WordLand plugin is not active. This plugin is do not anything.
        if (!class_exists(WordLand::class)) {
            return;
        }
        $this->initFeatures();
    }

    protected function initFeatures()
    {
        if (wp_is_request('admin')) {
            new AgentsDashboard();
        }
    }
}
