<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'categoryCount' => Category::count(),
            'productCount' => Product::count(),
            'catalogCount' => Catalog::count(),
            'messageCount' => ContactMessage::count(),
            'unreadMessageCount' => ContactMessage::unread()->count(),
        ]);
    }
}
