<?php

namespace App\Models;

use SilverStripe\Admin\ModelAdmin;
use app\src\Models;

class TeamAdmin extends ModelAdmin
{
    private static $managed_models = [
        TeamMember::class
    ];

    private static $url_segment = 'team-members';
    private static $menu_title = 'Team Members';
    private static $menu_icon_class = 'font-icon-user';
}
