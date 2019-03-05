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
            'first_name' => 'aaa',
            'last_name' => 'bbb',
            'email' => 'abc@abcd.com',
            'password' => 'pass111'
            
        ];
        $users = $db->insert('users',$fields);
        debugPrint($users);
        $this->view->render('home/index');
    }
}