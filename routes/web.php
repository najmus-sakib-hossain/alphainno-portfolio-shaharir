<?php

use App\Models\Blog;

use App\Models\Event;
use App\Models\Donation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\BookBannerController;
use App\Http\Controllers\InnovationController;
use App\Http\Controllers\PhilosophyController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ImageGalleryController;
use App\Http\Controllers\EventActivityController;
use App\Http\Controllers\RecommendedBookController;
use App\Http\Controllers\PublicationSummeryController;
use App\Http\Controllers\Backend\About\AwardController;
use App\Http\Controllers\Backend\About\StoryController;
use App\Http\Controllers\Backend\About\BannerController;
use App\Http\Controllers\Backend\About\ImpactController;
use App\Http\Controllers\Backend\About\TravelController;
use App\Http\Controllers\EntrepreneurshipBannerController;
use App\Http\Controllers\Backend\About\AssociateController;
use App\Http\Controllers\Backend\About\CorporateController;
use App\Http\Controllers\Backend\Donate\DonationController;
use App\Http\Controllers\Backend\Technology\CyberController;
use App\Http\Controllers\Backend\Donate\DonationBannerController;
use App\Http\Controllers\Backend\Technology\TechnologyController;
use App\Http\Controllers\Backend\Technology\CertificateController;


// use Illuminate\Support\Facades\Route;



Route::prefix('/admin')->group(function () {

    Route::get('/auto-login', function () {
        \Illuminate\Support\Facades\Auth::login(\App\Models\User::first());
        return redirect('/admin');
    });

    Route::get('/', function () {
        $totalBlogs = Blog::count();
        $totalEvents = Event::count();
        // $totalBooks = Book::count();
        $totalDonations = Donation::count();
        
        return view('dashboard', compact('totalBlogs', 'totalEvents', 'totalDonations'));
    })->middleware(['auth', 'verified'])->name('dashboard');
    
    Route::middleware('auth')->group(function () {
        // Landing page
        Route::get('/home/landing-page', [LandingPageController::class, 'index'])->name('home.landing');
        Route::post('/home/landing-page', [LandingPageController::class, 'uploadImage'])->name('home.landing.upload');
    
    
        // main page
        Route::get('/home/main-page', [MainPageController::class, 'index'])->name('main.page.index');
        Route::post('/home/main-page', [MainPageController::class, 'store'])->name('main.page.index');
    
        // blogs
        Route::resource('/blogs', BlogController::class);
    
        // book banners
        Route::resource('/book-banners', BookBannerController::class);
    
        // recommended books
        Route::resource('/recommended-books', RecommendedBookController::class);
        Route::delete('recommended-books/image/{media}', [RecommendedBookController::class, 'destroyImage'])->name('recommended-books.image.destroy');
    
        // publication summery
        Route::resource('/publication-summery', PublicationSummeryController::class);
    
        // event
        Route::resource('/events', EventController::class);
    
        // event activities
        Route::resource('/event-activities', EventActivityController::class);
        Route::delete('/event-activities/remove-image/{media}', [EventActivityController::class, 'removeImage'])
        ->name('event-activities.remove-image');
    
        // enterpreneurship banner
        Route::resource('/enterpreneurship-banners', EntrepreneurshipBannerController::class);
    
        // innovation
        Route::resource('/innovations', InnovationController::class);
        Route::delete('innovations/remove-image/{media}', [InnovationController::class, 'removeImage']);
    
        // quotes
        Route::resource('/quotes', QuoteController::class);
    
        // reports
        Route::resource('/reports', ReportController::class);
    
        // image gallery
        Route::resource('/image-galleries', ImageGalleryController::class);
        Route::delete('/image-galleries/media/{media}', [ImageGalleryController::class, 'destroyImage'])
        ->name('image-galleries.media.destroy');
    
        // philosophy
        Route::resource('/philosophies', PhilosophyController::class);
    
        // social links
        Route::get('/social-links', [SocialLinkController::class, 'index'])->name('social-links');
        Route::post('/social-links', [SocialLinkController::class, 'store'])->name('social-links');
    
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
        Route::middleware(['auth'])->group(function () {
            Route::resource('banners', BannerController::class);
            Route::resource('awards', AwardController::class);
            Route::resource('stories',StoryController::class);
            Route::resource('impacts',ImpactController::class);
            Route::resource('travels',TravelController::class);
            Route::resource('corporates',CorporateController::class);
            Route::resource('associates',AssociateController::class);
        });
        
        
        
        
        Route::middleware(['auth'])->group(function () {
            Route::resource('donations', DonationController::class);
            Route::resource('donation-banners', DonationBannerController::class);
         
        });
        
        
        Route::middleware(['auth'])->group(function () {
            Route::resource('certificates', CertificateController::class);
            Route::resource('cybers',CyberController::class);
            
         
        });
        
        
        
        Route::middleware(['auth'])->group(function () {
           // Fields
            Route::get('technology', [TechnologyController::class,'index'])->name('technology.index');
            Route::get('technology/create', [TechnologyController::class,'createField'])->name('technology.createField');
            Route::post('technology', [TechnologyController::class,'storeField'])->name('technology.storeField');
            Route::get('technology/{field}/edit', [TechnologyController::class,'editField'])->name('technology.editField');
            Route::put('technology/{field}', [TechnologyController::class,'updateField'])->name('technology.updateField');
            Route::delete('technology/{field}', [TechnologyController::class,'destroyField'])->name('technology.destroyField');
        
            // Skills
            Route::get('technology/{field}/skills/create', [TechnologyController::class,'createSkill'])->name('technology.createSkill');
            Route::post('technology/{field}/skills', [TechnologyController::class,'storeSkill'])->name('technology.storeSkill');
            Route::delete('technology/{field}/skills/{skill}', [TechnologyController::class,'destroySkill'])->name('technology.destroySkill');
        
            
         
        });
    });
    
    require __DIR__.'/auth.php';
});


Route::get('/{any}', function () {
    return file_get_contents(public_path('index.html'));
})->where('any', '^(?!api|admin).*');

// // React fallback route (MUST be last)
// Route::get('/{any}', function () {
//     return file_get_contents(public_path('index.html'));
// })->where('any', '^(?!api|blogs|events|donations|profile|home|technology|reports|quotes|banners|certificates|cybers|social-links|image-galleries|philosophies|recommended-books|book-banners|publication-summery|enterpreneurship-banners).*');



