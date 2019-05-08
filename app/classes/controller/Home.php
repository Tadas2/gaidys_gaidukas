<?php

namespace App\Controller;

class Home extends Base {

    protected $view;

    public function __construct() {
        parent::__construct();

        $this->view = new \Core\Page\View([
            'title' => 'Welcome to Home'
        ]);

        $this->page['content'] = $this->view->render(ROOT_DIR . '/app/views/content.tpl.php');
    }

}
