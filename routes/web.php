<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SpecialtiesController;
use App\Http\Controllers\TreatmentsController;
use App\Http\Controllers\ConditionsController;
use App\Http\Controllers\HospitalsController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\InquiriesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Patient\DashboardController as PatientDashboard;
use App\Http\Controllers\Patient\InquiriesController as PatientInquiries;
use App\Http\Controllers\Patient\MessagesController as PatientMessages;
use App\Http\Controllers\Patient\QuotationsController as PatientQuotations;
use App\Http\Controllers\Patient\MedicalRecordsController as PatientMedicalRecords;
use App\Http\Controllers\Patient\AppointmentsController as PatientAppointments;
use App\Http\Controllers\Patient\PaymentsController as PatientPayments;
use App\Http\Controllers\Patient\ProfilesController as PatientProfile;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\InquiriesController as AdminInquiries;
use App\Http\Controllers\Admin\QuotationsController as AdminQuotations;
use App\Http\Controllers\Admin\AppointmentsController as AdminAppointments;
use App\Http\Controllers\Admin\PatientsController as AdminPatients;
use App\Http\Controllers\Admin\HospitalsController as AdminHospitals;
use App\Http\Controllers\Admin\HospitalGalleriesController;
use App\Http\Controllers\Admin\HospitalFacilitiesController;
use App\Http\Controllers\Admin\DoctorsController as AdminDoctors;
use App\Http\Controllers\Admin\SpecialtiesController as AdminSpecialties;
use App\Http\Controllers\Admin\TreatmentsController as AdminTreatments;
use App\Http\Controllers\Admin\ConditionsController as AdminConditions;
use App\Http\Controllers\Admin\PackagesController as AdminPackages;
use App\Http\Controllers\Admin\DestinationsController as AdminDestinations;
use App\Http\Controllers\Admin\TestimonialsController as AdminTestimonials;
use App\Http\Controllers\Admin\BlogController as AdminBlog;
use App\Http\Controllers\Admin\BlogCategoriesController;
use App\Http\Controllers\Admin\BlogTagsController;
use App\Http\Controllers\Admin\CmsPagesController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\SeoRedirectsController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\NewsletterSubscribersController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AuditLogsController;

