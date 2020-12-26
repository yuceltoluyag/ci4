<?php namespace App\Controllers;

class Dashboard extends BaseController
{

    public $viewFolder = "";
    public function __construct()
    {
        $this->viewFolder = "dashboard_v";

    }
    public function index()
	{
        $viewData['viewFolder'] = $this->viewFolder;
        $viewData['subViewFolder'] = "";
        return view("$viewData[viewFolder]/$viewData[subViewFolder]/index", $viewData);
	}

	//--------------------------------------------------------------------

}
