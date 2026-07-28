<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CompanyStat;
use App\Models\HomeAbout;
use App\Models\HomeBanner;
use App\Models\HomeClient;
use App\Models\HomeConnection;
use App\Models\HomeEvent;
use App\Models\HomeKnowledgeSpectrum;
use App\Models\MainCategory;
use App\Models\ProductIntro;
use App\Models\TestimonyIntro;

class HomeController extends Controller
{
    /**
     * Fetch every active Home-page section (single record each) plus the
     * header brand categories, and hand them to the frontend home view.
     */
    public function index()
    {
        $data = [
            'banner'         => HomeBanner::where('is_active', true)->first(),
            'productIntro'   => ProductIntro::where('is_active', true)->with('qualities')->first(),
            'companyStats'   => CompanyStat::where('is_active', true)->with('items')->first(),
            'about'          => HomeAbout::where('is_active', true)->first(),
            'clients'        => HomeClient::where('is_active', true)->with('photos')->first(),
            'testimony'      => TestimonyIntro::where('is_active', true)->with('sliders')->first(),
            'knowledge'      => HomeKnowledgeSpectrum::where('is_active', true)->first(),
            'connection'     => HomeConnection::where('is_active', true)->first(),
            'event'          => HomeEvent::where('is_active', true)->first(),

            // Brand categories flagged for the site headers.
            'brandHeaderCategories'   => MainCategory::where('show_in_brand_header', true)->orderBy('name')->get(),
            'productHeaderCategories' => MainCategory::where('show_in_product_header', true)->orderBy('name')->get(),
        ];

        return view('frontend.index', $data);
    }
}
