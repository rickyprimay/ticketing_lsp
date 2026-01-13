<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEvents = Event::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        return view('admin.dashboard', compact('totalEvents', 'totalCategories', 'totalOrders'));
    }
}