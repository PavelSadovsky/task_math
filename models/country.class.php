<?php

if ( !defined('SITE_PATH') )
{
    define('SITE_PATH', dirname(dirname(__FILE__)) . '/');
}

require_once SITE_PATH . 'libs/functions.php';


class Country extends Mysql
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
        $a['country'] = $this->get_all_country();
        return $a;
    }

    public function edit($params = array())
    {
        $a = array();
        $category = $this->get_country($params['id_country']);

        $a["id_country"]    = $category['id_country'];
        $a["country"]       = $category['country'];
      //  $a['error']['one'] = "Первая ошибка";
        return $a;
    }

    public function edit_save( $params = array() )
    {
        $a = array();

        if( !empty($params['id_country']) AND !empty($params['country']) )
        {
            $country = htmlspecialchars(strip_tags( $params['country'] ));
            $params['id_country'] = (int)$params['id_country'];

            $strlen = strlen($country);
            if( $strlen <= 32)
            {
                if( correct_name($country) )
                {
                    $check = $this->check_in_table($params['page'],$country);

                    if( !$check )
                    {
                        $res = $this->query_dml("UPDATE country SET country = '$country' WHERE id_country = {$params['id_country']}");

                        if( $res )
                        {
                            header('Location: /?page=country&success=correct_edit_country');
                            die();
                        }
                    }
                    else
                    {
                        header("Location: /?page=country&action=edit&id_country={$params['id_country']}&error=duplicate_in_the_database");
                        die;
                    }
                }
                else
                {
                    header("Location: /?page=country&action=edit&id_country={$params['id_country']}&error=invalid_char_country");
                    die;
                }
            }
            else
            {
                header("Location: /?page=country&action=edit&id_country={$params['id_country']}&error=exceeding_characters_country");
                die;
            }


        }
    }


    public function delete( $params =array() )
    {
        $a = array();

        if( !empty($params['id_country']) )
        {
            $res = $this->query_dml("DELETE FROM country WHERE id_country = {$params['id_country']}");
            if( $res )
            {
                header('Location: /?page=country&success=delete_country_correct');
                die();
            }
            return $a;
        }
    }

    public function add_country( $params = array() )
    {
        $a = array();

        if( !empty($params['name_country']) )
        {
            $name_country = htmlspecialchars(strip_tags( $params['name_country'] ));

            $strlen = strlen($name_country);

            if( $strlen <= 32)
            {
                if( correct_name($name_country) )
                {
                    $check = $this->check_in_table($params['page'],$name_country);

                    if( !$check )
                    {
                        $res = $this->query_dml("INSERT INTO country(country) VALUES('$name_country') ");

                        if( $res )
                        {
                            header('Location: /?page=country&success=correct_add_country');
                            die();
                        }
                    }
                    else
                    {
                        header('Location: /?page=country&action=add&error=duplicate_in_the_database');
                        die();
                    }
                    return $a;
                }
                else
                {
                    header('Location: /?page=country&action=add&error=invalid_char_country');
                    die();
                }
            }
            else
            {
                header('Location: /?page=country&action=add&error=exceeding_characters_country');
                die();
            }

        }
    }


    public function get_all_country()
    {
        $res = $this->query("SELECT * FROM country");
        return $res;
    }

    private function get_country($id_country = "")
    {
        if ( !empty($id_country) )
        {
            $res = $this->query("SELECT id_country, country FROM country WHERE id_country = $id_country");

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

            return $a;
    }

    private function check_in_table( $table, $name )
    {
        $table = htmlspecialchars(strip_tags($table));
        $name  = htmlspecialchars(strip_tags($name));

        $res = $this->query("SELECT * FROM $table WHERE $table = '$name'");

        return $res;
    }


}
?>