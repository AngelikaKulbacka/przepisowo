<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyRecipesController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $przepisy = $user->recepies??[];
        return view('przepis.moje', ['przepisy' => $przepisy]);
    }

}
