<?php

header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../database.php";

include_once "../model/reader.php";


$database = new Database();
$db = $database->getConnection();

$reader = new Reader($db);

$query_result = $reader->read();

$result = array("results" => array());
foreach ($query_result as $reader) {
    $students_obj = array(
        "id" => $reader["id"],
        "name" => $reader["name"],
        "book" => $reader["book"]
    );
    $result["results"][] = $students_obj;
}

http_response_code(200);
echo json_encode($result);