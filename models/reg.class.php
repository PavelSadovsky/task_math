<?php

if ( !defined('SITE_PATH') )
{
    define('SITE_PATH', dirname(dirname(__FILE__)) . '/');
}

require_once SITE_PATH . 'libs/functions.php';


class Reg extends Mysql
{
    function __construct()
    {
        $connection = get_configs_array('connection');

        if ($connection) {
            parent::__construct($connection['db'], $connection['host'], $connection['user'], $connection['pass']);
        }
    }

    public function default_action($params = array())
    {

        $a = array('default_action' => "default_action");

        return $a;
    }

    public function add_reg($params = array())
    {
        $a = array();
        return $a;
    }

    public function reg($params = array())
    {
        $a = array();
        $a['mess'] = "Free Registration NOW!!!";
        return $a;
    }

    public function add_registration( $params = array() )
    {
      //  pr($params);
        if ( !empty($params) AND is_array($params) )
        {
            if ( $params['password'] == $params['password2'] )
            {
                if ( filter_var($params['email'], FILTER_VALIDATE_EMAIL) )
                {
                    $name       = htmlspecialchars(strip_tags($params['name']));
                    $email      = htmlspecialchars(strip_tags($params['email']));
                    $password   = htmlspecialchars(strip_tags($params['password']));

                    $salt = get_configs_array('salt');
                    $password2 = $password.$salt['salt'];
                    $md5_password = md5($password2);

                    $user_id = $this->query_dml("INSERT INTO users(email,name,password) VALUES('$email','$name','$md5_password')");


                    $subject = "Registration Mathematic";
                    $message_email = "Login: $email\n Password: $password";


                    if ( $user_id )
                    {
                        $res_mail = mail("$email", "$subject", "$message_email");

                        if ( $res_mail  ) // $res_mail
                        {
                            header('Location: /?page=login&success=registration_correct');
                            die;
                        }
                    }
                }
                else
                {
                    $return_message = "email has an invalid format";
                    $a['error'] = "login_incorrect";
                }
            }
            else
            {
                $return_message = "passwords are not the same";
            }
        }

        if( $return_message )
        {
            $a['return_message'] = $return_message;
            $a['email'] = $params['email'];
            $a['name'] = $params['name'];
        }
        else
        {
            $a['return_message'] = "Do technical work, please try later";
        }

        return $a;

    }



}

?>