<?php
namespace WordLand\Agents\Integration;

use WordLand\Agents\Constracts\Integrator as IntegratorConstract;

class Integrator
{
    protected static $instance;
    protected static $integrators;

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        $activePlugins = get_option('active_plugins');
        if (in_array('elementor/elementor.php', $activePlugins)) {
            $this->push('elementor', new Elementor());
        }
    }

    protected function push($name, $integrator)
    {
        if (is_a($integrator, IntegratorConstract::class)) {
            static::$integrators[$name] = $integrator;
        } else {
            error_log(sprintf(
                'The integrator for plugin %s must be an instance of %s',
                $name,
                IntegratorConstract::class
            ));
        }
    }

    public function integrate()
    {
        $integrators = apply_filters(
            'wordland_agents_plugin_integrators',
            static::$integrators
        );
        foreach ($integrators as $integrator) {
            // Call the integrator
            $integrator->integrate();
        }
    }
}
