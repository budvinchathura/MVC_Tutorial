<?php

class Home extends Controller{

    public function __construct($controller, $action) {
        parent::__construct($controller,$action);
    }

    public function indexAction($name=null)
    {
        
        $this->view->render('home/index');
    }
}