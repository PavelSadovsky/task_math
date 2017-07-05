<?php

$CONFIG = array(

    'salt' => array(
        'salt' => "*^:;$@#>Bw2=b:d{)~!`1989",
    ),

    'connection' => array(
        'host'    => 'localhost',
        'db'      => 'math',
        'user'    => 'root',
        'pass'    => '',
        'charset' => 'utf8',
    ),

    'page_settings' => array(

        'default_page' => array(
            'class'      => 'default_page.class.php',
            'class_name' => 'Default_page',
            'view'       => 'default_page.php',
            'layout'     => 'layout.php',
            'mode'       => 'users',
        ),

        'reg' => array(
            'class'      => 'reg.class.php',
            'class_name' => 'Reg',
            'view'       => 'reg.php',
            'layout'     => 'layout.php',
            'mode'       => 'guest',

        ),

        'login' => array(
            'class'      => 'login.class.php',
            'class_name' => 'Login',
            'view'       => 'login.php',
            'layout'     => 'layout.php',
            'mode'       => 'guest',

        ),

        'country' => array(
            'class'      => 'country.class.php',
            'class_name' => 'Country',
            'view'       => 'country/country.php',
            'layout'     => 'layout.php',
            'mode'       => 'all',
        ),

        'city' => array(
            'class'      => 'city.class.php',
            'class_name' => 'City',
            'view'       => 'city/city.php',
            'layout'     => 'layout.php',
            'mode'       => 'all',
        ),

        'language' => array(
            'class'      => 'language.class.php',
            'class_name' => 'Language',
            'view'       => 'language/language.php',
            'layout'     => 'layout.php',
            'mode'       => 'all',
        ),

        'talk' => array(
            'class'      => 'talk.class.php',
            'class_name' => 'Talk',
            'view'       => 'talk/talk.php',
            'layout'     => 'layout.php',
            'mode'       => 'users',
        ),
    ),

);

?>