<?php

class Home extends Controller{

    public function __construct($controller, $action) {
        parent::__construct($controller,$action);
    }

    public function indexAction($name=null)
    {
        // die('Welcome to home controller, this is the indexAction');
        $db = DB::getInstance();
        $fields = [
            'first_name' => 'aaay',
            'last_name' => 'bbbx',
            'email' => 'abc@abcd.com',
            'password' => 'pass55'
            
        ];
        $deleted = $db->update('users',5,$fields);
        // debugPrint($users);
        $this->view->render('home/index');
    }
}