<?php

namespace App\Controllers;

use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\PasswordField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Security\MemberAuthenticator\MemberAuthenticator;
use SilverStripe\Security\IdentityStore;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Control\Director;

class CustomLoginForm extends Form
{
    public function __construct($controller, $name)
    {
        $fields = FieldList::create(
            TextField::create('Email', 'Email'),
            PasswordField::create('Password', 'Password')
        );

        $actions = FieldList::create(
            FormAction::create('doLogin', 'Login')
        );

        parent::__construct($controller, $name, $fields, $actions);
    }

    public function doLogin($data, $form)
    {
        if (empty($data['Email']) || empty($data['Password'])) {
            $form->sessionMessage('Please enter both email and password.', 'bad');
            return $this->controller->redirectBack();
        }

        $authenticator = new MemberAuthenticator();
        $member = $authenticator->authenticate([
            'Email' => $data['Email'],
            'Password' => $data['Password']
        ], $this->controller->getRequest());

        if (!$member || !$member->exists()) {
            $form->sessionMessage('Invalid login. Please check your credentials.', 'bad');
            return $this->controller->redirectBack();
        }

        // ✅ 正确方式：使用 Injector 获取 IdentityStore
        /** @var IdentityStore $store */
        $store = Injector::inst()->get(IdentityStore::class);
        $store->logIn($member, true); // true 表示记住我

        $form->sessionMessage("Welcome back, {$member->FirstName}!", 'good');
        return $this->controller->redirect(Director::absoluteBaseURL() . '/submit');
    }
}