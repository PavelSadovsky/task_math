<?php

if ( !defined('SITE_PATH') )
{
    define('SITE_PATH', dirname(dirname(__FILE__)) . '/');
}

require_once SITE_PATH . 'libs/functions.php';


class Language extends Mysql
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

            $a['language'] = $this->get_all_language();
        return $a;
    }

    public function edit($params = array())
    {
        $a = array();
        $language = $this->get_language($params['id_language']);

        $a["id_language"]    = $language['id_language'];
        $a["language"]       = $language['language'];

        return $a;
    }

    public function edit_save( $params = array() )
    {
        $a = array();
        //pr($params);

        if( !empty($params['id_language']) AND !empty($params['language']) )
        {
            $language = htmlspecialchars(strip_tags( $params['language'] ));

            $strlen = strlen($language);
            if( $strlen <= 32)
            {
                if( correct_name($language) )
                {
                    $check = $this->check_in_table($params['page'],$language);

                    if( !$check )
                    {
                        $res = $this->query_dml("UPDATE language SET language = '$language' WHERE id_language = {$params['id_language']}");

                        if( $res )
                        {
                            header('Location: /?page=language&success=correct_edit_language');
                            die();
                        }
                        return $a;
                    }
                    else
                    {
                        header("Location: /?page=language&action=edit&id_language={$params['id_language']}&error=duplicate_in_the_database");
                        die;
                    }
                }
                else
                {
                    header("Location: /?page=language&action=edit&id_language={$params['id_language']}&error=invalid_char_language");
                    die;
                }

            }
            else
            {
                header("Location: /?page=language&action=edit&id_language={$params['id_language']}&error=exceeding_characters_language");
                die;
            }



        }
    }


    public function delete( $params =array() )
    {
        $a = array();

        if( !empty($params['id_language']) )
        {
            $res = $this->query_dml("DELETE FROM language WHERE id_language = {$params['id_language']}");
            if( $res )
            {
                header('Location: /?page=language&success=delete_language_correct');
                die();
            }
            return $a;
        }
    }

    public function add_language( $params = array() )
    {
        $a = array();

        if( !empty($params['language']) )
        {
            $name_language = htmlspecialchars(strip_tags( $params['language'] ));

            $strlen = strlen($name_language);
            if( $strlen <= 32)
            {
                if( correct_name($name_language) )
                {
                    $check = $this->check_in_table($params['page'],$name_language);
                    if( !$check )
                    {
                        $res = $this->query_dml("INSERT INTO language(language) VALUES('$name_language') ");

                        if( $res )
                        {
                            header('Location: /?page=language&success=correct_add_language');
                            die();
                        }
                    }
                    else
                    {
                        header('Location: /?page=language&action=add&error=duplicate_in_the_database');
                        die();
                    }
                    return $a;
                }
                else
                {
                    header('Location: /?page=language&action=add&error=invalid_char_language');
                    die();
                }

            }
            else
            {
                header('Location: /?page=language&action=add&error=exceeding_characters_language');
                die();
            }

        }
    }


    public function get_all_language()
    {
        $res = $this->query("SELECT * FROM language");
        return $res;
    }

    private function get_language($id_language = "")
    {
        if ( !empty($id_language) )
        {
            $res = $this->query("SELECT id_language, language FROM language WHERE id_language = $id_language");

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