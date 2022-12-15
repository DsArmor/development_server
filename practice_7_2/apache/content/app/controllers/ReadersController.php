<?php
require_once "app/models/StudentsModel.php";
require_once "app/models/Database.php";

class ReadersController extends Controller
{
    private Database $db;

    function __construct()
    {
        parent::__construct();
        $this->model = new ReadersModel($this->db->getConnection());
    }

    function index()
    {
        $data = $this->model->read();
        $this->view->generate('ReadersView.php', $data);
    }
}