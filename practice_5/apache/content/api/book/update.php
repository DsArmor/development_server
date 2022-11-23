<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../database.php";

include_once "../model/book.php";

$database = new Database();
$db = $database->getConnection();

$book = new Book($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->id) &&
    !empty($data->name) &&
    !empty($data->author)
) {
    $book->id = $data->id;
    $book->name = $data->name;
    $book->author = $data->author;

    $stmt = $book->update();

    if ($stmt) {
        http_response_code(201);
        echo json_encode(array("message" => "Данные книги обновлены"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно обновить данные книги"), JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно обновить данные: данные неполные"), JSON_UNESCAPED_UNICODE);
}

