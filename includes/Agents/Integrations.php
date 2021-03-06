<?php
namespace WordLand\Agents;

use Ramphor\User\Abstracts\MyProfileAbstract;
use WordLand\Agents\Integration\PropertyBuilder;
use WordLand\Agents\Integration\SpreadsheetImporter\MultiAgents;
use WordLand\Agents\Integration\WordLand\Agent\Addresses;
use WordLand\Agents\Integration\WordLand\Payment\Invoice;
use WordLand\Agents\Integration\WordLand\Membership\SubscribePackage;
use WordLand\Agents\Integration\WordLand\Query\ExtendAgentQuery;
use WordLand\Agents\Integration\WordLand\OverrideTemplate;

class Integrations
{
    protected $multiAgents;
    protected $propertyBuilder;

    public function __construct()
    {
        $this->multiAgents      = new MultiAgents();
        $this->propertyBuilder  = new PropertyBuilder();
        $this->extendAgentQuery = new ExtendAgentQuery();
    }

    public function integrate()
    {
        add_action('init', array($this->multiAgents, 'init'));
        add_action('init', array($this->propertyBuilder, 'init'));
        add_action('init', array($this->extendAgentQuery, 'init'));

        add_action('init', array($this, 'registerInvoicePageInProfile'));
    }

    public function registerInvoicePageInProfile()
    {
        add_filter('wordland_my_profile_features', array($this, 'registerInvoiceFeature'));
    }

    public function registerInvoiceFeature($features)
    {
        $features[Invoice::FEATURE_NAME] = Invoice::class;
        $features[SubscribePackage::FEATURE_NAME] = SubscribePackage::class;
        $features[Addresses::FEATURE_NAME] = Addresses::class;

        return $features;
    }
}
