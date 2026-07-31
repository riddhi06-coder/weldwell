<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;


class EventsController extends Controller
{

    public function index()
    {
        return view('backend.events.index');
    }

    public function create()
    {
        return view('backend.events.create');
    }

}