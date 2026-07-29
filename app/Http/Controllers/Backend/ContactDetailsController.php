<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeAbout;
use Illuminate\Http\Request;

class ContactDetailsController extends Controller
{

    public function index()
    {
        return view('backend.contact.index');
    }

    public function create()
    {
        return view('backend.contact.create');
    }

}