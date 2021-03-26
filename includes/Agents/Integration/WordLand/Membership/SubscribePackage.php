<?php
namespace WordLand\Agents\Integration\WordLand\Membership;

use Ramphor\User\Abstracts\MyProfileAbstract;
use WordLand\Agents\Integration\WordLand\TemplateLoader;

class SubscribePackage extends MyProfileAbstract
{
    const FEATURE_NAME = 'subscribe-package';

    protected $priority = 40;

    public function getName()
    {
        return static::FEATURE_NAME;
    }

    public function getMenuItem()
    {
        $subscribePackagePage = wordland_get_option('subscribe_package_page');

        return array(
            'label' => __('Subcribe package', 'wordland_agents'),
            'url' => $subscribePackagePage ? get_permalink($subscribePackagePage) : '#',
        );
    }

    public function render()
    {
        return TemplateLoader::render(
            'my-profile/feature/subcribe-package',
            array(),
            null,
            false
        );
    }
}
