<?php
namespace WordLand\Agents\Integration\Elementor\Widgets;

use Elementor\Widget_Base;

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
        echo 'agents day';
    }

    protected function _content_template()
    {
    }
}
