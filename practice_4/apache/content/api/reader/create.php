<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../database.php";

include_once "../model/reader.php";

$database = new Database();
$db = $database->getConnection();
$reader = new Reader($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->name) &&
    !empty($data->book)
) {
    $reader->name = $data->name;
    $reader->book = $data->book;

    $stmt = $reader->create();

    if ($stmt) {
        http_response_code(201);
        echo json_encode(array("message" => "Читатель добавлен"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно добавить читателя"), JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно добавить читателя: данные неполные"), JSON_UNESCAPED_UNICODE);
}

