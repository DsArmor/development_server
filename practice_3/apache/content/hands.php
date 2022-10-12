<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Библиотека</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
</head>
<body>
<h1>Взявшие книги</h1>
<ol>
    <?php
    $charset = "utf8";
    $mysqli = new mysqli("db", "root", "example", "appDB");
    mysqli_set_charset($mysqli, $charset);
    $result = $mysqli->query("SELECT * FROM student");
    foreach ($result as $row){
        echo "<li>{$row['book']} {$row['name']}</li>";
    }
    ?>
</ol>
<a href="index.html">На главную</a>
<br>
<a href="admin/admin.php">Админам сюда</a>
</body>
</html>