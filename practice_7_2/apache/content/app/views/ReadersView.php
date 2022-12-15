<h1>Список книг</h1>
<ol>
    <?php
    foreach ($data as $row){
        echo "<li>{$row['book']}</li>";
    }
    ?>
</ol>
<a href="../../index.php">На главную</a>
<br>
<a href="../../admin/AdminView.php">Админам сюда</a>