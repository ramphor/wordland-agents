<?php
namespace WordLand;

final class WordLandAgents
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
    }
}
