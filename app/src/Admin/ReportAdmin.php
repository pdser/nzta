<?php

namespace App\Admin;

use SilverStripe\Admin\ModelAdmin;
use App\Models\Report;
use App\Models\ReportType;

class ReportAdmin extends ModelAdmin
{
    private static $managed_models = [
        Report::class,
        ReportType::class
    ];

    private static $url_segment = 'reports';
    private static $menu_title = 'Road Reports';
}
