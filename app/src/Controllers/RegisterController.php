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

class RegisterController extends Controller
{
    private static $allowed_actions = ['index', 'RegisterForm'];

    public function index()
    {
        return [
            'RegisterForm' => $this->RegisterForm()
        ];
    }

    public function RegisterForm()
    {
        $fields = FieldList::create(
            TextField::create('FirstName'),
            TextField::create('Email'),
            PasswordField::create('Password')
        );

        $actions = FieldList::create(
            FormAction::create('doRegister', 'Register')
        );

        return Form::create($this, 'RegisterForm', $fields, $actions);
    }

    public function doRegister($data, $form)
    {
        $existing = Member::get()->filter('Email', $data['Email'])->first();
        if ($existing) {
            $form->sessionMessage('Email already exists', 'bad');
            return $this->redirectBack();
        }

        $member = Member::create();
        $form->saveInto($member);
        $member->write();

        Security::setCurrentUser($member);
        return $this->redirect('/my-account');
    }
}
