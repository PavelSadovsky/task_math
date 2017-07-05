<?php

if ( !defined('SITE_PATH') )
{
    define('SITE_PATH', dirname(dirname(__FILE__)) . '/');
}

require_once SITE_PATH . 'libs/functions.php';


class Talk extends Mysql
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

        $a['talk'] = $this->get_all_full();
        return $a;
    }

    public function add($params = array())
    {
        $a = array();

        $a['country']  = $this->get_all_country();
        $a['city']     = $this->get_all_city();
        $a['language'] = $this->get_all_language();
        return $a;
    }

    public function delete($params = array())
    {

        $a = array();

        $id = (int)$params['id'];

        if ( !empty($id) )
        {
            $res = $this->query_dml("DELETE FROM talk WHERE id = $id");

            if ($res)
            {
                header('Location: /?page=talk&success=delete_correct');
                die();
            }
        }
        else
        {
            header('Location: /?page=talk&error=empty_id_from_del');
            die();
        }
    }


   private function get_all()
    {
        $all = $this->query("SELECT * FROM talk");
        return $all;
    }

    private function get_all_full()
    {
        $all = $this->query("SELECT t.id, c.country, ci.city, l.language FROM talk t 
                                    LEFT JOIN country c  ON t.id_country = c.id_country
                                    LEFT JOIN city ci  	 ON t.id_city = ci.id_city
                                    LEFT JOIN language l ON t.id_language = l.id_language 
                                    ORDER BY 2 DESC,3 DESC,4 DESC");
        return $all;
    }

    private function get_all_country()
    {
        $res = $this->query("SELECT * FROM country");
        return $res;
    }

    private function get_all_city()
    {
        $res = $this->query("SELECT id_city,city FROM city");
        return $res;
    }
    private function get_all_language()
    {
        $res = $this->query("SELECT * FROM language");
        return $res;
    }

    public function add_talk($params = array())
    {
        $id_country  = (int)$params['id_country'];
        $id_city     = (int)$params['id_city'];
        $id_language = (int)$params['id_language'];

        $a = array();

        if ( !empty($id_country) and !empty($id_city) and !empty($id_language) )
        {
            $check = $this->check_in_table($id_country, $id_city, $id_language);
            if( !$check )
            {
                $res = $this->query_dml("INSERT INTO talk(id_country, id_city, id_language) VALUES('$id_country', '$id_city', '$id_language')");

                if ($res)
                {
                    header('Location: /?page=talk&success=insert_correct');
                    die();
                }
            }
            else
            {
                header('Location: /?page=talk&action=add&error=language_exist');
                die();
            }

        }
        else
        {
            header('Location: /?page=talk&action=add&error=data_error');
            die();
        }
    }



    public function edit_save_talk( $params = array() )
    {
        $a = array();


        if( !empty($params['id_country']) AND !empty($params['id_city']) AND !empty($params['id_language']) )
        {
            $id_country  = (int)$params['id_country'];
            $id_city     = (int)$params['id_city'];
            $id_language = (int)$params['id_language'];
            $id_talk     = (int)$params['id_talk'];

            $check = $this->query("SELECT * FROM talk WHERE id = '$id_talk' AND id_country = '$id_country' AND id_city = '$id_city' AND id_language = '$id_language'");
            if( !$check )
            {
                $res = $this->query_dml("UPDATE talk SET id_country = '{$params['id_country']}', id_city = {$params['id_city']} , id_language = {$params['id_language']} WHERE id = {$params['id_talk']}");

                if( $res )
                {
                    header('Location: /?page=talk&success=insert_correct');
                    die();
                }
                return $a;
            }
            else
            {
                header("Location: /?page=talk&action=edit&id_talk={$id_talk}&error=language_exist");
                die();
            }

        }
    }


    public function edit($params = array())
    {
        $a = array();
        $get_talk = $this->get_talk($params['id_talk']);

        $all_country = $this->get_all_country();
        $all_city    = $this->get_city_on_country($get_talk['id_country']);
        $all_language = $this->get_all_language();

        foreach($all_country as $key => $value)
        {
            if( $value['id_country'] == $get_talk['id_country'] )
            {
                $all_country[$key]['selected'] .= "selected";
            }
        }
        $a['all_country'] = $all_country;

        foreach($all_city as $key => $value)
        {
            if( $value['id_city'] == $get_talk['id_city'] )
            {
                $all_city[$key]['selected'] .= "selected";
            }
        }
        $a['all_city'] = $all_city;

        foreach($all_language as $key => $value)
        {
            if( $value['id_language'] == $get_talk['id_language'] )
            {
                $all_language[$key]['selected'] .= "selected";
            }
        }
        $a['all_language'] = $all_language;

        $a['id_talk'] = $params['id_talk'];

        return $a;
    }

    private function get_talk($id_talk = "")
    {
        if ( !empty($id_talk) )
        {
            $res = $this->query("SELECT id_country, id_city, id_language FROM talk WHERE id = $id_talk");
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

    public function ajax_return_city($params = "")
    {
        if( !empty($params['id_country']) )
        {
            $city = $this->query("SELECT id_city,city FROM city WHERE id_country = '{$params['id_country']}'");
        }
        //pr($city);
        echo json_encode($city);
        die;

    }

    private function get_city_on_country( $id_country="" )
    {
        if ( !empty($id_country) )
        {
            $cities = $this->query("SELECT id_city,city FROM city WHERE id_country = '$id_country'");
        }
        return $cities;
    }

    private function check_in_table( $id_country, $id_city, $id_language )
    {
        $id_country  = (int)$id_country;
        $id_city     = (int)$id_city;
        $id_language = (int)$id_language;

        $res = $this->query("SELECT * FROM talk WHERE id_country = '$id_country' AND id_city = '$id_city' AND id_language = '$id_language'");
        return $res;
    }

}

?>