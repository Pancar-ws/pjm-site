<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Partner;
use App\Models\Certification;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::take(3)->get();
        $best_sellers = Product::with('category')->take(4)->get();
        $partners = Partner::all();
        $certifications = Certification::all();

        return view('home.index', compact('categories', 'best_sellers', 'partners', 'certifications'));
    }
}
