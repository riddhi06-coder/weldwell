<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BrandCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MasterBrandController extends Controller
{

    public function index()
    {
        return view('backend.brand.main_category.index');
    }

    public function create()
    {
        return view('backend.brand.main_category.create');
    }

}