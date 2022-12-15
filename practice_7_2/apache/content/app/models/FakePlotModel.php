<?php
require_once 'vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

class FakePlotModel extends Model {
    static $imageFolder = "resources/images";

    function draw_plot_bar($creditCardNum)
    {
        $__width = 400;
        $__height = 300;
        $graph = new Graph\Graph($__width, $__height, 'auto');
        $graph->SetShadow();
        $graph->title->Set("Bank is");
        $graph->title->SetFont(FF_FONT1, FS_BOLD);

        $labels_and_values = $creditCardNum;
        $labels = $labels_and_values["labels"];
        $values = $labels_and_values["values"];

        $databary = $values;
        $graph->SetScale('textlin');
        $graph->xaxis->SetTickLabels($labels);
        $graph->title->Set($_GET['property']);
        $graph->title->SetFont(FF_FONT1, FS_BOLD);
        $b1 = new Plot\BarPlot($databary);
        $b1->SetLegend($_GET['property']);
        $graph->Add($b1);
        $graph->Stroke(self::$imageFolder.'/plot_bar.png');
    }

    function draw_plot_pie($monthCount)
    {
        $graph = new Graph\PieGraph(400, 300);
        $graph->title->Set("Month choice");
        $graph->title->SetFont(FF_FONT1, FS_BOLD);
        $graph->SetBox(true);

        $labels_and_values = $monthCount;
        $labels = $labels_and_values["labels"];
        $values = $labels_and_values["values"];

        $p1 = new Plot\PiePlot($values);
        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetLabels($labels);
        $graph->Add($p1);
        $graph->Stroke(self::$imageFolder.'/plot_pie.png');
    }

    function draw_plot_scatter($dayColorType)
    {
        $data = $dayColorType;
        $datax = $data["month"];
        $datay = $data["color"];

        $__width = 400;
        $__height = 300;
        $graph = new Graph\Graph($__width, $__height);
        $graph->SetScale('linlin');

        $graph->img->SetMargin(40, 40, 40, 40);
        $graph->SetShadow();

        $graph->title->Set('Blood and Day');
        $graph->title->SetFont(FF_FONT1, FS_BOLD);


        $sp1 = new Plot\ScatterPlot($datay, $datax);
        $sp1->mark->SetType(MARK_FILLEDCIRCLE);
        $sp1->mark->SetFillColor("#ff8800");
        $sp1->mark->SetWidth(8);

        $graph->Add($sp1);
        $graph->Stroke(self::$imageFolder.'/plot_scatter.png');
    }
}