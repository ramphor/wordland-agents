<?php
namespace WordLand\Agents;

use WordLand\Agents\Admin\MenuDashboard;

class Admin
{
    public function __construct()
    {
        $this->load_features();
    }

    public function load_features()
    {
        MenuDashboard::create_admin_page();
    }
}
