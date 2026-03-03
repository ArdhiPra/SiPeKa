<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

class TentangController extends Controller
{
    public function index()
    {
        return view('tentang');
    }
}
