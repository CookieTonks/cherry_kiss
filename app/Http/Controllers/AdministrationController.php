<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public function Home()
    {
        return view('administration.home');
    }
}
