<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\MainPageController;
use App\Http\Controllers\Api\InnovationController;
use App\Http\Controllers\Api\SocialLinkController;
use App\Http\Controllers\Api\About\AwardController;
use App\Http\Controllers\Api\About\StoryController;
use App\Http\Controllers\Api\BooksBannerController;
use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\LandingPageController;
use App\Http\Controllers\Api\About\BannerController;
use App\Http\Controllers\Api\About\ImpactController;
use App\Http\Controllers\Api\About\TravelController;
use App\Http\Controllers\Api\About\AssociateController;
use App\Http\Controllers\Api\About\CorporateController;
use App\Http\Controllers\Api\Donate\DonationController;
use App\Http\Controllers\Api\RecommendedBooksController;
use App\Http\Controllers\Api\PublicationSummeryController;
use App\Http\Controllers\Api\Donate\DonationBannerController;
use App\Http\Controllers\Api\Technology\TechnologyController;
use App\Http\Controllers\Api\EntrepreneurshipBannerController;
use App\Http\Controllers\Api\PhilosophyController;
use App\Http\Controllers\Api\Technology\CyberController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// getting landing page images
Route::get('/landing-page-images', [LandingPageController::class, 'getImages']);

// main page
Route::get('/main-page', [MainPageController::class, 'index']);

// blogs
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('blog/{id}', [BlogController::class, 'show']);
Route::get('/blogs/search', [BlogController::class, 'search']);

// books banner
Route::get('/books-banner', [BooksBannerController::class, 'index']);

// recommended books
Route::get('/recommended-books', [RecommendedBooksController::class, 'index']);

// publication summery
Route::get('/publication-summery', [PublicationSummeryController::class, 'index']);

// event
Route::get('/events', [EventController::class, 'index']);
Route::get('/events/last-activity', [EventController::class, 'lastActivity']);

// entrepreneurship banner
Route::get('/entrepreneurship-banner', [EntrepreneurshipBannerController::class, 'index']);

// innovation
Route::get('/innovations', [InnovationController::class, 'index']);

// qoute
Route::get('/quotes', [QuoteController::class, 'index']);

// social media links
Route::get('/social-links', [SocialLinkController::class, 'index']);



// Route::apiResources([
//     'banners' => BannerController::class,
//     'awards'=>AwardController::class,
//     'stories'=>StoryController::class,
//     'impacts'=>ImpactController::class,  
//     'travels'=>TravelController::class, 
//     'corporates'=>CorporateController::class, 
//     'associates'=>AssociateController::class, 
//     'donations'=>DonationController::class, 
//     'donation-banners'=>DonationBannerController::class,
//     'technology'=>TechnologyController::class,

    
// ]);

Route::get('get-banners', [BannerController::class, 'index']);
Route::get('get-awards', [AwardController::class, 'index']);
Route::get('get-stories', [StoryController::class, 'index']);
Route::get('get-impacts', [ImpactController::class, 'index']);
Route::get('get-travels', [TravelController::class, 'index']);
Route::get('get-corporates', [CorporateController::class, 'index']);
Route::get('get-associates', [AssociateController::class, 'index']);
Route::get('get-donations', [DonationController::class, 'index']);
Route::get('get-donation-banners', [DonationBannerController::class, 'index']);
Route::get('get-technologies', [TechnologyController::class, 'index']);
Route::get('/certificates', [CertificateController::class, 'getCertificates']);
Route::get('/cyber', [CyberController::class, 'index']);
Route::get('/get-philosophy', [PhilosophyController::class, 'index']);