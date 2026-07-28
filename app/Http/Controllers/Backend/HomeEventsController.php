<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeEvent;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HomeEventsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:home-events.view', only: ['index']),
            new Middleware('permission:home-events.create', only: ['create', 'store']),
            new Middleware('permission:home-events.edit', only: ['edit', 'update']),
            new Middleware('permission:home-events.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $items = HomeEvent::orderByDesc('id')->get();

        return view('backend.home.event_intro.index', compact('items'));
    }

    public function create()
    {
        // Only one event intro is allowed — send them to edit the existing one.
        if ($item = HomeEvent::first()) {
            return redirect()->route('manage-home-events.edit', $item->id)
                ->with('message', 'Only one event introduction is allowed. You can edit the existing one.');
        }

        return view('backend.home.event_intro.create');
    }

    public function store(Request $request)
    {
        // Guard: never create a second section.
        if (HomeEvent::exists()) {
            return redirect()->route('manage-home-events.index')
                ->with('message', 'An event introduction already exists. Only one is allowed.');
        }

        $request->validate($this->rules(), ['heading.required' => 'Please enter the heading.']);

        HomeEvent::create([
            'heading'   => $request->heading,
            'title'     => $request->title,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-home-events.index')->with('message', 'Event introduction added successfully.');
    }

    public function edit($id)
    {
        $item = HomeEvent::findOrFail($id);

        return view('backend.home.event_intro.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = HomeEvent::findOrFail($id);

        $request->validate($this->rules(), ['heading.required' => 'Please enter the heading.']);

        $item->update([
            'heading'   => $request->heading,
            'title'     => $request->title,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-home-events.index')->with('message', 'Event introduction updated successfully.');
    }

    public function destroy($id)
    {
        $item = HomeEvent::findOrFail($id);
        $item->delete();

        return redirect()->route('manage-home-events.index')->with('message', 'Event introduction deleted successfully.');
    }

    private function rules(): array
    {
        return [
            'heading' => 'required|string|max:255',
            'title'   => 'nullable|string',
        ];
    }
}
