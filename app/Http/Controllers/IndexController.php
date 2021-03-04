<?php

namespace App\Http\Controllers;
use App\Models\Moneda;
use Illuminate\Http\Request;

class IndexController extends Controller
{
     function index(){
        
         $monedas = Moneda::all();
         return view('moneda/index', ['monedas' => $monedas]);
    }
}
