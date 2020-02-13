<?php
// get the absolute path to the file location within directory

define('ABSPATH', __DIR__);
define('ADMIN_PATH', ABSPATH.'/php');
define('ADMIN_SCRIPT_PATH', ADMIN_PATH.'/script');

ini_set('display_errors', 1);
require_once ABSPATH.'/config/connect.php';
require_once ADMIN_SCRIPT_PATH.'/login.php';
require_once ADMIN_SCRIPT_PATH.'/mail.php';
