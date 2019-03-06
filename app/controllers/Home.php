<?php

class Home extends Controller{

    public function __construct($controller, $action) {
        parent::__construct($controller,$action);
    }

    public function indexAction($name=null)
    {
        // die('Welcome to home controller, this is the indexAction');
        $db = DB::getInstance();
        $users = $db->find('users',[
             'conditions'=>['last_name = ?', 'first_name=?'],
            'bind' => ['bbb','aaa'],
            'order'=>"first_name, last_name",
            'limit'=>5
          ]);
        
        debugPrint($users);
        $this->view->render('home/index');
    }
}