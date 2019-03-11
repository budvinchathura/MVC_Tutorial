<?php

class Users extends Model{

    private $_isLoggedIn, $_sessionName, $_cookieName;

    public static $currentLoggedInUser = null;

    public function __construct($user=''){
        $table='users';
        parent::__construct($table);
        $this->_sessionName = CURRENT_USER_SESSION_NAME;
        $this->_cookieName = REMEMBER_ME_COOKIE_NAME;
        $this->_softDelete = true;

        //$user represents the email of the user
        if($user !=''){
            $u = null;
            // debugPrint($user);
            if (filter_var($user, FILTER_VALIDATE_EMAIL)){
                $u = $this->_db->findFirst('users',['conditions'=>'email = ?','bind'=>[$user]]);
            } else{
                
            }

            if($u){
                foreach($u as $key=>$value){
                    $this->$key = $value;
                }
            }
        }
    }

    public function login($rememberme = false){
        Session::set($this->_sessionName,$this->id);
        if($rememberme){
            $hash = md5(uniqid()+rand(0,100));
            $user_agent = Session::uagentNoVersion();
            Cookie::set($this->_cookieName,$hash,REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session'=>$hash, 'user_agent'=>$user_agent,'user_id'=>$this->id];
            $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent= ?",[$this->id,$user_agent]);
            $this->_db->insert('user_sessions',$fields);
        }
    }
}