/*
|--------------------------------------------------------------------------
| Authentication Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Static Pages
Route::get('/how-it-works',   [PagesController::class, 'howItWorks'])->name('how_it_works');
Route::get('/about',          [PagesController::class, 'about'])->name('about');
Route::get('/why-india',      [PagesController::class, 'whyIndia'])->name('why_india');
Route::get('/accreditations', [PagesController::class, 'accreditations'])->name('accreditations');
Route::get('/travel-guide',   [PagesController::class, 'travelGuide'])->name('travel_guide');
Route::get('/faq',            [PagesController::class, 'faq'])->name('faq');
Route::get('/privacy-policy', [PagesController::class, 'privacyPolicy'])->name('privacy_policy');
Route::get('/terms',          [PagesController::class, 'terms'])->name('terms');
Route::get('/for-providers',  [PagesController::class, 'forProviders'])->name('for_providers');
Route::get('/services',       [PagesController::class, 'services'])->name('services');

// Medical Content
Route::resource('specialties',  SpecialtiesController::class)->only(['index', 'show']);
Route::resource('treatments',   TreatmentsController::class)->only(['index', 'show']);
Route::resource('conditions',   ConditionsController::class)->only(['show']);
Route::resource('hospitals',    HospitalsController::class)->only(['index', 'show']);
Route::resource('doctors',      DoctorsController::class)->only(['index', 'show']);
Route::resource('packages',     PackagesController::class)->only(['index', 'show']);
Route::resource('destinations', DestinationsController::class)->only(['index', 'show']);

// Blog
Route::prefix('blog')->group(function () {
    Route::get('/',                [BlogController::class, 'index'])->name('blog.index');
    Route::get('/category/{slug}', [BlogController::class, 'byCategory'])->name('blog.category');
    Route::get('/tag/{slug}',      [BlogController::class, 'byTag'])->name('blog.tag');
    Route::get('/{slug}',          [BlogController::class, 'show'])->name('blog.show');
});

// Inquiry / Quote
Route::get('/get-quote',            [InquiriesController::class, 'create'])->name('get_quote');
Route::post('/inquiries',           [InquiriesController::class, 'store'])->name('inquiries.store');
Route::get('/inquiry/confirmation', [InquiriesController::class, 'confirmation'])->name('inquiry.confirmation');
Route::get('/treatments/options',   [InquiriesController::class, 'treatmentsForSpecialty'])->name('treatments.options');

// Contact
Route::get('/contact',  [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Testimonials
Route::get('/patient-stories',      [TestimonialsController::class, 'index'])->name('patient_stories');
Route::get('/patient-stories/{id}', [TestimonialsController::class, 'show'])->name('patient_story');

// Newsletter
Route::post('/newsletter/subscribe',          [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/confirm/{token}',     [NewsletterController::class, 'confirm'])->name('newsletter.confirm');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// CMS Pages (catch-all — keep near end of public routes)
Route::get('/pages/{slug}', [PagesController::class, 'cmsPage'])->name('cms_page');

/*
|--------------------------------------------------------------------------
| Patient Dashboard
|--------------------------------------------------------------------------
*/
Route::prefix('dashboard')->middleware(['auth'])->name('patient.')->group(function () {
    Route::get('/', [PatientDashboard::class, 'index'])->name('dashboard');

    Route::resource('inquiries', PatientInquiries::class)->only(['index', 'show']);
    Route::resource('inquiries.messages', PatientMessages::class)->only(['index', 'store']);

    Route::resource('quotations', PatientQuotations::class)->only(['index', 'show']);
    Route::post('quotations/{quotation}/respond', [PatientQuotations::class, 'respond'])->name('quotations.respond');

    Route::resource('medical-records', PatientMedicalRecords::class)->only(['index', 'create', 'store', 'destroy']);
    Route::resource('appointments', PatientAppointments::class)->only(['index', 'show']);
    Route::get('payments', [PatientPayments::class, 'index'])->name('payments.index');

    Route::get('profile',      [PatientProfile::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [PatientProfile::class, 'edit'])->name('profile.edit');
    Route::put('profile',      [PatientProfile::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');

    // Inquiries with special actions
    Route::resource('inquiries', AdminInquiries::class);
    Route::patch('inquiries/{inquiry}/update-status', [AdminInquiries::class, 'updateStatus'])->name('inquiries.update_status');
    Route::patch('inquiries/{inquiry}/assign',        [AdminInquiries::class, 'assign'])->name('inquiries.assign');
    Route::post('inquiries/{inquiry}/add-note',       [AdminInquiries::class, 'addNote'])->name('inquiries.add_note');

    // Quotations nested under inquiries
    Route::resource('inquiries.quotations', AdminQuotations::class);
    Route::post('inquiries/{inquiry}/quotations/{quotation}/send-to-patient', [AdminQuotations::class, 'sendToPatient'])
        ->name('inquiries.quotations.send_to_patient');
    Route::get('inquiries/{inquiry}/quotations/{quotation}/preview-pdf', [AdminQuotations::class, 'previewPdf'])
        ->name('inquiries.quotations.preview_pdf');

    // Appointments
    Route::resource('inquiries.appointments', AdminAppointments::class)->except(['index', 'show']);
    Route::resource('appointments', AdminAppointments::class)->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);

    // Patients (read-only)
    Route::resource('patients', AdminPatients::class)->only(['index', 'show']);

    // Hospitals with gallery and facilities
    // Explicit route must be declared before the resource to avoid {hospital} wildcard match
    Route::get('hospitals/cities-by-country', [AdminHospitals::class, 'citiesByCountry'])->name('hospitals.cities_by_country');
    Route::resource('hospitals', AdminHospitals::class);
    Route::resource('hospitals.gallery',    HospitalGalleriesController::class)->only(['index', 'store', 'destroy']);
    Route::resource('hospitals.facilities', HospitalFacilitiesController::class)->only(['index', 'store', 'destroy']);

    Route::resource('doctors',      AdminDoctors::class);
    Route::resource('specialties',  AdminSpecialties::class);
    Route::resource('treatments',   AdminTreatments::class);
    Route::resource('conditions',   AdminConditions::class);
    Route::resource('packages',     AdminPackages::class);
    Route::resource('destinations', AdminDestinations::class);
    Route::resource('testimonials', AdminTestimonials::class);

    // Blog
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/',               [AdminBlog::class, 'index'])->name('index');
        Route::get('/create',         [AdminBlog::class, 'create'])->name('create');
        Route::post('/',              [AdminBlog::class, 'store'])->name('store');
        Route::get('/{post}/edit',    [AdminBlog::class, 'edit'])->name('edit');
        Route::put('/{post}',         [AdminBlog::class, 'update'])->name('update');
        Route::delete('/{post}',      [AdminBlog::class, 'destroy'])->name('destroy');
        Route::post('/{post}/publish',   [AdminBlog::class, 'publish'])->name('publish');
        Route::post('/{post}/unpublish', [AdminBlog::class, 'unpublish'])->name('unpublish');
    });

    Route::resource('blog-categories',        BlogCategoriesController::class);
    Route::resource('blog-tags',              BlogTagsController::class)->except(['create', 'show']);
    Route::resource('cms-pages',              CmsPagesController::class);
    Route::resource('faqs',                   FaqsController::class);
    Route::resource('seo-redirects',          SeoRedirectsController::class);
    Route::resource('staff',                  StaffController::class);
    Route::resource('newsletter-subscribers', NewsletterSubscribersController::class)
        ->only(['index', 'show', 'destroy']);

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/inquiries',   [ReportsController::class, 'inquiries'])->name('inquiries');
        Route::get('/revenue',     [ReportsController::class, 'revenue'])->name('revenue');
        Route::get('/conversions', [ReportsController::class, 'conversions'])->name('conversions');
        Route::get('/sources',     [ReportsController::class, 'sources'])->name('sources');
    });

    Route::get('settings', [SettingsController::class, 'show'])->name('settings.show');
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::resource('audit-logs', AuditLogsController::class)->only(['index']);
});
