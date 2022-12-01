<?php

header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Credentials: true");

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
    $found = $reader->readOne();
    if ($found != null) {
        $result = array(
            "id" => $found[0],
            "name" => $found[1],
            "book" => $found[2]
        );
        http_response_code(200);
        echo json_encode($result);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Читатель с таким ID не существует"));
    }
}
