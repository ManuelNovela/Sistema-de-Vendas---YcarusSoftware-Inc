<?php
session_start();
define('ABSPATH',dirname(__FILE__).'/');
define('BASEPATH',dirname($_SERVER['PHP_SELF']));

require(ABSPATH.'includes/config.php');
$system['theme'] = 'default';
$system['system_url'] = SYS_URL;
$system['system_public'] = true;
$system['uploads_directory'] = "content/uploads";

require_once(ABSPATH.'includes/libs/Smarty/Smarty.class.php');

$smarty = new Smarty;
$smarty->template_dir = ABSPATH.'content/themes/'.$system['theme'].'/views';
$smarty->compile_dir = ABSPATH.'content/themes/'.$system['theme'].'/views_compiladas';
$smarty->loadFilter('output', 'trimwhitespace');


$smarty->assign("system",$system);
global $conn;
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// get functions
require_once(ABSPATH.'includes/functions.php');
require_once(ABSPATH.'includes/class-user.php');

try {
    $user = new User();
    /* assign variables */
    $smarty->assign('user', $user);
} catch (Exception $e) {
    _error(__("Error"), $e->getMessage());
}


$system['nome'] = getData('definicoes')['nome'];
$system['email'] = getData('definicoes')['email'];
$system['telefone'] = getData('definicoes')['telefone'];
$system['localizacao'] = getData('definicoes')['localizacao'];
$system['titulo'] = "YcarusSoftware - VENDAS";
$system['email_smtp_server'] = 'smtp.gmail.com';
$system['email_smtp_authentication'] = true;
$system['email_smtp_username'] = 'drivegoogl3drive@gmail.com';
$system['email_smtp_password'] = 'googledrive3672';
$system['email_smtp_ssl'] = true;
$system['email_smtp_port'] = '465';
$system['email_smtp_setfrom'] = false;

$hoje = date("Y/m/d");
$smarty->assign('hoje', $hoje);
$smarty->assign('system',$system);


?>
