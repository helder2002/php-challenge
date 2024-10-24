<?php
/**
 * Created by IntelliJ IDEA.
 * User: Helder
 * Date: 12/10/2019
 * Time: 00:27
 */

include_once 'Utils/DB.php';
class Create
{
    function __construct() {

    }

    public function createEmployee($user)
    {
        $con = new DB();
        $db = $con->connect();
        if(!$db)//If DB has not connected successfully just return
        {
            return;
        }
        if( !isset($user['name']) || !isset($user['last_name']) )
        {
            return json_encode("Incorrect json format");
        }
        $param_array = array('name' => $user['name'],'last_name'=> $user['last_name']);
        $result = $con->exeQuery("INSERT INTO mydb.employees ( employee_id,last_name,first_name ) VALUES ( (select COALESCE(max(employee_id),0)+1 from employees),:last_name,:name ) returning employee_id",$param_array);
        ////echo json_encode($result);

        $employee = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){

            array_push($employee,$row);
        }

        $result->closeCursor();
        $db = null;
        if(empty($employee))
        {
            return json_encode("Employee was not created");
        }

        return json_encode($employee);
    }
}