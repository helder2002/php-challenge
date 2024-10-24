<?php
/**
 * Created by IntelliJ IDEA.
 * User: Helder
 * Date: 12/10/2019
 * Time: 00:32
 */

include_once 'Utils/DB.php';
class Update
{
    function __construct() {

    }

    public function updateEmployee($user)
    {
        $con = new DB();
        $db = $con->connect();
        if(!$db)//If DB has not connected successfully just return
        {
            return;
        }

        if( !isset($user['name']) || !isset($user['last_name']) || !isset($user['id']) )
        {
            return json_encode("Incorrect json format");
        }

        $param_array = array('name' => $user['name'],'last_name'=> $user['last_name'],'id' => $user['id']);
        $result = $con->exeQuery("UPDATE employees set last_name = :last_name,first_name = :name where employee_id = :id returning employee_id",$param_array);
        ////echo json_encode($result);

        $employee = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){

            array_push($employee,$row);
        }

        $result->closeCursor();
        $db = null;
        if(empty($employee))
        {
            return json_encode("Employee not found");
        }

        return json_encode($employee);
    }
}