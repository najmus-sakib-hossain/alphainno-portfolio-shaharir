<?php

namespace App\Http\Controllers;

use App\Models\SocialLinks;
use App\Services\SocilaMediaLinksService;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    protected $socialLinksService;

    public function __construct(SocilaMediaLinksService $socialLinksService)
    {
        $this->socialLinksService = $socialLinksService;
    }
    public function index()
    {
        return view('pages.social-links.index');
    }

    public function store(Request $request)
    {
        return $this->socialLinksService->store($request);
    }
}
