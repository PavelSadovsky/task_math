<?php

if ( !defined('SITE_PATH') )
{
    define('SITE_PATH', dirname(dirname(__FILE__)) . '/');
}

require_once SITE_PATH . 'libs/functions.php';


class Login extends Mysql
{
    function __construct()
    {
        $connection =  get_configs_array( 'connection' );

        if ( $connection )
        {
            parent::__construct($connection['db'], $connection['host'], $connection['user'], $connection['pass'] );
        }
    }

    public function default_action( $params = array() )
    {
        $a = array();
        return $a;
    }

    public function login( $params = array() )
    {
        $a = array();

        $email = htmlspecialchars(strip_tags( $params['email']));
        $pass  = htmlspecialchars(strip_tags(  $params['password']));

        $res = is_user( $email, $pass );

        if( $res )
        {
            if( is_array($res) )
            {
                foreach( $res as $key => $val )
                {
                    $_SESSION[$key] = $val;
                }
                header('Location: /?page=talk');
                die;
            }
        }
        else
        {
            $a['error'] = "login_incorrect";
        }
        return $a;
    }


}

?>