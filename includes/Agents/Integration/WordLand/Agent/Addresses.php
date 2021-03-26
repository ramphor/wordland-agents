<?php
namespace WordLand\Agents\Integration\WordLand\Agent;

use Ramphor\User\Abstracts\MyProfileAbstract;

class Addresses extends MyProfileAbstract
{
    const FEATURE_NAME = 'agent-addresses';

    protected $priority = 39;

    public function getName()
    {
        return static::FEATURE_NAME;
    }

    public function getMenuItem()
    {
        $addressesPage = wordland_get_option('agent_addresses_page');

        return array(
            'label' => __('Addresses', 'wordland_agents'),
            'url' => $addressesPage ? get_permalink($addressesPage) : '#',
        );
    }

    public function render()
    {
    }
}
