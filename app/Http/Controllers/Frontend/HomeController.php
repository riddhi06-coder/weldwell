<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutCustomer;
use App\Models\AboutIntro;
use App\Models\AboutQuality;
use App\Models\CompanyStat;
use App\Models\Contact;
use App\Models\Event;
use App\Models\HomeAbout;
use App\Models\HomeBanner;
use App\Models\HomeClient;
use App\Models\HomeConnection;
use App\Models\HomeEvent;
use App\Models\HomeKnowledgeSpectrum;
use App\Models\MainCategory;
use App\Models\ProductCategory;
use App\Models\ProductCategoryDetail;
use App\Models\ProductIntro;
use App\Models\Testimonial;
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
            'testimonials'   => Testimonial::where('is_active', true)->orderByDesc('id')->get(),
            'knowledge'      => HomeKnowledgeSpectrum::where('is_active', true)->first(),
            'connection'     => HomeConnection::where('is_active', true)->first(),
            'event'          => HomeEvent::where('is_active', true)->first(),
            'events'         => Event::where('is_active', true)->orderByDesc('id')->get(),

            // Header menus: brand categories and product categories.
            'brandHeaderCategories'   => MainCategory::where('is_active', true)->orderBy('name')->get(),
            'productHeaderCategories' => ProductCategory::where('is_active', true)->with('activeDetail')->orderBy('id')->get(),
        ];

        return view('frontend.index', $data);
    }

    public function about_us()
    {
        $data = [
            'intro'      => AboutIntro::where('is_active', true)->with('visions')->first(),
            'quality'    => AboutQuality::where('is_active', true)->with('values')->first(),
            'customer'   => AboutCustomer::where('is_active', true)->with(['features', 'highlights'])->first(),
            'connection' => HomeConnection::where('is_active', true)->first(),

            'productHeaderCategories' => ProductCategory::where('is_active', true)->orderBy('id')->get(),
        ];

        return view('frontend.about_us', $data);
    }

    /**
     * Product category detail page — fetch the active detail (with its features
     * and industries) for the given product category slug.
     */
    public function product_category_details($slug)
    {
        $category = ProductCategory::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $detail = ProductCategoryDetail::where('product_category_id', $category->id)
            ->where('is_active', true)
            ->with(['features', 'industries'])
            ->first();

        // Global marquee highlights — same source the About Us page uses.
        $customer = AboutCustomer::where('is_active', true)->with('highlights')->first();

        return view('frontend.product_category_details', compact('category', 'detail', 'customer'));
    }

    /**
     * Contact page — the single contact-details record (with offices) plus the
     * global marquee highlights from About Customer.
     */
    public function contact_us()
    {
        $contact  = Contact::where('is_active', true)->with(['socials', 'offices'])->first();
        $customer = AboutCustomer::where('is_active', true)->with('highlights')->first();

        return view('frontend.contact_us', compact('contact', 'customer'));
    }
}
