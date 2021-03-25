<?php
namespace WordLand\Agents\Integration\WordLand\Membership;

use Ramphor\User\Abstracts\MyProfileAbstract;
use WordLand\Agents\Integration\WordLand\OverrideTemplate;

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
        return array(
            'label' => __('Subcribe package', 'wordland_agents'),
            'url' => '#',
        );
    }

    public function render()
    {
        return OverrideTemplate::render(
            'my-profile/feature/subcribe-package',
            array(),
            null,
            false
        );
    }
}
