<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function index()
    {
        $books = DB::table('books')->get();
        return view('catalog', compact('books'));
    }
}
