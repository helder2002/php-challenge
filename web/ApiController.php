<?php
/**
 * Created by IntelliJ IDEA.
 * User: Helder
 * Date: 11/10/2019
 * Time: 23:39
 */

include_once 'Read.php';
include_once 'Create.php';
include_once 'Update.php';
include_once 'Delete.php';
class ApiController
{
    private $requestMethod;
    private $employeeID;
    private $employeeName;
    public function __construct($requestMethod,$employeeID,$employeeName)
    {
        $this->requestMethod = $requestMethod;
        $this->employeeID = $employeeID;
        $this->employeeName = $employeeName;
    }

    public function handleRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->employeeID) {
                    $response = $this->getEmployeeByID($this->employeeID);
                }
                elseif ($this->employeeName)
                {
                    $response = $this->getEmployeeByName($this->employeeName);
                }
                else {
                    $response = $this->getAllEmployees();
                };
                break;
            case 'POST':
                $response = $this->createEmployee();
                break;
            case 'PUT':
                $response = $this->updateEmployee();
                break;
            case 'DELETE':
                $response = $this->deleteEmployee();
                break;
            default:
                $response = $this->errorRequest();
                break;
        }
        if ($response) {
            echo $response;
        }
    }

    private function getEmployeeByID($employeeId)
    {
        $read = new Read();
        return $read->ReadById($employeeId);
    }

    private function getEmployeeByName($employeeId)
    {
        $read = new Read();
        return $read->ReadByName($employeeId);
    }

    private function getAllEmployees()
    {
        $read = new Read();
        return $read->ReadAll();
    }

    private function createEmployee()
    {
        $newEmp = (array) json_decode(file_get_contents('php://input'), TRUE);

        $create = new Create();
        return $create->createEmployee($newEmp);
    }

    private function updateEmployee()
    {
        $updateEmp = (array) json_decode(file_get_contents('php://input'), TRUE);

        $update = new Update();
        return $update->updateEmployee($updateEmp);
    }

    private function deleteEmployee()
    {
        $deleteEmp = (array) json_decode(file_get_contents('php://input'), TRUE);

        $delete = new Delete();
        return $delete->deleteEmployee($deleteEmp);
    }
}