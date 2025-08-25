<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppSettings extends Controller
{
    public function PagesIndex(){
        return view('admin.app.pages.index');
    }
    public function PagesHome()  {
        return view('admin.app.pages.home');
    }
}
