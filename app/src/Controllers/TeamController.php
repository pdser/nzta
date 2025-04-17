<?php

namespace App\Controllers;

use SilverStripe\Control\Controller;
use App\Models\TeamMember;

class TeamController extends Controller
{
    private static $allowed_actions = ['index'];

    public function index()
    {
        //print_r(TeamMember::get()->toArray());
        return [
            'TeamMembers' => TeamMember::get()
        ];
        //return $this->renderWith(['Layout/TeamController']);
        // return $this->customise([
        //     'TeamMembers' => TeamMember::get()
        // ])->renderWith(['Layout/TeamController']);
    }
}
