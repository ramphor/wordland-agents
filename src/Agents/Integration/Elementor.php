<?php
namespace WordLand\Agents\Integration;

use WordLand\Agents\Abstracts\IntegratorAbstract;
use WordLand\Agents\Integration\Elementor\Widgets\AgentsWidget;

class Elementor extends IntegratorAbstract
{
    public function integrate()
    {
        add_action('elementor/widgets/widgets_registered', array($this, 'registerWidgets'));
    }

    public function registerWidgets($widget_manager)
    {
        $widget_manager->register_widget_type(new AgentsWidget());
    }
}
