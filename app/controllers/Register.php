<?php

class Register extends Controller{

    public function __construct($controller, $action){
        parent::__construct($controller,$action);
        $this->loadModel('Users');
        $this->view->setLayout('default');
    }

    public function loginAction(){
        if($_POST){
            //form validation

            $validation = true;
            if($validation){
                $user = $this->UsersModel->findByEmail($_POST['email']);
                
                if($user && password_verify(Input::get('password'),$user->password)){
                    $remember = (isset($_POST['rememberme']) && Input::get('rememberme')) ? true : false;
                    $user->login($remember);
                    Router::redirect('');
                }
            }
        }
        $this->view->render('register/login');
    }
}