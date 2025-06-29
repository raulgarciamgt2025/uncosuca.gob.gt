<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Channels\Categories;
use App\Http\Livewire\Channels\Channels;
use App\Http\Livewire\Companies\CompanyIndex;
use App\Http\Livewire\Complaints\Form;
use App\Http\Livewire\Consults\Dashboard;
use App\Http\Livewire\Consults\Detail;
use App\Http\Livewire\Consults\Table;
use App\Http\Livewire\Consults\VerifyDocument;
use App\Http\Livewire\Contact;
use App\Http\Livewire\Maps\PrivateMap;
use App\Http\Livewire\Maps\PublicMap;
use App\Http\Livewire\Pays\Admin\Index;
use App\Http\Livewire\Users\Profile;
use App\Http\Livewire\Visits\MakeVisit;
use App\Http\Livewire\Visits\MyVisits;
use App\Http\Livewire\Visits\NewVisit;
use App\Http\Livewire\Visits\ShowVisit;
use App\Http\Livewire\Workflows\Handle;
use App\Http\Livewire\Workflows\MyRequests;
use App\Http\Livewire\Workflows\NewRequest;
use App\Http\Livewire\Workflows\RequestReview;
use App\Http\Livewire\Workflows\Stages\AuthorizationDocuments;
use App\Http\Livewire\Workflows\Stages\CableServiceAuthorization\PaySlipUpload;
use App\Http\Livewire\Workflows\Stages\CableServiceAuthorization\UserPaymentData;
use App\Http\Livewire\Workflows\Stages\CableServiceAuthorization\VerifyPaymentData;
use App\Http\Livewire\Workflows\Stages\DocumentsReview;
use App\Http\Livewire\Workflows\Stages\JuridicAuthorization;
use App\Http\Livewire\Workflows\Stages\SendResolution;
use App\Http\Livewire\Workflows\Stages\SignatureAuthorization;
use App\Http\Livewire\Workflows\Stages\SignatureOpinion;
use App\Http\Livewire\Workflows\Stages\UploadDocuments;
use App\Http\Livewire\Workflows\UpdateSteps;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('verify-document/{key}', VerifyDocument::class)->name('verify-document');
Route::get('public-map', PrivateMap::class)->name('public-map');
Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        // Rutas generales
        Route::get('/', [Controller::class, 'home'])->name('home');
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('users', UserController::class);
        Route::resource('departments', DepartmentController::class);

        // RUTAS PRINCIPALES
        Route::get('update-steps', UpdateSteps::class)->name('update-steps');
        Route::get('workflows-new-request', NewRequest::class)->name('workflows-new-request');
        Route::get('workflows-my-requests', MyRequests::class)->name('workflows-my-requests');
        Route::get('workflows-review-requests', RequestReview::class)->name('workflows-review-requests');
        Route::get('workflows-handle/{workflowRequest}', Handle::class)->name('workflows-handle');
        Route::get('profile', Profile::class)->name('profile');
        Route::get('consults', Table::class)->name('consults');
        Route::get('details/{key}', Detail::class)->name('details-key');
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('companies', CompanyIndex::class)->name('companies');
        Route::get('pays', Index::class)->name('pays');
        Route::get('my-pays', \App\Http\Livewire\Pays\Users\Index::class)->name('my-pays');
        Route::get('visits', \App\Http\Livewire\Visits\Index::class)->name('visits');
        Route::get('new-visit', NewVisit::class)->name('new-visit');
        Route::get('channels', Channels::class)->name('channels');
        Route::get('channels-category', Categories::class)->name('channels-category');
        Route::get('my-visits', MyVisits::class)->name('my-visits');
        Route::get('make-visit/{visit}', MakeVisit::class)->name('make-visit');
        Route::get('show-visit/{visit}', ShowVisit::class)->name('show-visit');

        // MAPAS
        Route::get('private-map', PrivateMap::class)->name('private-map');

        // QUEJAS Y DENUNCIAS
        Route::get('applicant-complaints', Form::class)->name('applicant-complaints');

        // Contacto
        Route::get('contact', Contact::class)->name('contact');

        // Rutas para pasos
        Route::prefix('/stages')
            ->group(function () {
                // PASOS GENERALES Y REUTILIZABLES
                Route::get('/upload-documents/{key}', UploadDocuments::class)->name('upload-documents');
                Route::get('/review-documents/{key}', DocumentsReview::class)->name('review-documents');
                Route::get('/authorization-documents/{key}', AuthorizationDocuments::class)->name('authorization-documents');
                Route::get('/juridic-authorization/{key}', JuridicAuthorization::class)->name('juridic-authorization');
                Route::get('/opinion-signature/{key}', SignatureOpinion::class)->name('opinion-signature');
                Route::get('/direction-signature/{key}', SignatureAuthorization::class)->name('direction-signature');
                Route::get('/send-documents/{key}', SendResolution::class)->name('send-resolution');

                // AUTORIZACIÓN PARA PRESTAR SERVICIO DE CABLE
                Route::prefix('/cable-service-authorization')->name('cable-service-authorization.')
                    ->group(function () {
                        Route::get('/pay-slip-upload/{key}', PaySlipUpload::class)->name('pay-slip-upload');
                        Route::get('/user-payment-data/{key}', UserPaymentData::class)->name('user-payment-data');
                        Route::get('/verify-payment-data/{key}', VerifyPaymentData::class)->name('verify-payment-data');
                    });
            });
    });
