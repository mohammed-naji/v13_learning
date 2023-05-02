<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APITESTController extends Controller
{
    public function test()
    {
        // $posts = Http::get('https://jsonplaceholder.typicode.com/posts')->json();

        // return view('test.api', compact('posts'));
        return view('test.api');
    }

    public function weather()
    {
        return view('test.weather');
    }
}
