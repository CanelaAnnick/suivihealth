<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function apropos()
    {
        return view('pages.apropos');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}