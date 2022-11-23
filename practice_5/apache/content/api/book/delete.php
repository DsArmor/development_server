<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../database.php";

include_once "../model/book.php";

$database = new Database();
$db = $database->getConnection();

$book = new Book($db);

if (!isset($_GET["id"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Неправильный запрос: не указан ID курса"));
} else {
    $book->id = $_GET["id"];
    $stmt = $book->delete();
    if ($stmt) {
        http_response_code(200);
        echo json_encode(array("message" => "Книга удалена"));
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Книга с таким ID не существует"));
    }
}