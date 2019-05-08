<?php

namespace App\Controller;

class Base extends \Core\Page\Controller {

    public function __construct() {
        parent::__construct();

        if (!\App\App::$session->isLoggedIn() === true) {
            $nav_view = new \App\View\Navigation([
                [
                    'link' => 'home',
                    'title' => 'Home'
                ],
                [
                    'link' => 'register',
                    'title' => 'Register'
                ],
                [
                    'link' => 'login',
                    'title' => 'Login'
                ],
                [
                    'link' => 'logout',
                    'title' => 'Logout'
                ]
            ]);
        } else {
            $nav_view = new \App\View\Navigation([
                [
                    'link' => 'index',
                    'title' => 'Index'
                ],
                [
                    'link' => 'register',
                    'title' => 'Register'
                ],
                [
                    'link' => 'logout',
                    'title' => 'Logout'
                ]
            ]);
        }

        $this->page['header'] = $nav_view->render();

        $footer_view = new \App\View\Footer([
            [
                'name' => 'Footer name',
                'contacts' => 'Footer contacts'
            ]
        ]);

        $this->page['footer'] = $footer_view->render();
    }

}
