<?php
define('DEBUG',true);

// define('DB_NAME','kamudb'); //db name
// define('DB_USER','kamuroot'); // db user
// define('DB_PASSWORD','password123'); //db password
// define('DB_HOST','85.10.205.173:3306'); // db host

define('DB_NAME','accounts'); //db name
define('DB_USER','root'); // db user
define('DB_PASSWORD',''); //db password
define('DB_HOST','localhost'); // db host

define('DEFAULT_CONTROLLER','Home');
define('DEFAULT_LAYOUT','default');

define('SROOT','/MVC_Tutorial/'); //server root

define('SITE_TITLE','my first mvc framework');

define('CURRENT_USER_SESSION_NAME' , 'jkwedoUJHgjhvhGVHGctc'); //session name for logged in user

define('REMEMBER_ME_COOKIE_NAME','hFX5bnv65GFGghgcgg654rgfcG'); //cookie name for logged in user
define('REMEMBER_ME_COOKIE_EXPIRY',604800); //time in seconds for remember me cookie to live (30 days);

define('ACCESS_RESTRICTED','Restricted'); //controller for restricted redirect