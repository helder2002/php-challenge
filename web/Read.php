<?php
/**
 * Created by IntelliJ IDEA.
 * User: Helder
 * Date: 08/10/2019
 * Time: 22:41
 */
include_once 'Utils/DB.php';
class Read
{
    function __construct() {

    }
    public function ReadById($id)
    {
        $con = new DB();
        $db = $con->connect();
        if(!$db)//If DB has not connected successfully just return
        {
            return;
        }

        $param_array = array('id' => $id);
        $result = $con->exeQuery("select e.employee_id,e.first_name, e.last_name from employees e where e.employee_id =:id",$param_array);

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

    public function ReadByName($name)
    {
        $con = new DB();
        $db = $con->connect();
        if(!$db)//If DB has not connected successfully just return
        {
            return;
        }

        $param_array = array('name' => $name);
        $result = $con->exeQuery("select e.employee_id,e.first_name, e.last_name from employees e where e.first_name ilike :name or e.last_name ilike :name ",$param_array);

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

    public function ReadAll()
    {
        $con = new DB();
        $db = $con->connect();
        if(!$db)//If DB has not connected successfully just return
        {
            return;
        }

        $result = $con->exeQuery("select e.employee_id,e.first_name, e.last_name from employees e ",null);
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