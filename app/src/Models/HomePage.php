<?php
// app/src/Pages/HomePage.php
namespace App\Models;

use Page;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

class HomePage extends Page 
{
    private static $table_name = 'HomePage';
    
    private static $db = [
        'WelcomeMessage' => 'Varchar(255)',
        'IntroContent' => 'HTMLText'
    ];
    
    private static $has_one = [
        'BannerImage' => Image::class
    ];
    
    private static $owns = [
        'BannerImage'
    ];
    
    public function getCMSFields() 
    {
        $fields = parent::getCMSFields();
        
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('WelcomeMessage', '欢迎信息'),
            HTMLEditorField::create('IntroContent', '介绍内容')
                ->setRows(5),
            UploadField::create('BannerImage', '横幅图片')
                ->setFolderName('home-banners')
        ]);
        
        return $fields;
    }
}