<?php
include_once('init.php');

$params = array($settingconfigData, $configData);
// Gets the action name from the form parameter 
$action = trim($_POST['action']);

/* Calls the action specified in the form submit */
$cnt = call_user_func_array(array($servicePortal, $action), $params);

print_r ($cnt);

exit;
?>
