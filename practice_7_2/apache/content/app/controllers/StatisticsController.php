<?php
require_once "app/models/FakeDataModel.php";
require_once "app/models/FakePlotModel.php";
require_once "app/models/WatermarkModel.php";

class StatisticsController extends Controller {

    private FakeDataModel $fakerDataModel;
    private FakePlotModel $fakePlotModel;
    private WatermarkModel $watermarkModel;

    function __construct()
    {
        parent::__construct();
        $this->fakerDataModel = new FakeDataModel();
        $this->fakePlotModel = new FakePlotModel();
        $this->watermarkModel = new WatermarkModel();
    }

    function index() {
        $this->fakerDataModel->generateData();
        $data = $this->fakerDataModel->getRawData();
        $creditCardNum = $this->fakerDataModel->getCreditCardNum($data);
        $monthCount = $this->fakerDataModel->getMonthCount($data);
        $dayColorType = $this->fakerDataModel->getDayColorTuple();
        $this->fakePlotModel->draw_plot_pie($monthCount);
        $this->fakePlotModel->draw_plot_bar($creditCardNum);
        $this->fakePlotModel->draw_plot_scatter($dayColorType);

        $images = array("plot_pie.png", "plot_bar.png", "plot_scatter.png");
        foreach ($images as $image) {
            $this->watermarkModel->addWatermark($image);
        }

        $this->view->generate("StatisticsView.php", $data);
    }
}