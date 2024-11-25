<?php

use App\Modules\Content\Website1\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Panel\SalePointsController;
use App\Modules\Content\Website1\Http\Controllers\Web\SalepointsController as SaleFrontend;
use App\Http\Controllers\Panel\SaleAgentsController;
use App\Http\Controllers\WebServiceController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Modules\Content\Website1\Http\Controllers\Web\UseractivationController;
use App\Modules\Content\Website1\Http\Controllers\Web\MyaccountController;
use App\Modules\Content\Website1\Http\Controllers\Web\ForgotmypasswordController;
use App\Modules\Content\Website1\Http\Controllers\Web\UpdatepasswordController;
use App\Http\Controllers\Panel\CrmController;
use App\Http\Controllers\Panel\CityController;
use App\Http\Controllers\SitemapController;
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
//Route::get('/fix-extras', [WebServiceController::class, 'fixExtras'])->name('fixExtras');
Route::get('/getCities', [SaleFrontend::class, 'getCities'])->name('getCities');
Route::post('/getLanguages', [WebServiceController::class, 'getLanguagesOfSelectedZone'])->name('getLanguagesOfSelectedZone');
Route::post('/setLanguage', [WebServiceController::class, 'setCountryGroupAndLanguage'])->name('setCountryGroupAndLanguage');
Route::post('/getCategories', [ProductController::class, 'getCategories'])->name('getCategories');
Route::post('/getBrands', [ProductController::class, 'getBrands'])->name('getBrands');
Route::post('/getDecors', [ProductController::class, 'getDecors'])->name('getDecors');
Route::post('/getTextures', [ProductController::class, 'getTextures'])->name('getTextures');
Route::post('/getSurfaces', [ProductController::class, 'getSurfaces'])->name('getSurfaces');
Route::post('/getExtraFeatures', [ProductController::class, 'getExtraFeatures'])->name('getExtraFeatures');
Route::post('/getDimensions', [ProductController::class, 'getDimensions'])->name('getDimensions');
Route::post('/getThickness', [ProductController::class, 'getThickness'])->name('getThickness');
Route::post('/getLocks', [ProductController::class, 'getLocks'])->name('getLocks');
Route::post('/getBevels', [ProductController::class, 'getBevels'])->name('getBevels');
Route::post('/getClass', [ProductController::class, 'getClasses'])->name('getClasses');
Route::post('/getHeights', [ProductController::class, 'getHeights'])->name('getHeights');
Route::post('/getWaters', [ProductController::class, 'getWaters'])->name('getWaters');
Route::post('/filterProducts', [ProductController::class, 'filterProducts'])->name('filterProducts');
Route::post('/getSalePoints', [SaleFrontend::class, 'getSalePoints'])->name('getSalePoints');
Route::post('/resendActivationCode', [WebServiceController::class, 'resendActivationCode'])->name('resendActivationCode');
Route::post('/{cg}_{lg}/verifyUser', [UseractivationController::class, 'verifyUser'])->name('verifyUser');
Route::get('/{cg}_{lg}/logoutMe', [MyaccountController::class, 'logout'])->name('logoutMe');
Route::post('{cg}_{lg}/validateAccount', [ForgotmypasswordController::class, 'validatePasswordReset'])->name('validatePasswordReset');
Route::post('{lang}/resetPassword', [UpdatepasswordController::class, 'ResetPassword'])->name('ResetPassword');
Route::post('/subscription', [WebServiceController::class, 'Subscription'])->name('Subscription');
Route::post('/request-catalogue', [WebServiceController::class, 'SendCatalogue'])->name('SendCatalogue');


Route::post('registerMe', [RegisterController::class, 'register'])->name('registerMe');
Route::post('updateProfile', [WebServiceController::class, 'updateProfile'])->name('updateProfile');
Route::post('/loginMe', [LoginController::class, 'login'])->name('loginMe');
Route::get('/sitemap_index.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap/{country_group}-{language}.xml', [SitemapController::class, 'sitemaps'])->name('sitemap.sitemaps');
Route::group(['prefix' => 'mp-admin'], function () {
    Route::group(['middleware' => 'panel.auth'], function () {
        Route::get('SalePoints', [SalePointsController::class, 'index'])->name('panel.sale_points.index');
        Route::get('SalePoints/create', [SalePointsController::class, 'create'])->name('panel.sale_points.create');
        Route::get('SalePoints/edit/{sale_point}', [SalePointsController::class, 'edit'])->name('panel.sale_points.edit');
        Route::get('SalePoints/delete/{sale_point}', [SalePointsController::class, 'delete'])->name('panel.sale_points.delete');
        Route::get('SalePoints/getZones', [SalePointsController::class, 'getCityByCountryId'])->name('panel.sale_points.get_zones');
        Route::post('SalePoints/store', [SalePointsController::class, 'store'])->name('panel.sale_points.store');
        Route::post('SalePoints/update', [SalePointsController::class, 'update'])->name('panel.sale_points.update');
        Route::get('CategoryInfo', [WebServiceController::class, 'getCategoryInfo'])->name('panel.category.info');
        Route::post('SalePoints/import', [SalePointsController::class, 'import'])->name('panel.sale_points.import.post');
        Route::get('SalePoints/import', [SalePointsController::class, 'importView'])->name('panel.sale_points.import');
        Route::get('SalePoints/export', [SalePointsController::class, 'export'])->name('panel.sale_points.export');
    });
});

Route::group(['prefix' => 'mp-admin'], function () {
    Route::group(['middleware' => 'panel.auth'], function () {
        Route::get('CrmTracker', [CrmController::class, 'index'])->name('panel.crm.index');
        Route::get('CrmTracker/ajax',[CrmController::class, 'ajax'])->name('panel.crm.ajax');
        Route::get('CrmTracker/show/{crm_info}',[CrmController::class, 'show'])->name('panel.crm.show');
    });
});

Route::group(['prefix' => 'mp-admin'], function () {
    Route::group(['middleware' => 'panel.auth'], function () {
        Route::get('Cities', [CityController::class, 'dashboard'])->name('panel.city.dashboard');
        Route::get('Cities/{country_group_code}', [CityController::class, 'index'])->name('panel.city.index');
        Route::post('Cities/create/{country_group_code}', [CityController::class, 'store'])->name('panel.city.store');
        Route::post('Cities/update/', [CityController::class, 'update'])->name('panel.city.update');
        Route::get('Cities/edit/{country_group_code}/{slug}', [CityController::class, 'edit'])->name('panel.city.edit');
        Route::get('Cities/delete/{id}', [CityController::class, 'delete'])->name('panel.city.delete');
    });
});
