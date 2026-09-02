<?php

namespace Database\Seeders;

use App\Models\ProductCategoryDetail;
use Illuminate\Database\Seeder;

class ProductCategoryDetailSeeder extends Seeder
{
    /**
     * Seed detail pages for the product categories that don't have one yet
     * (Additive Manufacturing, Welding Equipments, Special Products).
     *
     * Mirrors the SEO content pattern of the already-filled Welding Consumables
     * and Thermal Spray records. Images are intentionally left null — to be
     * uploaded from the admin panel later.
     */
    public function run(): void
    {
        foreach ($this->details() as $data) {
            $features   = $data['features'];
            $industries = $data['industries'];
            unset($data['features'], $data['industries']);

            // Idempotent: one detail per category (matches the unique constraint).
            $detail = ProductCategoryDetail::updateOrCreate(
                ['product_category_id' => $data['product_category_id']],
                $data
            );

            $detail->features()->delete();
            foreach ($features as $i => $f) {
                $detail->features()->create([
                    'number'      => $f[0],
                    'description' => $f[1],
                    'sort_order'  => $i,
                ]);
            }

            $detail->industries()->delete();
            foreach ($industries as $i => $name) {
                $detail->industries()->create([
                    'name'       => $name,
                    'sort_order' => $i,
                ]);
            }
        }
    }

