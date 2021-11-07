<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index(Request $request) {
        return view('main.witaj', ['przepisy' => []]);
    }

    public function login() {
        return view('main.witaj', ['przepisy' => [], 'showLogin' => true]);
    }

}