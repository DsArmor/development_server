<?php

class Book {
    private ?mysqli $conn;

    public int $id;
    public ?string $name;
    public ?string $author;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "
        SELECT s.id, s.name, s.author FROM book AS s
        ORDER BY s.id; 
        ";

        $stmt = $this->conn->query($query);
        return $stmt;
    }

    function create() {
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->author = htmlspecialchars(strip_tags($this->author));

        $query = "INSERT INTO book(name, author) VALUE ('".$this->name."', '".$this->author."');";

        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function update() {
        $query = "
            UPDATE book 
            SET name = '".$this->name."', author = '".$this->author."' 
            WHERE id = ".$this->id.";
            ";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function delete() {
        $query = "DELETE FROM book WHERE id = ".$this->id.";";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function readOne() {
        $query = "SELECT s.id, s.name, s.author FROM book AS s WHERE s.id = ".$this->id.";";
        $result = $this->conn->query($query)->fetch_row();
        return $result;
    }
}
