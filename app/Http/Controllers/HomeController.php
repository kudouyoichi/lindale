<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * @param int $order
     * @return mixed
     */
    public function index($order = 0)
    {
        switch ($order) {
            case 0:
                return view('home')->withArticles(\App\Article::latest()->get());
                break;
            case 1:
                return view('home')->withArticles(\App\Article::oldest()->get());
                break;
        }
    }
}
