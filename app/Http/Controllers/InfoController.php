<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class InfoController extends Controller
{
    public function index() {
        $contents = File::get(resource_path() . '/faq.json');
        $faq = json_decode($contents, true);
        return view('info', ['faq' => $faq]);
    }
}
