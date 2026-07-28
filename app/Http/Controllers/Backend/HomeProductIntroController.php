<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;


class HomeProductIntroController extends Controller
{
    public function index()
    {
        return view('backend.home.product_intro.index');
    }

    public function create()
    {
        return view('backend.home.product_intro.create');
    }

}