<?php

class Home extends Controller{

    public function __construct($controller, $action) {
        parent::__construct($controller,$action);
    }

    public function indexAction($name)
    {
        // die('Welcome to home controller, this is the indexAction');
        echo 'hello!!'.$name;
        $this->view->render('home/index');
    }
}