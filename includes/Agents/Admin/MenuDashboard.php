<?php
namespace WordLand\Agents\Admin;

class MenuDashboard {
    private static $instance;

    public static function create_admin_page() {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct() {
        add_action('admin_menu', array($this, 'register_admin_menu'));
    }

    public function register_admin_menu() {
        add_submenu_page(
            'wordland',
            __('WordLand Agents', 'wordland_agents'),
            __('Agents', 'wordland_agents'),
            'manage_options',
            'wordland_agents',
            array($this, 'render_ui'),
        );
    }

    public function render_ui() {
    }
}
