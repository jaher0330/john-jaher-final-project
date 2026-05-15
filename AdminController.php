<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalItems  = Item::count();
        $lostItems   = Item::where('type', 'lost')->count();
        $foundItems  = Item::where('type', 'found')->count();
        $totalUsers  = User::count();
        $recentItems = Item::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalItems', 'lostItems', 'foundItems', 'totalUsers', 'recentItems'
        ));
    }
}
