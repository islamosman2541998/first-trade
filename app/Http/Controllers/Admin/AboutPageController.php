<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AboutPageController extends Controller
{
    public function index(): View
    {
        return view('admin.about-page.index');
    }
}