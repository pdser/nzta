<?php

namespace App\Controllers;

use SilverStripe\Control\Controller;
use App\Controllers\CustomLoginForm;

class LoginController extends Controller
{
    private static $allowed_actions = ['index', 'LoginForm'];
    private static $url_segment = 'login';

    public function index()
    {
        echo "123123";
        return $this->customise([
            'LoginForm' => $this->LoginForm()
        ])->renderWith(['Layout/LoginController']);
    }

    public function LoginForm()
    {
        return CustomLoginForm::create($this, 'LoginForm');
    }
}
