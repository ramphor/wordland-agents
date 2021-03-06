<?php
namespace WordLand\Agents\Integration\WordLand;

use Jankx\Template\Template as TemplateLib;

class TemplateLoader
{
    protected static $loader;
    protected static $userProfileLoader;

    public static function getEngine()
    {
        if (is_null(static::$loader)) {
            $templateDir = sprintf('%s/templates', dirname(WORDLAND_AGENT_PLUGIN_FILE));
            static::$loader = TemplateLib::createEngine(
                'wordland_agents',
                apply_filters('wordland_agents_template_directory_name', 'wordland/agent'),
                $templateDir,
                apply_filters('wordland_template_engine', 'wordpress')
            );
        }

        return static::$loader;
    }

    public static function render()
    {
        $args = func_get_args();
        return call_user_func_array(
            array(static::getEngine(), 'render'),
            $args
        );
    }
}