    private function details(): array
    {
        return [

            // ==================== 3 · Additive Manufacturing ====================
            [
                'product_category_id'   => 3,
                'banner_image'          => null,
                'banner_description'    => 'From LPBF, EB-PBF and DED metal powders to precision additive manufacturing wires — engineered feedstock that delivers dense, defect-free builds and repeatable mechanical performance.',
                'section_heading'       => 'Our Products',
                'section_image'         => null,
                'section_description'   => '<p>Weldwell Speciality Pvt. Ltd. has been engineering advanced metal joining and deposition solutions since 1991. We partner with globally recognized brands to bring precision-grade additive manufacturing powders and wires to Indian industry. Our range is qualified for Laser Powder Bed Fusion (LPBF), Electron Beam Powder Bed Fusion (EB-PBF) and Directed Energy Deposition (DED) processes.</p><p>Metal additive manufacturing builds fully dense components layer by layer, giving design freedom for lightweight structures, complex geometries and near-net-shape repair. Every batch is characterized for particle morphology, flowability and chemistry so your builds stay consistent from prototype to production.</p>',
                'product_range_title'   => 'Our Product Range',
                'product_range_heading' => 'Metal Powders & Wires for Laser, Electron-Beam and DED Additive Manufacturing',
                'knowledge_title'       => 'Knowledge Spectrum',
                'knowledge_heading'     => 'Explore Technical Knowledge, Material Data & Additive Manufacturing Best Practices from Weldwell',
                'knowledge_description' => '<p>Discover technical insights into additive manufacturing materials, powder morphology and flow, wire and powder selection, deposition parameters, post-processing and repair applications across emerging metal manufacturing technologies.</p>',
                'knowledge_background_image' => null,
                'knowledge_certificate' => null,
                'knowledge_brochure'    => null,
                'knowledge_map_url'     => null,
                'industries_title'      => 'Where Additive Manufacturing Delivers',
                'industries_heading'    => 'Industries We Serve',
                'media_title'           => 'See It In Action',
                'media_heading'         => 'How Metal Additive Manufacturing Builds Parts Layer by Layer',
                'media_description'     => '<p>A look at how metal powders and wires are fused, layer by layer, to build dense, high-performance components and restore critical parts with additive manufacturing.</p>',
                'media_youtube_url'     => 'https://www.youtube.com/embed/GrmiCh5v83s',
                'is_active'             => true,
                'features'              => [
                    ['30+', 'Years supplying advanced metal manufacturing materials'],
                    ['100%', 'Batch-characterized powders & wires for AM'],
                    ['360°', 'Application support, from material selection to build'],
                ],
                'industries'            => [
                    'Aerospace', 'Defence', 'Tool & Die', 'Medical & Dental',
                    'Automotive', 'Oil & Gas', 'Power Generation', 'Research & Academia',
                ],
            ],

            // ==================== 4 · Welding Equipments ====================
            [
                'product_category_id'   => 4,
                'banner_image'          => null,
                'banner_description'    => 'From Panasonic and Kemppi welding power sources to plasma cutting, purging accessories and genuine spares — welding equipment engineered for precision, uptime and repeatable weld quality.',
                'section_heading'       => 'Our Products',
                'section_image'         => null,
                'section_description'   => '<p>Weldwell Speciality Pvt. Ltd. has been equipping Indian industry with reliable welding and cutting solutions since 1991. We partner with globally recognized brands such as Panasonic, Kemppi and Hypertherm to bring precision welding power sources, plasma cutting systems and application accessories to fabricators and maintenance teams.</p><p>The right equipment is what turns quality consumables into consistent, high-integrity welds. Our range covers automated and manual welding processes, plasma cutting, purging accessories and a full inventory of genuine spares — all backed by hands-on commissioning and after-sales support.</p>',
                'product_range_title'   => 'Our Product Range',
                'product_range_heading' => 'Welding Power Sources, Plasma Cutting & Accessories for Every Application',
                'knowledge_title'       => 'Knowledge Spectrum',
                'knowledge_heading'     => 'Explore Technical Knowledge, Equipment Insights & Welding Best Practices from Weldwell',
                'knowledge_description' => '<p>Discover technical insights into welding process selection, power source setup, plasma cutting parameters, purging techniques and preventive maintenance that keep your equipment running at peak performance.</p>',
                'knowledge_background_image' => null,
                'knowledge_certificate' => null,
                'knowledge_brochure'    => null,
                'knowledge_map_url'     => null,
                'industries_title'      => 'Where Our Equipment Works',
                'industries_heading'    => 'Industries We Serve',
                'media_title'           => 'See It In Action',
                'media_heading'         => 'Precision, Control & Uptime in Every Weld',
                'media_description'     => '<p>From power sources and plasma cutting to purging and genuine spares — see how the right welding equipment delivers precision, control and reliable uptime on the shop floor.</p>',
                'media_youtube_url'     => 'https://www.youtube.com/embed/GrmiCh5v83s',
                'is_active'             => true,
                'features'              => [
                    ['30+', 'Years supplying welding & cutting equipment'],
                    ['100%', 'Genuine, warranty-backed power sources & spares'],
                    ['360°', 'Support, from commissioning to preventive maintenance'],
                ],
                'industries'            => [
                    'Heavy Fabrication', 'Automotive', 'Marine & Shipbuilding', 'Railways',
                    'Power Generation', 'Oil & Gas', 'Construction', 'General Engineering',
                ],
            ],

            // ==================== 5 · Special Products ====================
            [
                'product_category_id'   => 5,
                'banner_image'          => null,
                'banner_description'    => 'From one-side welding aids and brazing products to purging equipment and fully customised solutions — specialty welding products engineered for the joints and applications standard consumables can\'t reach.',
                'section_heading'       => 'Our Products',
                'section_image'         => null,
                'section_description'   => '<p>Weldwell Speciality Pvt. Ltd. has been solving difficult welding and joining challenges for Indian industry since 1991. Our special products range brings together one-side welding aids, brazing products, purging accessories and miscellaneous consumables — together with fully customised solutions engineered around your specific application.</p><p>When a standard consumable or process won\'t do, our engineering team works with you to specify, source or develop the right answer. Every specialty product is selected to improve joint integrity, reduce rework and simplify demanding welding operations.</p>',
                'product_range_title'   => 'Our Product Range',
                'product_range_heading' => 'Specialty Welding Aids, Brazing & Customised Solutions',
                'knowledge_title'       => 'Knowledge Spectrum',
                'knowledge_heading'     => 'Explore Technical Knowledge, Application Insights & Specialty Welding Best Practices from Weldwell',
                'knowledge_description' => '<p>Discover technical insights into one-side welding, brazing metallurgy, root purging, and customised joining solutions engineered to solve demanding, application-specific welding challenges.</p>',
                'knowledge_background_image' => null,
                'knowledge_certificate' => null,
                'knowledge_brochure'    => null,
                'knowledge_map_url'     => null,
                'industries_title'      => 'Where Our Specialty Products Are Used',
                'industries_heading'    => 'Industries We Serve',
                'media_title'           => 'See It In Action',
                'media_heading'         => 'Engineered Solutions for Demanding Welding Challenges',
                'media_description'     => '<p>From one-side welding aids and brazing to root purging and customised solutions — see how specialty products solve the joints and applications standard consumables can\'t handle.</p>',
                'media_youtube_url'     => 'https://www.youtube.com/embed/GrmiCh5v83s',
                'is_active'             => true,
                'features'              => [
                    ['30+', 'Years solving specialty welding & joining challenges'],
                    ['100%', 'Application-matched specialty consumables'],
                    ['360°', 'Support, from problem analysis to customised solution'],
                ],
                'industries'            => [
                    'Oil & Gas', 'Power Generation', 'Petrochemical', 'Pharmaceutical',
                    'Food & Dairy', 'Aerospace', 'Heavy Fabrication', 'Marine & Shipbuilding',
                ],
            ],

        ];
    }
}
