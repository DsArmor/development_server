<img src="resources/images/plot_pie.png" alt="plot_1.png">
<img src="resources/images/plot_bar.png" alt="plot_2.png">
<img src="resources/images/plot_scatter.png" alt="plot_3.png">

<table class="table">
    <tr>
        <th>Name</th>
        <th>Emoji</th>
        <th>Color</th>
        <th>Month</th>
        <th>Address</th>
        <th>Credit card</th>
    </tr>
    <?php

    foreach ($data as $data_row) {
        echo "<tr>";
        echo "<td>".$data_row->name."</td>";
        echo "<td>".$data_row->emoji."</td>";
        echo "<td>".$data_row->color."</td>";
        echo "<td>".$data_row->month."</td>";
        echo "<td>".$data_row->address."</td>";
        echo "<td>".$data_row->creditCard."</td>";
        echo "</tr>";
    }
    ?>
</table>