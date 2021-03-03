<?php
namespace WordLand\Agents\Integration\Elementor\Widgets;

use Elementor\Widget_Base;
use WordLand\Agents\Query\AgentQuery;
use WordLand\Agents\Renderer\Agents as AgentsRenderer;

class AgentsWidget extends Widget_Base
{
    public function get_name()
    {
        return 'wordland_agents_agents';
    }

    public function get_title()
    {
        return __('WordLand Agents', 'wordland_agents');
    }

    public function get_icon()
    {
        return 'eicon-person';
    }

    public function get_categories()
    {
        return array('general', 'landpress');
    }

    protected function _register_controls()
    {
    }

    protected function render()
    {
        $settings= $this->get_settings_for_display();
        $query = new AgentQuery(array(
        ));
        $renderer = new AgentsRenderer($query);
        $renderer->setProps($settings);

        echo (string) $renderer;
    }

    protected function _content_template()
    {
    }
}
