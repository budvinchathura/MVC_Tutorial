<?php

class Register extends Controller{

    public function __construct($controller, $action){
        parent::__construct($controller,$action);
        $this->loadModel('Users');
        $this->view->setLayout('default');
    }

    public function loginAction(){
        $validation = new Validate();
        if($_POST){
            //form validation

            $validation ->check($_POST,[
                'email'=>[
                    'display'=>'Email',
                    'required'=>true
                ],
                'password'=>[
                    'display'=>'Password',
                    'required'=>true,
                    'min'=>6
                ]
            ]);
            if($validation->passed()){
                // debugPrint($this->UsersModel);
                $user = $this->UsersModel->findByEmail($_POST['email']);
                if($user && password_verify(Input::get('password'),$user->password)){
                    $remember = (isset($_POST['rememberme']) && Input::get('rememberme')) ? true : false;
                    
                    $user->login($remember);
                    Router::redirect('');
                }
                else{
                    $validation->addError("There is an error with your username or password");
                }
            }
        }
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('register/login');
    }

    public function logoutAction(){
        if(currentUser()){
        currentUser()->logout();
        
        }
        Router::redirect('register/login');
    }
}