<?php

namespace App\Http\Controllers;

class HelloController extends Controller
{
    public function index()
    {
        $msgs = [
            'hello',
            'こんにちは',
            '尓好'
        ];
            return view('hello.index', ['msgs' => $msgs]);
    }
}
