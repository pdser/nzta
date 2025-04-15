<?php

namespace App\Controllers;

use SilverStripe\Control\Controller;
use SilverStripe\Security\Security;

class MyAccountController extends Controller
{
    private static $allowed_actions = ['index'];

    public function index()
    {
        $user = Security::getCurrentUser();
        if (!$user) {
            return $this->redirect('/login');
        }

        return ['User' => $user];
    }
}
