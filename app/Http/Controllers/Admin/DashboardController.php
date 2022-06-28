<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;

class DashboardController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index(){
        $title = __("Dashboard");
        $company = $this->company;
        return view("admin.dashboard.index", compact('title', 'company'));
    }
}
