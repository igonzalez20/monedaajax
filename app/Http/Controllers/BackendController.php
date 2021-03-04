<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendController extends Controller
{
      function main(){
        return View('backend.index');
    }

    function moneda(){
      return View('backend.moneda.index');
  }
}
