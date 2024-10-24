<?php
/**
 * Created by IntelliJ IDEA.
 * User: Helder
 * Date: 08/10/2019
 * Time: 21:57
 */

class DB
{
    //DB Credentials
    private $host = "host = ";
    private $db_name = "dbname = ";
    private $username = "";
    private $password = "";
    private $port = "port= 5432";
    private $credentials = "";
    public $conn;

    //Connect to DB
    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO('pgsql:'.$this->host.';'.$this->port.';'.$this->db_name, $this->username, $this->password);
        }
        catch (PDOException $exception)
        {
            echo json_encode("Connection error: ".$exception->errorInfo);
            return;
        }

        return $this->conn;
    }

    public function exeQuery($query,$params)
    {
        if($this->conn != null) {

            $sql = $this->conn->prepare($query);
            $sql->execute($params);
            return $sql;
        }
        else
        {
            echo json_encode("Connection error: ");
            return;
        }
    }
}