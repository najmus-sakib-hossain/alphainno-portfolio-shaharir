<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MainPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MainPageController extends Controller
{
    public function index() {
        $data = Cache::remember('main-page-data', 3600, function () {
            $latest = MainPage::latest()->first();
            if (!$latest) return null;
        
            return [
                'id'           => $latest->id,
                'banner_text'  => $latest->banner_text,
                'moto'         => $latest->moto,
                'experience'   => $latest->experience,
                'projects'     => $latest->projects,
                'certification'=> $latest->certification,
                'article'      => $latest->article,
                'books'        => $latest->books,
                'mentoring'    => $latest->mentoring,
                'banner_image' => $latest->getFirstMediaUrl('banner_images'),
            ];
        });
        
        return response()->json([
            'status' => 'success',
            'data'   => $data,
        ]);
    }
}
