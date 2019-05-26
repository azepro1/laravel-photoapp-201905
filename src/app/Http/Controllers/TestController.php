<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    /*
    *
    *テスト用コントローラ
    *   
    */
    public function index()
    {
        return view('test');
    }
}