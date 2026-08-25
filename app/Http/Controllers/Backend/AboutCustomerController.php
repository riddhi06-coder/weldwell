<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutIntro;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class AboutCustomerController extends Controller
{
    public function index()
    {
        return view('backend.about.customers.index');
    }

    public function create()
    {
        return view('backend.about.customers.create');
    }
}