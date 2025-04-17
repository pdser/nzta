<?php

namespace App\Controllers;

use SilverStripe\Control\Controller;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DatetimeField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\FileField;
use SilverStripe\Security\Security;
use App\Models\RoadReport;
use SilverStripe\Control\Director;
use SilverStripe\Assets\Upload;
use SilverStripe\Assets\Image;
use SilverStripe\Assets\Folder;

class ReportController extends Controller
{
    private static $allowed_actions = ['index', 'ReportForm'];
    private static $url_segment = 'submit';

    public function index()
    {
        if ($redirect = $this->requireLogin('/login', 'Please log in to submit a report.')) {
            return $redirect;
        }

        return $this->customise([
            'ReportForm' => $this->ReportForm()
        ])->renderWith(['Layout/ReportController']);
    }

    protected function requireLogin($backUrl = 'my-reports', $message = 'Please log in first.')
    {
        $member = Security::getCurrentUser();

        if (!$member || !$member->exists()) {
            // 设置用户提示信息
            $this->getRequest()->getSession()->set(
                'SecurityMessage.message',
                $message
            );
            $this->getRequest()->getSession()->set(
                'SecurityMessage.type',
                'bad'
            );

            // 拼接自定义 login 页面地址，并附带 BackURL 参数
            $loginURL = Director::absoluteBaseURL() . 'login?BackURL=' . urlencode($backUrl);

            return $this->redirect($loginURL);
        }

        return null; // 已登录，正常继续
    }

    public function ReportForm()
    {
        $fields = FieldList::create(
            TextareaField::create('Description', 'Describe the problem'),
            TextField::create('Location', 'Location'),
            DatetimeField::create('ReportedAt', 'Reported Time'),
            FileField::create('MyImage', 'Attach a photo')
        );

        $actions = FieldList::create(
            FormAction::create('doSubmitReport', 'Submit Report')
        );

        $form = Form::create($this, 'ReportForm', $fields, $actions);
        $form->setEncType(Form::ENC_TYPE_MULTIPART);
        return $form;
    }

    public function doSubmitReport($data, $form)
    {
        if ($redirect = $this->requireLogin('/login', 'Please log in before submitting.')) {
        return $redirect;
    }
        $member = Security::getCurrentUser();
        if (!$member) {
            return $this->redirect(Director::absoluteBaseURL() . '/register');
        }

        $report = RoadReport::create();
        $report->ReporterID = $member->ID;
        $report->Description = $data['Description'] ?? '';
        $report->Location = $data['Location'] ?? '';
        $report->ReportedAt = $data['ReportedAt'] ?? null;

        // ✅ 上传图片并绑定到报告
        if (!empty($_FILES['MyImage']) && $_FILES['MyImage']['error'] === UPLOAD_ERR_OK) {
            $upload = Upload::create();
            $image = Image::create();

            // 确保父文件夹存在
            $folder = Folder::find_or_make('Uploads/RoadReports');
            $image->ParentID = $folder->ID;

            // 上传图片文件
            $result = $upload->loadIntoFile($_FILES['MyImage'], $image, 'Uploads/RoadReports');

            //if (is_object($result) && $result->isValid()) {
            if ($result) {
                $image->write();         // 保存图片到数据库
                $image->publishSingle(); // 发布图片到 public/assets
                //$report->ImageID = $image->ID; // ✅ 自动绑定 Image 对象（推荐方式）
                $report->Image = $image;

                error_log("✅ Image uploaded: ID = " . $image->ID);
            } else {
                error_log("❌ Image upload failed:");
                error_log(print_r($result, true));
            }
        }

        $report->write(); // 最后写入 Report（包括 Image 关系）

        $form->sessionMessage('Report submitted successfully!', 'good');
        return $this->redirect(Director::absoluteBaseURL() . '/my-reports');
    }
}
