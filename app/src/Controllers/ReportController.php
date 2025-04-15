<?php

namespace App\Controllers;

use SilverStripe\Control\Controller;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\UploadField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Assets\Upload;
use SilverStripe\ORM\ValidationResult;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use App\Models\Report;
use App\Models\ReportType;
use App\Models\ReportImage;

class ReportController extends Controller
{
    private static $allowed_actions = ['index', 'ReportForm'];

    private static $url_segment = 'report';

    public function index(HTTPRequest $request)
    {
        return [
            'ReportForm' => $this->ReportForm()
        ];
    }

    public function ReportForm()
    {
        $fields = [
            TextField::create('Title', 'Title'),
            DropdownField::create('ReportTypeID', 'Type', ReportType::get()->map('ID', 'Title'))->setEmptyString('-- select type --'),
            TextareaField::create('Description', 'Description'),
            NumericField::create('Latitude', 'Latitude'),
            NumericField::create('Longitude', 'Longitude'),
            EmailField::create('ContactEmail', 'Your Email (optional)'),
            UploadField::create('Image', 'Upload Photo')
        ];

        $actions = [
            FormAction::create('doSubmit')->setTitle('Submit')
        ];

        $form = Form::create($this, 'ReportForm', $fields, $actions);

        return $form;
    }

    public function doSubmit(array $data, Form $form, HTTPRequest $request): HTTPResponse
    {
        $report = Report::create();
        $form->saveInto($report);
        $report->Status = 'New';
        $report->write();

        return $this->redirectBack()->addHeader('X-Submitted', 'true');
    }
}
