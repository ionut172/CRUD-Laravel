<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use App\Models\Home;

class HomeController extends Controller
{
    public function index(Request $request)
    {

     $verificare=Home::latest()->paginate(5);
     //var_dump ($verificare);
     return view('home.index', compact('verificare') );
    }
}
