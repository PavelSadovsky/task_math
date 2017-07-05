<?php

if ( !defined('SITE_PATH') )
{
    define('SITE_PATH', dirname(dirname(__FILE__)) . '/');
}

require_once SITE_PATH . 'libs/functions.php';

class Default_page extends Mysql
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

        $a = array('one'=> 123);

        return $a;
    }


}

?>