<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('user')->latest();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('item_name', 'like', "%$search%")
                  ->orWhere('location', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $items = $query->get();
        return view('items.index', compact('items'));
    }
    public function create() { return view('items.create'); }
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'type' => 'required|in:lost,found',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date_reported' => 'required|date',
           'status' => 'required|in:on_hand,turned_over,claimed,missing',
            'image' => 'nullable|image|max:2048',
        ]);
        $data = $request->all();
        $data['user_id'] = auth()->id();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('items', 'public');
        }
        Item::create($data);
        return redirect()->route('items.index')->with('success', 'Item reported successfully!');
    }
    public function show(Item $item) { return view('items.show', compact('item')); }
    public function edit(Item $item) { $this->authorizeAction($item); return view('items.edit', compact('item')); }
    public function update(Request $request, Item $item)
    {
        $this->authorizeAction($item);
        $request->validate([
            'item_name' => 'required|string|max:255',
            'type' => 'required|in:lost,found',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date_reported' => 'required|date',
            'status' => 'required|in:on_hand,turned_over,claimed',
            'image' => 'nullable|image|max:2048',
        ]);
        $data = $request->except(['image', '_token', '_method']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('items', 'public');
        }
        $item->update($data);
        return redirect()->route('items.index')->with('success', 'Item updated successfully!');
    }
    public function destroy(Item $item)
    {
        $this->authorizeAction($item);
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully!');
    }
    private function authorizeAction(Item $item)
    {
        if (!auth()->user()->isAdmin() && $item->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
