<?php

class Mysql
{
    private $connect           = "";
    private $db_host           = "localhost"; // server name
	private $db_user           = "";          // user name
	private $db_pass           = "";          // password
	private $db_dbname         = "";          // name data base
    private $sql_error         = "";          // info last error in db
    private $charset           = "utf8";      // charset, default = utf8
    private $last_insert_id    = "";


    /**
     * Constructor: Opens the connection to the database
     *
     * @param string $database Database name
     * @param string $server   Host address
     * @param string $username User name
     * @param string $password Password
     */

    public function __construct($database = null, $server = null, $username = null, $password = null, $charset = null)
    {
        if ($database   !== null)   $this->db_dbname  = $database;
        if ($server     !== null)   $this->db_host    = $server;
        if ($username   !== null)   $this->db_user    = $username;
        if ($password   !== null)   $this->db_pass    = $password;
        if ($charset    !== null)   $this->charset    = $charset;

        $this->start();
    }

    public function start()
    {
        if ( !empty($this->connect) )
        {
            return $this->connect;
        }
        else
        {
            $res = $this->connect =  mysqli_connect( $this->db_host, $this->db_user, $this->db_pass, $this->db_dbname );
            $res->set_charset($this->charset);
            return $res;
        }
    }

    /**
     * Used only for DML-query ( INSERT, UPDATE, DELETE )
     *запрос
     * @param  string  $sql, query in sql-format
     * @return mixed
     *      if INSERT return (int) OR FALSE
     * else
     * (boolean) if correct execute OR FALSE
     *
     */
    public function query_dml($sql = "")
    {
        $res = false;

            $res = mysqli_real_query($this->connect, $sql);

            if ( $res )
            {
                if( stristr($sql, 'insert') )
                {
                    $res = mysqli_insert_id($this->connect);
                    $this->last_insert_id = $res;
                }
            }

        if( !$res )
        {
            $this->sql_error = "Invalid SQL request" . mysqli_error($this->connect) . "\n";
        }
        return $res;
    }


    /**
     * Used only for non-DML-query ( SELECT, CREATE, SET )
     *
     * @param  string   $sql, query in sql-format
     * @param  boolean  $single_row, (optional) return first value element of result
     * @param  string  $field, (optional) work only if ON optional #2($single_row)
     * @return mixed associative array OR string depending on option OR FALSE
     */
    public function query($sql = "", $single_row = false, $field = '')
    {
        $res = false;
        $r = false;
        $res = mysqli_query($this->connect,$sql);

        if( !$res )
        {
            $this->sql_error = "Invalid SQL request" . mysqli_error($this->connect) . "\n";
        }

        if( $res == true  )
        {
            while ($array = mysqli_fetch_assoc($res))
            {
                $a_res[] = $array;
            }
            $r = $a_res;

            if( $single_row == true )
            {
                $r = $a_res[0];
                if( $field )
                {
                    $r = $a_res[0][$field];
                }
            }
        }
        return $r;
    }

    /**
     * Return last sql error for current connect
     *
     * @return string or FALSE if not error
     */
    public function get_error()
    {
        return $this->sql_error;
    }

    /**
     * Return last id of insert sql
     *
     * @return int or FALSE
     */
    public function last_insert_id()
    {
        return $this->last_insert_id;
    }
}