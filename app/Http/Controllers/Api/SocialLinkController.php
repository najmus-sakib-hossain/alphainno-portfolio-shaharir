<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SocialLinks;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLinks::all();

        return response()->json([
            'status' => 'success',
            'data' => $socialLinks
        ]);
    }
}
