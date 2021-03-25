<?php
namespace WordLand\Agents\Integration\WordLand\Payment;

use Ramphor\User\Abstracts\MyProfileAbstract;
use WordLand\Agents\Integration\WordLand\TemplateLoader;

class Invoice extends MyProfileAbstract
{
    const FEATURE_NAME = 'invoice';

    protected $priority = 30;

    public function getName()
    {
        return static::FEATURE_NAME;
    }

    public function getMenuItem()
    {
        return array(
            'label' => __('Invoices', 'wordland_agents'),
            'url' => '#',
        );
    }

    public function render()
    {
        return TemplateLoader::render(
            'my-profile/feature/invoices',
            array(),
            null,
            false
        );
    }
}
