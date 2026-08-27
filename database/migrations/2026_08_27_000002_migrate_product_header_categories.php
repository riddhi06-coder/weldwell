<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Move the brand-category rows flagged as "product header" into the new
     * product_categories table. Product-only rows are soft-deleted from
     * brand_categories; rows flagged for BOTH headers are left in brand too.
     */
    public function up(): void
    {
        $brandDir   = public_path('brand/category');
        $productDir = public_path('product/category');

        if (! is_dir($productDir)) {
            @mkdir($productDir, 0755, true);
        }

        $rows = DB::table('brand_categories')
            ->where('show_in_product_header', 1)
            ->whereNull('deleted_at')
            ->get();

        foreach ($rows as $row) {
            // Copy the physical image so the two modules don't share a file.
            $image = $row->image;
            if ($image && file_exists($brandDir . '/' . $image) && ! file_exists($productDir . '/' . $image)) {
                @copy($brandDir . '/' . $image, $productDir . '/' . $image);
            }

            $slug = $this->uniqueSlug($row->name ?: 'product-category');

            DB::table('product_categories')->insert([
                'name'       => $row->name,
                'title'      => $row->title ?? null,
                'image'      => $image,
                'slug'       => $slug,
                'is_active'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Product-only rows (product header on, brand header off) leave the brand table.
        DB::table('brand_categories')
            ->where('show_in_product_header', 1)
            ->where('show_in_brand_header', 0)
            ->whereNull('deleted_at')
            ->update(['deleted_at' => now()]);
    }

    public function down(): void
    {
        // Best-effort: clear the migrated product categories. Brand rows were only
        // soft-deleted, so no destructive restore is attempted here.
        DB::table('product_categories')->delete();
    }

    private function uniqueSlug(string $source): string
    {
        $base = Str::slug($source);
        if ($base === '') {
            $base = 'product-category-' . uniqid();
        }

        $slug = $base;
        $i    = 1;
        while (DB::table('product_categories')->where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
};
