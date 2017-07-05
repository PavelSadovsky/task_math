<?php

function pr()
{

    echo '
<div align="left">
    <pre style="background-color:#CCCCCC; border:1px solid black;">';

    $messages = func_get_args();

    if (empty($messages))
    {
        echo "--empty--";
    }
    else
    {
        foreach($messages as $it) $ret[] =  print_r($it,true);
        echo implode('<hr>', $ret);
    }

    echo '  </pre>
</div>';
}



/**
* Get config from $CONFIG
*
* @param string $alias   alias for $CONFIG[$alias]
* @return mixed on success and false on failure
*/
function get_configs($alias)
{       
    global $CONFIG;
    $res = false;

    if( !empty($CONFIG[$alias]) )
    {
        $res = $CONFIG[$alias];
    }

    return $res;        
}

/**
* Get config as only-array from $CONFIG
*
* @param string $alias   alias for $CONFIG[$alias]
* @return array on success and false on failure
*/
function get_configs_array($alias)
{      
    global $CONFIG;
    $res = false;

    if( is_array($CONFIG[$alias]) 
        &&  !empty($CONFIG[$alias]) )
    {
        $res = $CONFIG[$alias];
    }

    return $res;        
}



function get_view( $filename, $data = array() )
{
    if (is_file($filename))
    {
        ob_start();
        include $filename;
        return ob_get_clean();
    }
    return false;
}


function is_user( $email="", $pass="" )
{
    $res = false;

    if ( empty($email) OR !is_string($email) ) return false;
    if ( empty($pass)  OR !is_string($pass) )  return false;

    $email = htmlspecialchars(strip_tags( $email ));
    $pass  = htmlspecialchars(strip_tags( $pass ));
    $salt = get_configs('salt');
    $pass = $pass.$salt['salt'];

    if ( !defined('SITE_PATH') )
    {
        define('SITE_PATH', dirname(dirname(__FILE__)) . '/');
    }

    require_once SITE_PATH . 'libs/mysql_class.php';

    $connection = get_configs_array('connection');

    $a = new Mysql( $connection['db'], $connection['host'], $connection['user'], $connection['pass'] );

     $res = $a->query("SELECT id_user,name FROM users WHERE email = '$email' AND password = md5('$pass')", 'single');
    return $res;
}


/**
 * Get param from $_SESSION
 *
 * @param string $alias   alias for $_SESSION[$alias]
 * @return mixed on success and false on failure
 */
function get_param_from_session($alias = "")
{
    $res = false;

    if( !empty($_SESSION[$alias]) )
    {
        $res = $_SESSION[$alias];
    }

    return $res;
}

/**
 * Return key-page of settings and rules
 *
 * @param string $page   $_REQUEST['page'], alias for page
 * @param string $page_for_user    for Authorized user, alias for page
 * @param string $page_for_guest   for Unauthorized user(guest), alias for page
 *
 * @return string on success and false on failure
 */

function distributor_pages( $page = "", $page_for_user = "", $page_for_guest = "" )
{
    if( is_null($page) ) $page = "";

    if ( !is_string($page) ) return false;

    $a_page_settings = get_configs_array("page_settings");

    if ( !is_string($page_for_user)  OR empty($a_page_settings[$page_for_user]) )  return false;
    if ( !is_string($page_for_guest) OR empty($a_page_settings[$page_for_guest]) ) return false;

    $res = '';
    $is_session      = get_param_from_session('id_user');

    if ( $is_session )
    {
        if ( !empty($page) AND !empty($a_page_settings[$page]) AND in_array( $a_page_settings[$page]['mode'], array('users', 'all')) )
        {
            $res = $page;
        }
        else
        {
            $res = $page_for_user;
        }
    }
    else // without session, - guest
    {
        if ( !empty($page) AND !empty($a_page_settings[$page]) AND in_array( $a_page_settings[$page]['mode'], array('guest', 'all')) )
        {
            $res = $page;
        }
        else
        {
            $res = $page_for_guest;
        }
    }

    return $res;
}


function correct_name($name)
{
    $res = preg_match( "/^[A-z- ]{1,32}$/", $name, $correct_name );
    if( $res )
    {
        return $correct_name;
    }
    else
    {
        return FALSE;
    }

}

function correct_number_country($name)
{
    if( empty($name) )
    {
        return FALSE;
    }
    else
    {
        $res = preg_match( "/^[0-9]{1,3}$/", $name, $correct_name );
        if( $res )
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}


















?>