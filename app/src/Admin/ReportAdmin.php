<?php

namespace App\Admin;

use SilverStripe\Admin\ModelAdmin;
use App\Models\RoadReport;

class ReportAdmin extends ModelAdmin
{
    private static $managed_models = [
        RoadReport::class
    ];

    private static $url_segment = 'reports';
    private static $menu_title = 'Road Reports';
    private static $menu_icon_class = 'font-icon-p-alert';
}
