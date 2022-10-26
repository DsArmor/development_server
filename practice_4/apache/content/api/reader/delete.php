<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../database.php";

include_once "../model/reader.php";


$database = new Database();
$db = $database->getConnection();

$reader = new Reader($db);

if (!isset($_GET["id"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Неправильный запрос: не указан ID студента"));
} else {
    $reader->id = $_GET["id"];
    $stmt = $reader->delete();
    if ($stmt) {
        http_response_code(200);
        echo json_encode(array("message" => "Читатель удалён"));
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Читатель с таким ID не существует"));
    }
}