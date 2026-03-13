<?php

namespace App\Http\Controllers;

class StaticPageController extends Controller
{
    public function about()
    {
        return view('static.about');
    }

    public function stores()
    {
        return view('static.stores');
    }

    public function contact()
    {
        return view('static.contact');
    }

    public function policy()
    {
        return view('static.policy');
    }

    public function faq()
    {
        return view('static.faq');
    }
}

