<?php

if ( !defined('SITE_PATH') )
{
    define('SITE_PATH', dirname(dirname(__FILE__)) . '/');
}

require_once SITE_PATH . 'libs/functions.php';
require_once SITE_PATH . 'libs/mysql_class.php';
require_once SITE_PATH . 'config/config.php';

$a = explode("/", $_SERVER['REQUEST_URI']);

$countries = false;
$cities    = false;
$languages = false;

$error = false;
//pr($a);

if( !empty($a[2]) AND empty($a[3]) )
{
    if ( !empty($a[4]) AND $a[4] == 'cities' AND !empty($a[5]) AND $a[6] == 'languages')
    {
        $error = "Incorrect request. First element 'country' can not be zero";
    }
    else
    {
        if( $a[2] == 'countries')
        {
            $one = "Country";
        }
        elseif( $a[2] == 'cities' )
        {
            $one = "City";
        }
        elseif( $a[2] == 'languages' )
        {
            $one = "Language";
        }

        if( $one AND empty($a[3]) )
        {
            $name_class = strtolower($one);
            require_once(SITE_PATH . "models/".$name_class.".class.php");

            $_o = new $one();
            $method = "get_all_$name_class";
            $res = $_o->$method();
        }
        else
        {
            $error = "Incorrect request. First element ONLY: 'countries' OR 'cities' OR 'languages'";
        }
    }
}
elseif( !empty($a[2]) AND $a[2] == 'countries'
         AND !empty($a[3])                      // id_country
         AND !empty($a[4]) AND $a[4] == 'cities'
         AND empty($a[5]) )
{
    $id_countries = explode(',',$a[3]);

    foreach( $id_countries as $value )
    {
        $a_id_countries[] = (int)$value;
    }

    $ids_countries = implode(',',$a_id_countries);

    require_once(SITE_PATH . "models/talk.class.php");
    $o_mysql = new Talk();
    $res = $o_mysql->query("SELECT id_country,id_city,city FROM city WHERE id_country IN ($ids_countries)");

}
elseif( !empty($a[2]) AND $a[2] == 'countries'
    AND !empty($a[3])                      // id_country
    AND !empty($a[4]) AND $a[4] == 'cities'
    AND !empty($a[5])
    AND !empty($a[6]) AND $a[6] == 'languages'
    AND empty($a[7]))
{
   // $id_country = (int)$a[3];

    if( correct_number_country($a[3]) )
    {
        $id_country = (int)$a[3];
        $id_cities = explode(',',$a[5]);

        foreach( $id_cities as $value )
        {
            $a_id_cities[] = (int)$value;
        }

        $ids_cities = implode(',',$a_id_cities);

        require_once(SITE_PATH . "models/talk.class.php");
        $o_mysql = new Talk();

        $res = $id_languages = $o_mysql->query("SELECT t.id, c.country, ci.city, l.language FROM talk t
                                    LEFT JOIN country c  ON t.id_country = c.id_country 
                                    LEFT JOIN city ci  	 ON t.id_city = ci.id_city  
                                    LEFT JOIN language l ON t.id_language = l.id_language 
                                    WHERE t.id_country = $id_country AND t.id_city IN ($ids_cities) 
                                    ORDER BY 2 DESC,3 DESC,4 DESC");
    }
    else
    {
        $error = "Incorrect request. Wrong 'country', use only one country. Use REST API for this site";
    }
}
else
{
    $error = "Incorrect request. Use REST API for this site";
}


if( $error )
{
    header('HTTP/1.1 400 Bad Request');
    $err = array('error' => $error);
    echo json_encode($err);
    // pr(json_decode(json_encode($err), true));
}
else
{
    header('HTTP/1.1 200 OK');
    echo json_encode($res);
}
die;


?>