<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use Illuminate\View\View;

class HomeSectionController extends Controller
{
    public function index(): View
    {
        return view('admin.home-sections.index');
    }

    public function edit(HomeSection $homeSection): View
    {
        return view('admin.home-sections.edit', compact('homeSection'));
    }
}