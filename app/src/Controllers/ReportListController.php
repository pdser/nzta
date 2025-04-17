<?php

namespace App\Controllers;

use SilverStripe\Control\Controller;
use SilverStripe\Security\Security;
use SilverStripe\ORM\PaginatedList;
use App\Models\RoadReport;

class ReportListController extends Controller
{
    private static $allowed_actions = ['index'];
    private static $url_segment = 'my-reports';

    public function index()
    {
        $user = Security::getCurrentUser();

        if (!$user) {
            return $this->redirect('/login?BackURL=' . urlencode($this->Link()));
        }

        $allReports = RoadReport::get()
            ->filter('ReporterID', $user->ID)
            ->sort('Created', 'DESC');

        $reports = PaginatedList::create($allReports, $this->getRequest());
        $reports->setPageLength(5);

        return $this->customise([
            'UserReports' => $reports
        ])->renderWith(['Layout/ReportListController']);
    }
    public function getImageLink() {
        return $this->Image()->exists() ? $this->Image()->getURL() : null;
    }
}
