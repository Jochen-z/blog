<?php

namespace App\Http\Controllers;

use Parsedown;
use App\Models\About;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Display personal information.
     *
     * @param Parsedown $parsedown
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about(Parsedown $parsedown)
    {
        $about = About::findOrFail(1);
        $introduction = $parsedown->text($about->content);

        return view('admin.about', compact('introduction'));
    }
}