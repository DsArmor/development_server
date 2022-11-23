<?php

header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../database.php";

include_once "../model/book.php";

$database = new Database();
$db = $database->getConnection();

$book = new Book($db);

$query_result = $book->read();

$result = array("results" => array());
foreach ($query_result as $book) {
    $courses_obj = array(
        "id" => $book["id"],
        "name" => $book["name"],
        "author" => $book["author"]
    );
    $result["results"][] = $courses_obj;
}

http_response_code(200);
echo json_encode($result);