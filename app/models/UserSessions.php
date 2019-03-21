<?php

class UserSessions extends Model
{

    public function __construct()
    {
        $table = 'user_sessions';
        parent::__construct($table);
    }

    public static function getSessionFromCookie()
    {
        $userSession = new self();
        if (Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
            $userSession = $userSession->findFirst([
                'conditions' => "session = ?",
                'bind' => [Cookie::get(REMEMBER_ME_COOKIE_NAME)]
            ]);
        }
        
        if (!$userSession) {
            return false;
        }
        return $userSession;
    }
}
