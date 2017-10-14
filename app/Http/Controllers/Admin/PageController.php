<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function __construct()
    {
        View::share('page','admin');
    }

    public function showNgGeneral()
    {   
        return view('pages.admin.general');
    }

    public function ngTemplate($name)
    {
        $view = 'pages.admin.templates.'.$name;
        if (View::exists($view)) {
            return view($view);
        }
    }




}