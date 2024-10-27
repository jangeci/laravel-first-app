<?php

namespace App\Http\Controllers;

use App\Models\Multipic;
use Illuminate\Http\Request;

class PortfolioScreenController extends Controller
{
    public function index()
    {
        $images = Multipic::all();
        return view('screens.portfolio', compact('images'));
    }
}
