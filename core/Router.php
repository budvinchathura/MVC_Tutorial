<?php

    class Router{
        public static function route($url){
            //controller
            $controller = (isset($url[0])&&$url[0]!='')? ucwords(strtolower($url[0])) : DEFAULT_CONTROLLER;
            $controller_name = $controller;
            array_shift($url);
            
            //action
            $action = (isset($url[0])&&$url[0]!='')? strtolower($url[0]).'Action' : 'indexAction';
            $action_name = $action;
            array_shift($url);

            //acl check
            $grantAccess = self::hasAccess($controller_name,$action_name);
            if(!$grantAccess){
                $controller_name = $controller = ACCESS_RESTRICTED;
                $action_name = $action = 'indexAction';
            }
            //params
            $queryParams = $url;
            $dispatch = new $controller($controller_name, $action);
            
            if (method_exists($controller,$action)){
                call_user_func_array([$dispatch,$action],$queryParams);
            }else{
                debugPrint('Method does not exist in the controller'.$controller_name);
            }
        }

        public static function redirect($location){
            if(! headers_sent()){
                // debugPrint('Location: localhost'.SROOT.$location);
                header('Location: '.SROOT.$location);
                exit();                
            }else{
                echo '<script type="text/javascript">';
                echo 'window.location.href="'.SROOT.$location.'";';
                echo '</script>';
                echo '<noscript>';
                echo '<meta http-equiv="refresh" content="0;url='.$location.'"/>';
                echo '</noscript>';
                exit();
            }
        }

        public static function hasAccess($controller_name,$action_name='index'){
            $aclFile = file_get_contents(ROOT.DS.'app'.DS.'acl.json');
            $acl = json_decode($aclFile,true);
            debugPrint($acl);
            return false;
        }
    }