<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class WebController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }
}
