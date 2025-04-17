<?php

namespace App\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Member;
use SilverStripe\Assets\Image;

class RoadReport extends DataObject
{
    private static $table_name = 'RoadReport';

    private static $db = [
        'Description' => 'Text',
        'Location' => 'Varchar(255)',
        'ReportedAt' => 'Datetime',
        'Status' => "Enum('Pending,In Progress,Resolved','Pending')"
    ];

    private static $has_one = [
        'Image' => Image::class,
        'Reporter' => Member::class
    ];

    private static $owns = [
        'Image'
    ];

    private static $summary_fields = [
        'Description' => 'Description',
        'Location' => 'Location',
        'ReportedAt' => 'Reported Time',
        'Status' => 'Status',
        'Reporter.Email' => 'Reporter Email'
    ];
}

