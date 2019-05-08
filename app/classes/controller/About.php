<?php

namespace App\Controller;

class About extends Base {

    public function __construct() {
        parent::__construct();

        $view = new \Core\Page\View([
            'title' => 'Welcome to About'
        ]);

        $this->page['content'] = $view->render(ROOT_DIR . '/app/views/content.tpl.php');

    }

}
