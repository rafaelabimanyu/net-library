<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuideController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        return view('guide.index', compact('role'));
    }
}
