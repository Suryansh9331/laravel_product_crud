<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller; // ✅ Ensure Correct Parent Class
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // ✅ Now it will work
    }

    public function index()
    {
        return view('home');
    }
}
