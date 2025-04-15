<?php

namespace App\Models;

use SilverStripe\ORM\DataObject;

class ReportType extends DataObject
{
    private static $table_name = 'ReportType';

    private static $db = [
        'Title' => 'Varchar(100)'
    ];

    private static $has_many = [
        'Reports' => Report::class
    ];

    private static $summary_fields = [
        'Title'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        return $fields;
    }
}
