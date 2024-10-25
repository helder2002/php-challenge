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
    private $host = "host = ec2-176-34-237-141.eu-west-1.compute.amazonaws.com";
    private $db_name = "dbname = d1b4oe0cmou81i";
    private $username = "jljbzxjcxicvvn";
    private $password = "f608bcd12574fc48e322dcc08ca5dc6829404f3cb598eb36812439392ad2b4d7";
    private $port = "port= 5432";
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