<?php

namespace App\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Security\Member;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\UploadField;
use SilverStripe\Forms\NumericField;
use SilverStripe\AssetAdmin\Forms\UploadField as AdminUploadField;

class Report extends DataObject
{
    private static $table_name = 'Report';

    private static $db = [
        'Title' => 'Varchar(255)',
        'Description' => 'Text',
        'Latitude' => 'Decimal(10,6)',
        'Longitude' => 'Decimal(10,6)',
        'Status' => 'Enum(array("New", "In Progress", "Resolved", "Rejected"), "New")',
        'ContactEmail' => 'Varchar(255)',
    ];

    private static $has_one = [
        'ReportType' => ReportType::class,
        'Image' => Image::class,
    ];

    private static $summary_fields = [
        'Title' => 'Title',
        'ReportType.Title' => 'Type',
        'Status' => 'Status',
        'Created' => 'Submitted On',
    ];

    private static $owns = ['Image'];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Title'),
            DropdownField::create('ReportTypeID', 'Type', ReportType::get()->map('ID', 'Title')),
            TextareaField::create('Description'),
            NumericField::create('Latitude'),
            NumericField::create('Longitude'),
            TextField::create('ContactEmail'),
            DropdownField::create('Status', 'Status', singleton(self::class)->dbObject('Status')->enumValues()),
            AdminUploadField::create('Image')
        ]);

        return $fields;
    }
}
