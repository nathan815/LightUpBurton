<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;

class GalleryController extends Controller
{
    public function index(Firebase $firebase, $year = null) {
        $db = $firebase->getDatabase();
        $gallery = $db->getReference('gallery');
        $allYears = $this->yearsSinceStart();

        if(!is_null($year) && !in_array($year, $allYears))
            abort(404);

        $images = $this->filter($gallery->getChild('images')->getValue(), $year);

        $videos = $this->filter($gallery->getChild('videos')->getValue(), $year);

        return view('gallery.gallery')->with([
            'images' => $images,
            'videos' => $videos,
            'year' => $year,
            'allYears' => $allYears
        ]);
    }

    private function filter($arr, $year) {
        if(is_null($year) || is_null($arr))
            return $arr;
        $newArr = [];
        foreach($arr as $val) {
            if($val['year'] == $year) {
                $newArr[] = $val;
            }
        }
        return $newArr;
    }

    private function yearsSinceStart() {
        $curYear = date('Y');
        $years = [];
        for($y = $curYear; $y >= 2017; $y--) {
            $years[] = $y;
        }
        return $years;
    }

}
