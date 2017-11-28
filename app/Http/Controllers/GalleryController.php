<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;

class GalleryController extends Controller
{

    const START_YEAR = 2017;
    const MEDIA_LIMIT = 6;

    private $firebase;
    private $db;
    private $galleryRef;

    public function __construct(Firebase $firebase) {
        $this->firebase = $firebase;
        $this->db = $this->firebase->getDatabase();
        $this->galleryRef = $this->db->getReference('gallery');
    }

    public function index($year = null) {
        $allYears = $this->yearsSinceStart();

        if(!is_null($year) && !in_array($year, $allYears))
            abort(404);

        $videos = $this->getMedia('videos', $year);
        $images = $this->getMedia('images', $year);

        return view('gallery.gallery')->with([
            'videos' => $videos,
            'images' => $images,
            'year' => $year,
            'allYears' => $allYears
        ]);
    }

    public function loadMore($type, $year, $startAt) {
        if(!is_numeric($year))
            $year = null;
        $media = $this->getMedia($type, $year, self::MEDIA_LIMIT + 1, $startAt);
        // Remove first element since the first one
        // will be the last from the last set of media loaded
        $media = $this->removeFirst($media);
        return view(sprintf('gallery.%s', $type))->with($type, $media);
    }

    private function getMedia($type, $year, $limit = self::MEDIA_LIMIT, $startAt = null) {
        $ref = $this->galleryRef->getChild($type)
            ->orderByKey()
            ->limitToFirst($limit);
        if(!is_null($startAt)) {
            $ref = $ref->startAt($startAt);
        }
        $items = $this->filter($ref->getValue(), $year);
        return $items;
    }

    private function filter($arr, $year) {
        if(is_null($arr))
            return $arr;
        $newArr = [];
        foreach($arr as $key => $val) {
            if(is_null($val))
                continue;
            if(is_null($year) || $val['year'] == $year) {
                $newArr[$key] = $val;
            }
        }
        return $newArr;
    }

    private function yearsSinceStart() {
        $curYear = date('Y');
        $years = [];
        for($y = $curYear; $y >= self::START_YEAR; $y--) {
            $years[] = $y;
        }
        return $years;
    }

    private function removeFirst($arr) {
        $counter = 0;
        foreach($arr as $k => $v) {
            if($counter > 0) 
                break;
            unset($arr[$k]);
            $counter++;
        }
        return $arr;
    }

}
