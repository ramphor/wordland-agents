<?php
/**
 * Plugin Name: WordLand Agents
 * Author: Ramphor Premium
 * Author URI: https://puleeno.com
 * Description:  Create and management agents for WordLand
 * Version: 1.0.0
 */

define('WORDLAND_AGENT_PLUGIN_FILE', __FILE__);

if (!class_exists(WordLand_Agents::class)) {
    $composerAutoloader = sprintf('%s/vendor/autoload.php', dirname(__FILE__));
    if (file_exists($composerAutoloader)) {
        require_once $composerAutoloader;
    }
}

register_activation_hook(
    WORDLAND_AGENT_PLUGIN_FILE,
    array(\WordLand\Agents\Installer::class, 'install')
);

if (!function_exists('wordland_agents')) {
    function wordland_agents() {
        if (empty($GLOBALS['wordland_agents'])) {
            $GLOBALS['wordland_agents'] = WordLand_Agents::getInstance();
        }
        return $GLOBALS['wordland_agents'];
    }
}

add_action('plugins_loaded', 'wordland_agents');
