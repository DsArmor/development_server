<?php

class Reader {
    private ?mysqli $conn;

    public int $id;
    public ?string $name;
    public ?string $book;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "
        SELECT s.id, s.name, s.book FROM student AS s
        ORDER BY s.id; 
        ";

        $stmt = $this->conn->query($query);
        return $stmt;
    }

    function create() {
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->book = htmlspecialchars(strip_tags($this->book));

        $query = "INSERT INTO student(name, book) VALUE ('".$this->name."', '".$this->book."');";

        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function update() {
        $query = "
            UPDATE student 
            SET name = '".$this->name."', book = '".$this->book."' 
            WHERE id = ".$this->id.";
            ";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function delete() {
        $query = "DELETE FROM student WHERE id = ".$this->id.";";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function readOne() {
        $query = "SELECT s.id, s.name, s.book FROM student AS s WHERE s.id = ".$this->id.";";
        $result = $this->conn->query($query)->fetch_row();
        return $result;
    }
}