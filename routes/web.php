<?php


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



//////////////////////services/////////////////////
                ///services Admin//////
    Route::get('services', 'ServicesController@indexAdmin');//لعرض كل الخدمات عند الادمن//
    Route::get('/details_service/{id}', 'ServicesController@getServicesDetails');//لعرض تفاصيل الخدمة عند الادمن//
    Route::get('/ServicesSubSections/{id}', 'ServicesController@getServicesSubSections');//لعرض الخدمات بلقسم الفرعي //
    Route::get('/approval/{id}', 'AdminController@approval'); //لقبول الخدمة//
    Route::get('/cancel/{id}', 'AdminController@cancel');//لرفض الخدمة//
    Route::get('MarkAsReadAll', 'ServicesController@MarkAsReadAll');//لجعل كل الاشعارات مقروءة ///
                /////services user///
    Route::resource('userservices', 'ServicesController');//لعمليات الخدمة(حذف,أضافة,تعديل ) عند المقدم//
    Route::get('/all_services','ServicesController@showAllServices')->name('all_services');//لعرض كل خدمات الموقع //
    Route::get('/user_details_service/{id}', 'ServicesController@index2');//لعرض تفاصيل الخدمة عند المقدم//
///////////////////////////////////////////////////

//////////////////////orders///////////////////////
           //////admin orders/////////
    Route::get('/All_Orders', 'OrderController@All_Orders');// عرض جميع الطلبات//
    Route::get('/Fullfilled_Orders', 'OrderController@Fullfilled_Orders');//عرض الطلبات المنفذة//
    Route::get('/Partially_Fullfilled_Orders', 'OrderController@Partially_Fullfilled_Orders');//عرض الطلبات قيد التنفيذ//
    Route::get('/UnFullfilled_Orders', 'OrderController@UnFullfilled_Orders');//عرض الطلبات غير المنفذة//
    Route::get('/details_order/{id}', 'OrderController@show');//عرض تفاصيل الطلب//
    Route::resource('Archive', 'ArchiveOrderController');//أرشفة الطلبات//
    Route::get('export_orders', 'OrderController@export');//تصدير الطلبات كأكسيل//
            ///////customers orders/////////
    Route::resource('orders', 'OrderController');//لأدراة الطلبات(أضافة,حذف,تعديل)//
    Route::get('user_order/create/{id}','OrderController@create');//لأنشاء الطلب(شراء خدمة)//
    Route::get('/customer_order','OrderController@index2');//عرض الطلبات عند المشتري//
    Route::get('view_file/{id}','OrderController@viewFile');//عرض مرفقات الطلب//
    Route::get('open/{order_number}/{file_name}', 'OrderController@open_file');//فتح الملف //
    Route::get('download/{order_number}/{file_name}', 'OrderController@download_file');//تحميل الملف//
    Route::resource('OrderAttachments', 'AttachmentsOrderController');//مرفقات الطلب //
            /////////provider orders////////
    Route::get('/providerOrders','OrderController@index_provider');//لعرض طلبات الوارة للمقدم//
    Route::get('/provider_status_show/{id}', 'OrderController@status_show')->name('provider_status_show');//لشاهد حالة الطلب //
    Route::post('/provider_status_update/{id}', 'OrderController@status_update')->name('provider_status_update');//عدل حالة الطلب//
    Route::get('/provider_details_order/{id}', 'OrderController@show_provider');//شوف تفاصيل الطلب ومرفقاته //
    Route::post('provider_delete_file', 'OrderController@destroyfile')->name('provider_delete_file');//لحذف مرفق //
    // Route::post('provider_reject_order','OrderController@');
///////////////////////////////////////////////////

//////////////////////sections/////////////////////
    Route::resource('sections', 'SectionsController');
    Route::get('/subsections/{id}', 'SectionsController@getSubSections');
///////////////////////////////////////////////////

//////////////////////profile//////////////////////
    Route::resource('profile','ProfileController');
    Route::get('/profile/{service_id}/{provider_id}','ProfileController@services_of_provider')->name('profile.services');
    Route::get('/user_profile/{id}','ProfileController@index2');
///////////////////////////////////////////////////

/////////add & remove friend//////////////////////
    Route::get('addfriend/{id}','ProfileController@addFriend');
    Route::delete('remove_friend/{id}','ProfileController@removeFriend')->name('remove_friend');
/////////////////////////////////////////////////

//////////////////////rating&review////////////////
    Route::post('add_rating','RatingController@add');
    Route::get('add-review/{service_id}/userreview','ReviewController@add');
    Route::post('add-review','ReviewController@create');
    Route::get('edit-review/{service_id}/userreview','ReviewController@edit');
    Route::put('update-review','ReviewController@update');
///////////////////////////////////////////////////

//////////////////////Order_report/////////////////
    Route::get('orders_report','ReportController@index');
    Route::post('search_orders','ReportController@search_orders');
    Route::get('profits_report','ReportController@index1');
    Route::post('search_profits','ReportController@search_profits');
    Route::get('customers_report','ReportController@index2');
    Route::post('search_customers','ReportController@search_customers');
///////////////////////////////////////////////////

//////////////////////Roles////////////////////////
    Route::group(['middleware' => ['auth']],
    function()
    {
        Route::resource('roles','RoleController');
        Route::resource('users','UserController');

    });
///////////////////////////////////////////////////

Route::get('/','GuestController@GetTemp');
Auth::routes();
Route::get('/dashboard', 'AdminController@index')->name('dashboard');
Route::get('/landing', 'AdminController@landing')->name('landing');
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('PreventBackHistory');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/chat', 'HomeController@index2')->name('chat');
Route::get('/user', 'UserController@index2')->name('user')->middleware('PreventBackHistory');

Route::get('/auth/redirect/{provider}','Auth\SocialiteController@redirect');
Route::get('/auth/callback/{provider}','Auth\SocialiteController@callback');


Route::get('/{page}', 'AdminController@index');
