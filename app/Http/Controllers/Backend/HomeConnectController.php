<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeConnection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HomeConnectController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:home-connection.view', only: ['index']),
            new Middleware('permission:home-connection.create', only: ['create', 'store']),
            new Middleware('permission:home-connection.edit', only: ['edit', 'update']),
            new Middleware('permission:home-connection.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $items = HomeConnection::orderByDesc('id')->get();

        return view('backend.home.connection.index', compact('items'));
    }

    public function create()
    {
        // Only one connection section is allowed — send them to edit the existing one.
        if ($item = HomeConnection::first()) {
            return redirect()->route('manage-home-connection.edit', $item->id)
                ->with('message', 'Only one connection section is allowed. You can edit the existing one.');
        }

        return view('backend.home.connection.create');
    }

    public function store(Request $request)
    {
        // Guard: never create a second section.
        if (HomeConnection::exists()) {
            return redirect()->route('manage-home-connection.index')
                ->with('message', 'A connection section already exists. Only one is allowed.');
        }

        $request->validate($this->rules(), $this->messages());

        HomeConnection::create([
            'title'     => $request->title,
            'heading'   => $request->heading,
            'email'     => $request->email,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-home-connection.index')->with('message', 'Connection section added successfully.');
    }

    public function edit($id)
    {
        $item = HomeConnection::findOrFail($id);

        return view('backend.home.connection.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = HomeConnection::findOrFail($id);

        $request->validate($this->rules(), $this->messages());

        $item->update([
            'title'     => $request->title,
            'heading'   => $request->heading,
            'email'     => $request->email,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-home-connection.index')->with('message', 'Connection section updated successfully.');
    }

    public function destroy($id)
    {
        $item = HomeConnection::findOrFail($id);
        $item->delete();

        return redirect()->route('manage-home-connection.index')->with('message', 'Connection section deleted successfully.');
    }

    private function rules(): array
    {
        return [
            'title'   => 'required|string|max:255',
            'heading' => 'nullable|string',
            'email'   => 'required|email|max:255',
        ];
    }

    private function messages(): array
    {
        return [
            'title.required' => 'Please enter the title.',
            'email.required' => 'Please enter the email.',
            'email.email'    => 'Please enter a valid email address.',
        ];
    }
}
