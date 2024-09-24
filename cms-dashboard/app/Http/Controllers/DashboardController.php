<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $menuName = "Dashboard";
    public function index(){
        $breadcrumbs = [
            ['url' => route('dashboard'), 'label' => 'Dashboard']
        ];
        return view('dashboard.index', ['breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }
}
