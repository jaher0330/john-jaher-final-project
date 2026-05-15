<?php

namespace App\Http\Controllers;

use App\Models\Item;

class HomeController extends Controller
{
    public function index()
    {
        $total   = Item::count();
        $lost    = Item::where('type', 'lost')->count();
        $found   = Item::where('type', 'found')->count();
        $claimed = Item::where('status', 'claimed')->count();
        $recent  = Item::with('user')->latest()->take(5)->get();

        return view('home', compact('total', 'lost', 'found', 'claimed', 'recent'));
    }

    public function about()
    {
        return view('about');
    }
}
