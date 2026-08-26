<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutCustomer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class AboutCustomerController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:about-customer.view', only: ['index']),
            new Middleware('permission:about-customer.create', only: ['create', 'store']),
            new Middleware('permission:about-customer.edit', only: ['edit', 'update']),
            new Middleware('permission:about-customer.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $customers = AboutCustomer::withCount(['features', 'highlights'])->orderByDesc('id')->get();

        return view('backend.about.customers.index', compact('customers'));
    }

    public function create()
    {
        // Only one ACTIVE record may exist at a time. While one is active, send them to
        // edit it; once it's deactivated (or none exists) they can add a new one.
        if ($active = AboutCustomer::where('is_active', true)->first()) {
            return redirect()->route('manage-about-customer.edit', $active->id)
                ->with('message', 'An active record already exists. Edit it, or deactivate it to add a new one.');
        }

        return view('backend.about.customers.create');
    }

    public function store(Request $request)
    {
        // Guard: never create a second ACTIVE record (inactive ones may coexist).
        if (AboutCustomer::where('is_active', true)->exists()) {
            return redirect()->route('manage-about-customer.index')
                ->with('message', 'An active record already exists. Only one active record is allowed.');
        }

        $data = $this->validated($request);

        $customer = AboutCustomer::create([
            'heading'   => $data['heading'],
            'title'     => $data['title'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        $this->syncRows($customer, $request);

        return redirect()->route('manage-about-customer.index')->with('message', 'Customer section added successfully.');
    }

    public function edit($id)
    {
        $customer = AboutCustomer::with(['features', 'highlights'])->findOrFail($id);

        return view('backend.about.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = AboutCustomer::findOrFail($id);

        $data = $this->validated($request);

        $customer->update([
            'heading'   => $data['heading'],
            'title'     => $data['title'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        $this->syncRows($customer, $request);

        return redirect()->route('manage-about-customer.index')->with('message', 'Customer section updated successfully.');
    }

    public function destroy($id)
    {
        $customer = AboutCustomer::findOrFail($id);
        $userId   = Auth::id();

        // Soft-delete only — nothing is physically removed.
        // Children: flag deleted_at + deleted_by in a single update (they use SoftDeletes).
        $customer->features()->update(['deleted_at' => now(), 'deleted_by' => $userId]);
        $customer->highlights()->update(['deleted_at' => now(), 'deleted_by' => $userId]);

        // Parent: soft-delete (audited as "deleted"), then stamp who did it via a raw
        // update so it doesn't generate a second audit entry.
        $customer->delete();
        AboutCustomer::withTrashed()->whereKey($customer->id)->update(['deleted_by' => $userId]);

        return redirect()->route('manage-about-customer.index')->with('message', 'Customer section deleted successfully.');
    }

    // ------------------------------------------------------------------ helpers

    /** Shared validation for store/update. */
    private function validated(Request $request): array
    {
        return $request->validate([
            'heading'       => 'required|string|max:255',
            'title'         => 'nullable|string|max:255',
            'features'      => 'nullable|array',
            'features.*'    => 'nullable|string|max:255',
            'highlights'    => 'nullable|array',
            'highlights.*'  => 'nullable|string|max:255',
        ], [
            'heading.required' => 'Please enter the heading.',
        ]);
    }

    /** Replace the record's feature + highlight rows (blank rows are skipped). */
    private function syncRows(AboutCustomer $customer, Request $request): void
    {
        $this->syncList($customer->features(), $request->input('features', []), 'feature_name');
        $this->syncList($customer->highlights(), $request->input('highlights', []), 'highlight_name');
    }

    /** Delete-then-recreate a simple single-column repeater relation. */
    private function syncList($relation, array $rows, string $column): void
    {
        $relation->delete();

        $order = 0;
        foreach ((array) $rows as $value) {
            $value = trim((string) $value);
            if ($value === '') {
                continue;
            }

            $relation->create([
                $column      => $value,
                'sort_order' => $order++,
            ]);
        }
    }
}
