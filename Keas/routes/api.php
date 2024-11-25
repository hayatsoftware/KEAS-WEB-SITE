<?php

use Illuminate\Http\Request;

use App\Http\Controllers\Api\CountriesController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\SalePointsController;
use App\Http\Controllers\Api\JobsController;
use App\Http\Controllers\Api\CrmProductsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KvkkController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\DecorController;
use App\Http\Controllers\Api\SurfaceController;
use App\Http\Controllers\Api\ExtraFeatureController;
use App\Http\Controllers\Api\TextureController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/getCountries', [CountriesController::class, 'index']);
Route::get('/getCountriesTurkishValue', [CountriesController::class, 'getCountriesListTurkishValue']);
Route::post('/getCountriesWithZone', [CountriesController::class, 'getCountriesList']);
Route::post('/getZoneInfo', [CountriesController::class, 'getZoneInfo']);
Route::get('/getLanguagesByCountryId', [LanguageController::class, 'index']);
Route::post('/getLanguagesByZone', [LanguageController::class, 'getLanguagesByZone']);
Route::post('/getLanguagesByCountry', [LanguageController::class, 'getLanguagesByCountry']);
Route::post('/aboutUs', [AboutUsController::class, 'index']);
Route::post('/kvkk', [KvkkController::class, 'index']);
Route::post('/salePointsData', [SalePointsController::class, 'getData']);
Route::post('/salePointCity', [SalePointsController::class, 'getCities']);
Route::post('/salePoints', [SalePointsController::class, 'getSalePoints']);
Route::get('/jobs', [JobsController::class, 'index']);
Route::get('/preferred-products', [CrmProductsController::class, 'index']);
Route::post('/getCategories', [CategoryController::class, 'getCategories']);
Route::post('/getProducts', [ProductsController::class, 'index']);
Route::post('/getSubCategories', [CategoryController::class, 'getSubCategories']);
Route::post('/getBrands', [BrandController::class, 'index']);
Route::post('/getFilters', [ProductsController::class, 'getFilters']);
Route::post('/product', [ProductsController::class, 'product']);
Route::post('/searchProduct', [ProductsController::class, 'searchProduct']);
Route::get('/auth', function (Request $request) {
    return [
        'status' => Auth::guard('api')->check()
    ];
});

Route::group(['middleware' => ['throttleCustom:5,1']], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/request-password', [AuthController::class, 'requestPassword']);
    Route::post('/resend-password-code', [AuthController::class, 'reSendPasswordResetCode']);
    Route::post('/validate-password-code', [AuthController::class, 'validatePasswordCode']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});

Route::group(['middleware'=>['auth:api']], function(){
    Route::post('/resend-verification-code', [AuthController::class, 'reSendVerificationCode']);
    Route::post('/activation', [AuthController::class, 'activation']);
    Route::get('/user', function (Request $request) {
        $user = $request->user();
        if($user->status != 1){
            return [
                'status' => 0,
                'type' => 'NEED_ACTIVATION',
                'user' => $user
            ];
        }
        $phone_data = explode(' ',$user->phone);
        $user->dial_code = str_replace('+', '', $phone_data[0]);
        $user->products = collect($user->data['products']);
        $user->job = intval($user->data['job']);
        $user->products = $user->products->map(function($item){
            return intval($item);
        });
        $user->phone_org = str_replace(" ", "", $user->data['phone_original']);
        return [
            'status' => 1,
            'user' => $user
        ];
    });
    Route::post('/update-user', [AuthController::class, 'updateUser']);
    Route::get('/logout', function(Request $request){
        $user = $request->user();
        $user->token()->revoke();
        return ['status' => 1];
    });
});





