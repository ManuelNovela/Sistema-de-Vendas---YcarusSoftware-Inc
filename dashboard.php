<?php
require_once('configuracoes.php');

//user access
if(!$system['system_public']) {
    user_access();
}
if(!$user->_logged_in){
    header("Location: ".$system['system_url']."/dashboard/login");
}

// check admin|moderator permission
if(!$user->_is_admin && !$user->_is_moderator) {
    _error(__('System Message'), __("You don't have the right permission to access this"));
}

// check moderator mode
if($user->_is_moderator && !$moderator_mode) {
    /* moderator try to access admin panel */
    _error(__('System Message'), __("You don't have the right permission to access this"));
}

try {
    if(isset($_GET['view'])){
        switch ($_GET['view']){

            case 'pos' :{
                $smarty->display('_dash_pos.tpl');
            }break;
        }
        $smarty->assign('dash_view', $_GET['view']);
    }else{
        $smarty->display('_dash.tpl');
    }



}catch (Exception $e){
    _error(__("Error"), $e->getMessage());
}

?>