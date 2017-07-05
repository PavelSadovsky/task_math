<?php

if ( !defined('SITE_PATH') )
{
    define('SITE_PATH', dirname(dirname(__FILE__)) . '/');
}

require_once SITE_PATH . 'libs/functions.php';


class City extends Mysql
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
        $params += $_SESSION;

            $a['city'] = $this->get_all_city();
        return $a;
    }

    public function edit($params = array())
    {
        $a = array();
        $city = $this->get_city($params['id_city']);
        $all_country = $this->get_all_country();

        foreach($all_country as $key => $value)
        {
            if( $value['id_country'] == $city['id_country'] )
            {
                $all_country[$key]['selected'] .= "selected";
            }

        }

        $a['id_city']        = $city['id_city'];
        $a['city']           = $city['city'];
        $a['id_country']     = $city['id_country'];
        $a['all_country']    = $all_country;

        return $a;
    }

    public function edit_save( $params = array() )
    {
        $a = array();

        if( !empty($params['id_city']) AND !empty($params['city']) AND !empty($params['id_country']) )
        {
            $city = htmlspecialchars(strip_tags( $params['city'] ));

            $strlen = strlen($city);
            if( $strlen <= 32)
            {
                if( correct_name($city) )
                {
                    $check = $this->query("SELECT * FROM city WHERE id_country = {$params['id_country']} AND city = '$city'");

                    if( !$check )
                    {
                        $res = $this->query_dml("UPDATE city SET city = '$city', id_country = {$params['id_country']}  WHERE id_city = {$params['id_city']}");

                        if( $res )
                        {
                            header('Location: /?page=city');
                            die();
                        }
                        return $a;

                    }
                    else
                    {
                        echo "В Базе уже есть запись с таким именем";
                    }

                }
                else
                {
                    echo "Некоректное имя";
                }

            }
            else
            {
                echo "Больше 32 символов";
            }



        }
    }


    public function delete( $params =array() )
    {
        $a = array();

        if( !empty($params['id_city']) )
        {
            $res = $this->query_dml("DELETE FROM city WHERE id_city = {$params['id_city']}");
            if( $res )
            {
                header('Location: /?page=city');
                die();
            }
            return $a;
        }
    }

    public function add_city( $params = array() )
    {
        $a = array();

        if( !empty($params['city']) and !empty($params['id_country']))
        {
            $city = htmlspecialchars(strip_tags( $params['city'] ));

            $strlen = strlen($city);

            if( $strlen <= 32)
            {
                if( correct_name($city) )
                {
                    $check = $this->check_in_table($params['page'],$city,$params['id_country']);

                    if( !$check )
                    {
                        $res = $this->query_dml("INSERT INTO city(city,id_country) VALUES('$city',{$params['id_country']}) ");

                        if( $res )
                        {
                            header('Location: /?page=city');
                            die();
                        }
                    }
                    else
                    {
                        echo "City <b>$city</b> already exists in the database";
                    }
                    return $a;
                }
                else
                {
                    echo "Некоректное имя";
                }

            }
            else
            {
                echo "Больше 32 символов";
            }

        }
    }


    public function get_all_city()
    {
        $res = $this->query("SELECT * FROM city c LEFT JOIN country cnt ON c.id_country = cnt.id_country");
        return $res;
    }

    private function get_city($id_city = "")
    {
        if ( !empty($id_city) )
        {
            $res = $this->query("SELECT id_city, city, id_country FROM city WHERE id_city = $id_city");

            $a = array();

            foreach ( $res as $key => $value)
            {
                foreach ( $value as $k => $v )
                {
                    $a[$k] .= $v;
                }
            }
            $res = $a;
    }

        return $res;
    }

    public function add( $params =array() )
    {
        $a = array();

        $all_country = $this->get_all_country();

        $a['all_country'] = $all_country;
            return $a;
    }

    private function get_all_country()
    {
        $res = $this->query("SELECT * FROM country");
        return $res;
    }


    private function check_in_table( $table="", $name="", $id_country = 0 )
    {
        $table = htmlspecialchars(strip_tags($table));
        $name  = htmlspecialchars(strip_tags($name));
        $id_country = (int)$id_country;

        $res = $this->query("SELECT * FROM $table WHERE $table = '$name' AND id_country = $id_country");
        return $res;
    }

}
?>