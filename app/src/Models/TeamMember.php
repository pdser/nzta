<?php

namespace App\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;

class TeamMember extends DataObject
{
    private static $table_name = 'TeamMember';

    private static $db = [
        'Name' => 'Varchar(100)',
        'JobTitle' => 'Varchar(100)',
        'Bio' => 'Text'
    ];

    private static $has_one = [
        'Photo' => Image::class
    ];

    private static $owns = [
        'Photo'
    ];

    private static $summary_fields = [
        'Name' => 'Name',
        'JobTitle' => 'Job Title',
        'Photo.CMSThumbnail' => 'Photo'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Name'),
            TextField::create('JobTitle'),
            TextareaField::create('Bio'),
            UploadField::create('Photo')
        ]);

        return $fields;
    }
}
