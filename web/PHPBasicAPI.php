<?php
/**
 * Created by IntelliJ IDEA.
 * User: Helder
 * Date: 09/10/2019
 * Time: 22:22
 */

include_once 'ApiController.php';

///echo json_encode($_SERVER);
$requestMethod = $_SERVER['REQUEST_METHOD'];

$employeeName = null;
$employeeID = null;

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_uri = explode( '/', $request_uri );


if (isset($request_uri[4])) {
    if( is_numeric($request_uri[4])) {
        $employeeID = $request_uri[4];
    }
    else{
        $employeeName = $request_uri[4];
    }
}

$controller = new ApiController($requestMethod,$employeeID,$employeeName);
$controller->handleRequest();