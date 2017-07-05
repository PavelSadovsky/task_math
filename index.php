<?php

if ( !defined('SITE_PATH') )
{
    define('SITE_PATH', dirname(__FILE__) . '/');
}

require_once SITE_PATH . 'libs/functions.php';
require_once SITE_PATH . 'libs/mysql_class.php';
require_once SITE_PATH . 'config/config.php';
require_once SITE_PATH . 'libs/translate.inc.php';

$params = $_REQUEST;
$params += $_FILES;
session_start();


if ( $params['logout'] == 1 )
{
    session_start();
    $_SESSION = array();
    session_destroy();
    header('Location: /');
    die();
}

$page = "";

$page =  distributor_pages( $_REQUEST['page'], 'talk', 'login' );

$a_page_settings = get_configs_array("page_settings");

$page_settings = $a_page_settings[$page];

if (!empty($page_settings)
    && is_array($page_settings)
    && is_file(SITE_PATH . "models/" . $page_settings["class"])
    && is_file(SITE_PATH . "view/" . $page_settings["view"])
    && is_file(SITE_PATH . "view/" . $page_settings["layout"])
)
{
    require_once(SITE_PATH . "models/" . $page_settings["class"]);

    $o_model = new $page_settings['class_name']();

    if (!empty($_GET['action']) AND method_exists($o_model, $_GET['action']))
    {
        $method = $_GET['action'];
    }
    else
    {
        $method = 'default_action';
    }

    $data = $o_model->$method($params);
//pr($data);


    if( !empty($_SESSION['id_user']) AND !empty($_SESSION['name_user']) )
    {
        $data += $_SESSION;
    }

    $data['action'] = $method;

    if ( !empty($_GET['error']) )
    {
        $data['error'] = $_GET['error'];
    }
    if ( !empty($_GET['success']) )
    {
        $data['success'] = $_GET['success'];
    }

    $content = get_view(SITE_PATH . "view/" . $page_settings["view"], $data);
}

if (isset($_GET['debug']) )
{
    pr($page_settings, $params, $method, $data);
}

echo $content;
die;

?>