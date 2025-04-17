<?php

namespace App\Controllers;

use SilverStripe\Control\Controller;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\PasswordField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Security\Member;
use SilverStripe\Security\MemberAuthenticator\MemberAuthenticator;
use SilverStripe\Security\Security;
use SilverStripe\Control\Director;

class RegisterController extends Controller
{   
    private static $allowed_actions = ['index', 'RegisterForm'];
    private static $url_segment = 'register';
    public function index()
    {   
        return $this->customise([
            'RegisterForm' => $this->RegisterForm()
        ])->renderWith(['Layout/RegisterController']);
        // return [
        //     'RegisterForm' => $this->RegisterForm()
        // ];
    }

    public function RegisterForm()
    {
        $fields = FieldList::create(
            TextField::create('Name', 'Full Name'),
            TextField::create('Email', 'Email'),
            PasswordField::create('Password', 'Password'),
            PasswordField::create('ConfirmPassword', 'Confirm Password')
        );

        $actions = FieldList::create(
            FormAction::create('doRegister', 'Register')
        );

        return Form::create($this, 'RegisterForm', $fields, $actions);
    }

    public function doRegister($data, $form)
    {
        if ($data['Password'] !== $data['ConfirmPassword']) {
            $form->sessionMessage('Passwords do not match.', 'bad');
            return $this->redirectBack();
        }
    
        if (Member::get()->filter('Email', $data['Email'])->first()) {
            $form->sessionMessage('Email already exists.', 'bad');
            return $this->redirectBack();
        }
    
        $member = Member::create();
        $member->write(); 
        $form->saveInto($member);
        $member->write(); // ⬅️ 自动加密并保存密码
    
        Security::setCurrentUser($member); // 登录
        $form->sessionMessage('Registration successful. You are now logged in.', 'good');
        return $this->redirect(Director::absoluteBaseURL() . '/submit');
        //return $this->redirect('/submit');
    }
}
