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

if (!function_exists('wordland_agents')) {
    function wordland_agents() {
        return WordLand_Agents::getInstance();
    }
}

add_action('plugins_loaded', 'wordland_agents');
