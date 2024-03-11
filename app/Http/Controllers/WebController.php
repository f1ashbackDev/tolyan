<?php

namespace App\Http\Controllers;

use App\Models\Catalogs;
use App\Models\Products;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        return view('index',[
            'products' => Products::all()->take(4)
        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function login()
    {
        return view('user.login');
    }

    public function register()
    {
        return view('user.register');
    }
}
