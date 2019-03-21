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

    public function registerAction(){
        $validation  = new Validate();
        $postedValues = ['fname'=>'','lname'=>'','email'=>'','password'=>'','password2'=>''];
        if($_POST){
            $postedValues = postedValues($_POST);
            $validation->check($postedValues,
            ['fname'=>[
                'display'=>'First Name',
                'required'=>true
            ],'lname'=>[
                'display'=>'Last Name',
                'required'=>true
            ],'email'=>[
                'display'=>'Email',
                'required'=>true,
                'unique'=>'users'
            ],'password'=>[
                'display'=>'Password',
                'required'=>true,
                'min'=>6
            ],'password2'=>[
                'display'=>'Confirm Password',
                'required'=>true,
                'matches'=>'password'
            ]]);

            if($validation->passed()){
                $newUser = new Users();
                $newUser->registerNewUser($postedValues);
                $newUser->login();
                Router::redirect('');
            }
        }
        $this->view->post = $postedValues;
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('register/register');
    }
}