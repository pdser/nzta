<?php
namespace App\Controllers;

use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;
use App\Models\RoadReport;
use SilverStripe\ORM\PaginatedList;

class HomePageController extends Controller
{
    private static $allowed_actions = ['index'];

    protected function init()
    {
        parent::init();
        $this->response->addHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }

    public function index(HTTPRequest $request)
    {
        $status = $request->getVar('status');
        $reports = RoadReport::get();

        if ($status) {
            $reports = $reports->filter('Status', $status);
        }

        $paginated = PaginatedList::create($reports, $request);
        $paginated->setPageLength(5);

        return $this->customise([
            'Reports' => $paginated,
            'Status' => $status
        ])->renderWith(['Layout/HomePageController']);
    }
}
