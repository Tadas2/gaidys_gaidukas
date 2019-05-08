<?php

namespace App\Controller;

class Register extends Base {

    /** @var \App\Objects\Form\Register */
    protected $form;

    public function __construct() {
        parent::__construct();

        $this->form = new \App\Objects\Form\Register();

        switch ($this->form->process()) {
            case \App\Objects\Form\Register::STATUS_SUCCESS:
                $this->registerSuccess();
                $this->page['content'] = 'Sekmingai uzsregistravai';
                break;
            default:
                $this->page['content'] = $this->form->render();
        }
    }

    public function registerSuccess() {
        $safe_input = $this->form->getInput();

        $user = new \Core\User\User([
            'email' => $safe_input['email'],
            'password' => $safe_input['password'],
            'full_name' => $safe_input['full_name'],
            'age' => $safe_input['age'],
            'gender' => $safe_input['gender'],
            'orientation' => $safe_input['orientation'],
            'account_type' => \Core\User\User::ACCOUNT_TYPE_USER,
            'photo' => $safe_input['photo'],
            'is_active' => true
        ]);

        $success_msg = strtr('User "@email" sėkmingai sukurtas!', [
            '@email' => $safe_input['email']
        ]);

        \App\App::$user_repo->insert($user);
    }

}
