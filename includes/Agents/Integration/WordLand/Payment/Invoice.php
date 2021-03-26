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
        $invoicesPage = wordland_get_option('invoice_page');

        return array(
            'label' => __('Invoices', 'wordland_agents'),
            'url' => $invoicesPage ? get_permalink($invoicesPage) : '#',
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
