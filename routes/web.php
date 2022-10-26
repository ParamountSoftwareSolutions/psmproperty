<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return 'Configuration cache cleared! <br> Configuration cached successfully!';
});
Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    return 'Application cache cleared!';
});
Route::get('/view-clear', function () {
    Artisan::call('view:clear');
    return 'Application cache cleared!';
});

Route::get('/', function () {
    return view('login-index');
})->name('home');

Route::get('test-comments', 'PropertyManager\EmailController@test_comments');

Route::get('property-manager/webhook/users', 'propertymanager\WebHookController@testuser')->name('webhook.users');
Route::post('/webhook/addFbLead', 'propertymanager\WebHookController@addfblead')->name('webhook.addfblead');

Route::get('properties', function () {
    return view('front.pages.properties');
});
Route::get('agents', function () {
    return view('front.pages.agents');
});
Route::get('user', function () {
    return view('front.pages.user');
});
Route::get('faq', function () {
    return view('front.pages.faq');
});
Route::get('blog', function () {
    return view('front.pages.blog');
});
Route::get('gallery', function () {
    return view('front.pages.gallery');
});
Route::get('other', function () {
    return view('front.pages.gallery');
});
Route::get('contact', function () {
    return view('front.pages.contact');
});
Route::get('login', function () {
    return view('front.pages.login');
});
Route::get('register', function () {
    return view('front.pages.register');
});
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return 'Configuration cache cleared! <br> Configuration cached successfully!';
});
Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    return 'Application cache cleared!';
});
Route::get('/view-clear', function () {
    Artisan::call('view:clear');
    return 'Application cache cleared!';
});

Route::get('/send-email', 'PropertyManager\EmailController@sendMail' );

Route::get('building-inventries/{id}', [\App\Http\Controllers\PropertyManager\BuildingController::class, 'buildingInventries'])->name('building-inventries');

Route::post('reset-password', [\App\Http\Controllers\HomeController::class, 'resetPassword']);

Route::group(['middleware' => ['auth:web', 'isAdmin'], 'namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    /* Society Admin */
    Route::resource('society_admin', 'SocietyAdminController');
    Route::get('society_admin/activate/{society_admin}', 'SocietyAdminController@activate')->name('society_admin.activate');
    Route::get('society_admin/deactivate/{society_admin}', 'SocietyAdminController@deactivate')->name('society_admin.deactivate');
    /* Property Admin */
    Route::resource('property_admin', 'PropertyAdminController');
    Route::get('property_admin/activate/{property_admin}', 'PropertyAdminController@activate')->name('property_admin.activate');
    Route::get('property_admin/deactivate/{property_admin}', 'PropertyAdminController@deactivate')->name('property_admin.deactivate');

    /*Route::group(['prefix' => 'status'], function () {
        Route::get('user', 'StatusController@user');
        Route::get('society', 'StatusController@society');
        Route::get('employee', 'StatusController@employee');
        Route::get('agent', 'StatusController@agent');

        Route::get('delete/{id}', 'StatusController@delete');
        Route::post('add', 'StatusController@create');
        Route::post('add-type', 'StatusController@createStatusType');
    });

    Route::group(['prefix' => 'societies'], function () {
        Route::get('index', 'SocietiesController@index');

    });

    Route::group(['prefix' => 'society'], function () {
        Route::get('category', 'SocietyCategoryController@index');
        Route::get('category/delete/{category_id}/{field_id}', 'SocietyCategoryController@delete');
        Route::post('category', 'SocietyCategoryController@create');
        Route::get('category/edit/{id}', 'SocietyCategoryController@edit');
        Route::post('category/add-field/{id}', 'SocietyCategoryController@addField');

    });

    Route::group(['prefix' => 'noc'], function () {
        Route::get('/', 'NOCController@index');
        Route::post('add', 'NOCController@create');
        Route::get('delete/{id}', 'NOCController@delete');
    });

    Route::group(['prefix' => 'sector'], function () {
        Route::get('/', 'SectorController@index');
        Route::post('/add', 'SectorController@create');
        Route::get('delete/{id}', 'SectorController@delete');
    });

    Route::group(['prefix' => 'location'], function () {
        Route::get('province', 'LocationController@province');
        Route::get('province/delete/{id}', 'LocationController@deleteProvince');
        Route::post('province', 'LocationController@createProvince');
        Route::get('city', 'LocationController@city');
        Route::get('city/delete/{id}', 'LocationController@deleteCity');
        Route::post('city', 'LocationController@createCity');
    });*/
});

Route::group(['middleware' => ['auth:web', 'isSocietyAdmin'], 'namespace' => 'SocietyAdmin', 'prefix' => 'society_admin', 'as' => 'society_admin.'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('receipt', [\App\Http\Controllers\SocietyAdmin\DashboardController::class, 'receipt']);

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [\App\Http\Controllers\SocietyAdmin\ProfileController::class, 'index']);
        Route::get('edit', [\App\Http\Controllers\SocietyAdmin\ProfileController::class, 'edit']);
        Route::post('update', [\App\Http\Controllers\SocietyAdmin\ProfileController::class, 'update']);
    });
    Route::get('/get-categories', [\App\Http\Controllers\SocietyAdmin\SocietiesController::class, 'getJsonCategories']);
    Route::get('all-societies', [\App\Http\Controllers\SocietyAdmin\SocietiesController::class, 'index']);
    Route::post('add-new-society', [\App\Http\Controllers\SocietyAdmin\SocietiesController::class, 'create']);
    Route::get('details/{id}', [\App\Http\Controllers\SocietyAdmin\SocietiesController::class, 'get']);
    Route::get('details/plot/delete/{id}/{society_id}', [\App\Http\Controllers\SocietyAdmin\SocietiesController::class, 'deletePlotDetails']);
    Route::get('details/apartment/delete/{id}/{society_id}', [\App\Http\Controllers\SocietyAdmin\SocietiesController::class, 'deleteApartmentDetails']);

    Route::get('view-society/{id}', [\App\Http\Controllers\SocietyAdmin\SocietiesController::class, 'view']);
    Route::get('get/plot-details', [\App\Http\Controllers\SocietyAdmin\SocietiesController::class, 'getPlotDetails']);
    Route::post('updateSocietydata', [\App\Http\Controllers\SocietyAdmin\SocietiesController::class, 'updateSocietyDetails']);

    Route::get('employees', [\App\Http\Controllers\SocietyAdmin\EmployeeController::class, 'index']);

    Route::post('updatePayment', [\App\Http\Controllers\SocietyAdmin\SocietiesController::class, 'updatePaymentDetails']);

    Route::get('get/villa-details', [\App\Http\Controllers\SocietyAdmin\SocietiesController::class, 'getVillaDetails']);
    Route::get('get/apartment-details', [\App\Http\Controllers\SocietyAdmin\SocietiesController::class, 'getApartmentDetails']);
    Route::get('get/commercial-details', [\App\Http\Controllers\SocietyAdmin\SocietiesController::class, 'getCommercialDetails']);
});


//Route::group(['middleware' => ['auth:web', 'isSociety'], 'prefix' => 'society'], function () {
//    Route::get('/', [\App\Http\Controllers\Society\DashboardController::class, 'index']);
//
//    Route::group(['prefix' => 'profile'], function () {
//        Route::get('/', [\App\Http\Controllers\Society\ProfileController::class, 'index']);
//        Route::get('edit', [\App\Http\Controllers\Society\ProfileController::class, 'edit']);
//        Route::post('update', [\App\Http\Controllers\Society\ProfileController::class, 'update']);
//    });
//    Route::get('category/get-data', [\App\Http\Controllers\Society\SalesController::class, 'getCategoryHint']);
//    Route::get('category/get-additional-data', [\App\Http\Controllers\Society\SalesController::class, 'getCategoryDetails']);
//    Route::get('item/status', [\App\Http\Controllers\Society\SalesController::class, 'checkItemStatus']);
//    Route::get('search/user', [\App\Http\Controllers\Society\SalesController::class, 'searchUser']);
//    Route::group(['prefix' => 'sales'], function () {
//        Route::get('/', [\App\Http\Controllers\Society\SalesController::class, 'index']);
//        Route::post('/add', [\App\Http\Controllers\Society\SalesController::class, 'store']);
//        Route::get('/history/{id}', [\App\Http\Controllers\Society\SalesController::class, 'get']);
//    });
//    Route::resource('slider', \App\Http\Controllers\Society\SliderController::class);
//
//    Route::group(['prefix' => 'employee'], function () {
//        Route::get('/', [\App\Http\Controllers\Society\EmployeeController::class, 'index']);
//        Route::get('/permission/{employeeId}', [\App\Http\Controllers\Society\EmployeeController::class, 'permission']);
//        Route::post('/add', [\App\Http\Controllers\Society\EmployeeController::class, 'store']);
//        Route::post('permission', [\App\Http\Controllers\Society\EmployeeController::class, 'updatePermissions']);
//
//        Route::get('/delete/{employeeId}', [\App\Http\Controllers\Society\EmployeeController::class, 'delete']);
//
//        Route::get('/trash', [\App\Http\Controllers\Society\EmployeeController::class, 'getTrash']);
//        Route::get('/restore/{employeeId}', [\App\Http\Controllers\Society\EmployeeController::class, 'restore']);
//    });
//
////    add new Projects
//    Route::get('projects', [\App\Http\Controllers\Society\ProjectController::class, 'index']);
//    Route::get('projects/views', [\App\Http\Controllers\Society\ProjectController::class, 'view']);
//    Route::post('projects/store', [\App\Http\Controllers\Society\ProjectController::class, 'store']);
//    Route::get('projects/edit/{id}', [\App\Http\Controllers\Society\ProjectController::class, 'edit'])->name('project.edit');
//    Route::post('projects/update/{id}', [\App\Http\Controllers\Society\ProjectController::class, 'update']);
//
//    Route::resource('expense', \App\Http\Controllers\Society\ExpenseController::class);
//    Route::post('expense_report', [\App\Http\Controllers\Society\ExpenseController::class, 'generatePDF'])->name('expense_report');
//    Route::get('/send-notification', [\App\Http\Controllers\Society\NotificationController::class, 'sendOfferNotification']);
//
//
////    end Add new Projects
////    satart our  possessions Sections
//    Route::get('accounts', [\App\Http\Controllers\Society\PossessionController::class, 'account']);
//    Route::get('possessions', [\App\Http\Controllers\Society\PossessionController::class, 'index']);
//    Route::get('possessions/transfer', [\App\Http\Controllers\Society\PossessionController::class, 'trans']);
//
//    // satart our  possessions Sections
//
//    Route::group(['prefix' => 'hrm'], function () {
//        Route::get('/', [\App\Http\Controllers\Society\HRMController::class, 'index']);
//        Route::get('/attendance', [\App\Http\Controllers\Society\HRMController::class, 'getAttendance']);
//        Route::get('/attendance/history/{employeeId}', [\App\Http\Controllers\Society\HRMController::class, 'getAttendanceHistory']);
//
//        Route::group(['prefix' => 'payroll'], function () {
//            Route::get('/', [\App\Http\Controllers\Society\PayrollController::class, 'index']);
//            Route::get('/status/{id}', [\App\Http\Controllers\Society\PayrollController::class, 'getUpdateView']);
//            Route::post('/add', [\App\Http\Controllers\Society\PayrollController::class, 'store']);
//
//        });
//    });
//
//    Route::group(['prefix' => 'agent'], function () {
//        Route::get('/active', [\App\Http\Controllers\Society\AgentController::class, 'index']);
//        Route::get('/search', [\App\Http\Controllers\Society\AgentController::class, 'search']);
//
//        Route::get('details/{id}', [\App\Http\Controllers\Society\AgentController::class, 'details']);
//        Route::post('add', [\App\Http\Controllers\Society\AgentController::class, 'add']);
//    });
//
//    Route::group(['prefix' => 'installment'], function () {
//        Route::post('/add', [\App\Http\Controllers\Society\SalesController::class, 'updateInstallment']);
//    });
//
//    Route::group(['prefix' => 'leads'], function () {
//        Route::get('/', [\App\Http\Controllers\Society\LeadController::class, 'index']);
//        Route::get('/mature', [\App\Http\Controllers\Society\LeadController::class, 'matureLeads']);
//        Route::post('/add', [\App\Http\Controllers\Society\LeadController::class, 'store']);
//        Route::post('/make-client', [\App\Http\Controllers\Society\LeadController::class, 'makeClient']);
//    });
//
//
//    /* All About Route */
//    Route::get('about', [\App\Http\Controllers\Society\AboutController::class, 'index'])->name('about.index');
//    Route::get('about/edit/{id}', [\App\Http\Controllers\Society\AboutController::class, 'edit'])->name('about.edit');
//    Route::post('about/update/{id}', [\App\Http\Controllers\Society\AboutController::class, 'update'])->name('about.update');
//    /* All Term & Condition */
//    Route::get('term&condition', [\App\Http\Controllers\Society\TermConditionController::class, 'index'])->name('term.index');
//    Route::get('term&condition/edit/{id}', [\App\Http\Controllers\Society\TermConditionController::class, 'edit'])->name('term.edit');
//    Route::post('term&condition/update/{id}', [\App\Http\Controllers\Society\TermConditionController::class, 'update'])->name('term.update');
//    /* All Privacy Policy */
//    Route::get('privacyPolicy', [\App\Http\Controllers\Society\PrivacyPolicyController::class, 'index'])->name('privacyPolicy.index');
//    Route::get('privacyPolicy/edit/{id}', [\App\Http\Controllers\Society\PrivacyPolicyController::class, 'edit'])->name('privacyPolicy.edit');
//    Route::post('privacyPolicy/update/{id}', [\App\Http\Controllers\Society\PrivacyPolicyController::class, 'update'])->name('privacyPolicy.update');
//    /* All Faq */
//    Route::resource('faq', \App\Http\Controllers\Society\FaqController::class);
//    Route::resource('slider', \App\Http\Controllers\Society\SliderController::class);
//
//});


Route::group(['middleware' => ['auth:web', 'isPropertyAdmin'], 'namespace' => 'Property', 'prefix' => 'property', 'as' => 'property_admin.'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    /* Building And Floor Route start */
    Route::resource('building', 'BuildingController');
    Route::post('building/banner/remove', 'BuildingController@remove_image_banner');
    Route::get('building-detail-form', 'BuildingController@detail_form')->name('building.detail_form');
    Route::get('building_detail/{id}', 'FloorController@index')->name('building_detail.index');
    Route::get('building/{building_id}/floor/{floor_id}/index', 'FloorDetailController@index')->name('floor_detail.index');
    Route::get('building/{building_id}/floor/{floor_id}/create', 'FloorDetailController@create')->name('floor_detail.create');
    Route::post('building/{building_id}/floor/{floor_id}/store', 'FloorDetailController@store')->name('floor_detail.store');
    Route::get('building/{building_id}/floor/{floor_id}/edit/{id}', 'FloorDetailController@edit')->name('floor_detail.edit');
    Route::post('building/{building_id}/floor/{floor_id}/update/{id}', 'FloorDetailController@update')->name('floor_detail.update');
    Route::post('building/{building_id}/floor/{floor_id}/delete/{id}', 'FloorDetailController@destroy')->name('floor_detail.destroy');
    Route::post('building/{building_id}/floor/{floor_id}/index/filter', 'FloorDetailController@filter')->name('floor_detail.filter');

    /* Building Manager */
    Route::resource('manager', 'ManagerController');
    Route::get('property_admin/activate/{manager}', 'ManagerController@activate')->name('manager.activate');
    Route::get('property_admin/deactivate/{manager}', 'ManagerController@deactivate')->name('manager.deactivate');

    /* Building Sale Manager */
    Route::resource('sale_manager', 'SaleManagerController');
    Route::get('property_admin/sale_manager/activate/{manager}', 'SaleManagerController@activate')->name('sale_manager.activate');
    Route::get('property_admin/sale_manager/deactivate/{manager}', 'SaleManagerController@deactivate')->name('sale_manager.deactivate');

    /* Building ACCOUNTING Manager */
    //Route::resource('accounting_manager', 'ManagerController');
    Route::get('property_admin/activate/{manager}', 'ManagerController@activate')->name('manager.activate');
    Route::get('property_admin/deactivate/{manager}', 'ManagerController@deactivate')->name('manager.deactivate');

    /* Building And Floor Route end */
    //    Route::group(['prefix' => 'hrm'], function () {
    //        Route::get('/', [\App\Http\Controllers\Society\HRMController::class, 'index']);
    //        Route::get('/attendance', [\App\Http\Controllers\Society\HRMController::class, 'getAttendance']);
    //        Route::get('/attendance/history/{employeeId}', [\App\Http\Controllers\Society\HRMController::class, 'getAttendanceHistory']);

    /* Sales Route*/
    /*Route::resource('sale', 'ClientController');*/
    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
        Route::get('push-notification', 'SettingController@push_notification')->name('push_notification');
        Route::post('update-push-notification', 'SettingController@update_push_notification')->name('update_push_notification');
        Route::post('update-server-key', 'SettingController@update_server_key')->name('update_server_key');
    });
    Route::resource('employee', 'EmployeeController');
    /* Property Admin Profile */
    Route::get('profile', 'ProfileController@index')->name('profile.index');
    Route::post('profile/update', 'ProfileController@update')->name('profile.update');
    Route::post('profile/password/update', 'ProfileController@updatePassword')->name('profile.password.update');

    /* Notification */
    /*Route::get('notification/index', 'NotificationController@index');
    Route::get('notification/latest', 'NotificationController@latest');
    Route::get('notification/mark/read', 'NotificationController@mark_read_notification');
    Route::get('notification/mark/single/read/{id}', 'NotificationController@mark_single_read_notification');*/


});

/* Property Manager */
Route::group(['namespace' => 'PropertyManager', 'as' => 'property_manager.'], function () {
    Route::group(['middleware' => ['auth:web', 'isPropertyManager'], 'prefix' => 'property-manager'], function () {

        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::get('/custom_dashboard/{id}', 'DashboardController@custom_dashboard')->name('custom_building.dashboard');
        /* Building And Floor Route start */

//        Route::resource('building', 'BuildingController');
//        Route::get('building_detail/{id}', 'FloorController@index')->name('building_detail.index');
//        Route::get('building_view/{id}', 'BuildingController@building_view')->name('building_view');
//        // Flat Apartment and Shop Route
//        Route::get('generate-pdf/{id}','BuildingController@generatePDF')->name('generate-pdf');
//        Route::get('building/{building_id}/floor/{floor_id}/index', 'FloorDetailController@index')->name('floor_detail.index');
//        Route::get('building/{building_id}/floor/{floor_id}/create', 'FloorDetailController@create')->name('floor_detail.create');
//        Route::post('building/{building_id}/floor/{floor_id}/store', 'FloorDetailController@store')->name('floor_detail.store');
//        Route::get('building/{building_id}/floor/{floor_id}/edit/{id}', 'FloorDetailController@edit')->name('floor_detail.edit');
//        Route::post('building/{building_id}/floor/{floor_id}/update/{id}', 'FloorDetailController@update')->name('floor_detail.update');
//        Route::post('building/{building_id}/floor/{floor_id}/delete/{id}', 'FloorDetailController@destroy')->name('floor_detail.destroy');
//        Route::get('building/{building_id}/floor/{floor_id}/comments/{id}', 'FloorDetailController@comments')->name('floor_detail.comments');
//        Route::post('building/{building_id}/floor/{floor_id}/index/filter', 'FloorDetailController@filter')->name('floor_detail.filter');
//        Route::post('building/{building_id}/floor/{floor_id}/index/search', 'FloorDetailController@search')->name('floor_detail.search');
//        Route::post('floor_detail/change_status', 'FloorDetailController@change_status')->name('floor_detail.change_status');
//        Route::post('floor_detail/change_type', 'FloorDetailController@change_type')->name('floor_detail.change_type');
//        Route::get('client/sale_person/{client_id}', 'FloorDetailController@get_sale_person')->name('floor_detail.get_sale_person');
//        Route::post('building/floor-detail/image/remove', 'FloorDetailController@remove_image');
//        // Building Detail
//        Route::get('building-detail', 'BuildingDetailController@index')->name('building_details.index');
//        Route::get('building_details/create/{id}', 'BuildingDetailController@create')->name('building_details.create');
//        Route::post('building-detail/store/{id}', 'BuildingDetailController@store')->name('building_details.store');
//        Route::get('building-detail/edit/{id}', 'BuildingDetailController@edit')->name('building_details.edit');
//        Route::put('building-detail/update/{id}', 'BuildingDetailController@update')->name('building_details.update');
//        Route::post('banner-detail/payment-image/remove', 'BuildingDetailController@remove_image_payment')->name('building_detail/payment_image/remove');

        // Property
        Route::resource('property', 'PropertyController');
        Route::post('file-upload/upload-property-video-files', 'PropertyController@uploadPropertyFiles')->name('property.video.upload');
        Route::post('property-image/remove', 'PropertyController@removeImage');
        // Forms  => // MemberShip Form
        Route::resource('membership', 'MemberShipController');
        Route::get('membership-form-print/{id}', 'MemberShipController@printForm')->name('membership.print.form');
        /* Slider */
        Route::resource('banner', 'SliderController');
        Route::post('banner/remove', 'SliderController@banner_remove');
        Route::resource('custom_notification', 'CustomNotificationController');

        Route::get('hrm', 'HRMController@index');
        Route::resource('payment_plan', 'PaymentPlanController');
        //  Route::get('/attendance', [\App\Http\Controllers\Society\HRMController::class, 'getAttendance']);
        //  Route::get('/attendance/history/{employeeId}', [\App\Http\Controllers\Society\HRMController::class, 'getAttendanceHistory']);

        Route::resource('employee', 'EmployeeController');
        Route::resource('employee_payroll', 'EmployeePayrollController');
        Route::group(['prefix' => 'request', 'as' => 'request.'], function () {
            Route::get('/{type}', 'RequestController@index')->name('index');
            Route::get('/{type}/edit/{id}', 'RequestController@edit')->name('edit');
            Route::post('/{type}/update/{id}', 'RequestController@update')->name('update');
            Route::get('/{type}/destroy/{id}', 'RequestController@destroy')->name('destroy');
        });
        Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
            /*Route::get('/{type}', 'ReportController@index')->name('index');
            Route::post('/{type}/search/{time}', 'ReportController@search')->name('search');*/
            Route::get('/sale', 'ReportController@accountStatement')->name('sale');
            Route::get('/expense_report', 'ReportController@expenseSummary')->name('expense_report');
        });
        /* Route::group(['prefix' => 'leads'], function () {
             Route::get('/', 'LeadController@index');
             Route::get('/mature', 'LeadController@matureLeads');
             Route::post('/add', 'LeadController@store');
             Route::post('/make-client', 'LeadController@makeClient');
         });*/

        Route::resource('update', 'UpdateController');
        Route::post('file-upload/upload-large-files', 'UpdateController@uploadLargeFiles')->name('files.upload.large');
        Route::post('banner-image/remove', 'UpdateController@remove_image')->name('update.remove-image');
        Route::resource('expense', 'ExpenseController');
        Route::post('expense_report', 'ExpenseController@expense_report')->name('expense_report');
        Route::resource('office_expense', 'OfficeExpenseController');
        /* Property Manager Profile */
        Route::get('profile', 'ProfileController@index')->name('profile.index');
        Route::post('profile/update', 'ProfileController@update')->name('profile.update');
        Route::post('profile/password/update', 'ProfileController@updatePassword')->name('profile.password.update');
        /* All Page Route */
        Route::resource('about', 'AboutController')->except(['show']);
        Route::resource('privacyPolicy', 'PrivacyPolicyController')->except(['show']);
        Route::resource('faq', 'FaqController');
        Route::resource('term', 'TermController');

        // Email //
        // Email //
        Route::get('email/compose', 'EmailController@email_compose')->name('email.compose');
        Route::post('email/compose/send', 'EmailController@email_compose_send')->name('email.compose.send');
    });
    //=============//
    /* Sales Route */
    //=============//
    Route::group(['middleware' => ['auth:web', 'isAuthType'], 'prefix' => '{panel}'], function () {
        Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {
            //dd($panel);
            //Route::group(['prefix' => $panel], function () {
            Route::resource('lead', 'LeadController');

            //New Routes Added
            Route::get('lead/building_info/{building_id}', 'LeadController@buildinginfo')->name('lead.building_info');
            Route::post('lead/filter', 'LeadController@filter')->name('lead.filter');
            Route::post('lead/search', 'LeadController@search')->name('lead.search');
            Route::post('lead/searchbydate', 'LeadController@searchbydate')->name('lead.searchByDate');
            Route::post('lead/change_status', 'LeadController@changestatus')->name('lead.change_status');
            Route::get('lead/change_priority/{priority}/{id}', 'LeadController@changepriority')->name('lead.change_priority');
            Route::get('lead/comments/{id}', 'LeadController@comments')->name('lead.comments');
            Route::any('lead-assign', 'LeadController@lead_assign')->name('lead.assign');
            Route::get('is-read/', 'LeadController@isread')->name('lead.isread');
            Route::get('meeting-read/', 'LeadController@meetingread')->name('lead.meetingread');
            Route::get('follow-up/', 'LeadController@followup')->name('lead.followup');
            //End New Routes
            Route::resource('client', 'ClientController');

            //New Routes Addedx
            Route::get('old-client/data/{id}', 'ClientController@old_client')->name('old_client');
            Route::post('client/filter', 'ClientController@filter')->name('client.filter');
            Route::post('client/search', 'ClientController@search')->name('client.search');
            Route::post('client/searchbydate', 'ClientController@searchbydate')->name('client.searchByDate');
            Route::get('client/change_status/check_data/{id}', 'ClientController@checkData')->name('client.check_data');
            Route::post('client/change_status', 'ClientController@changestatus')->name('client.change_status');
            Route::get('sale/history', 'ClientController@history')->name('client.history');
            Route::get('client/comments/{id}', 'ClientController@comments')->name('client.comments');
            //End New Routes

            Route::post('client/installment/edit/{id}', 'ClientController@installment_edit')->name('client.installment.edit');
            //Route::get('client/installment/un-paid/{id}', 'ClientController@un_paid')->name('client.installment.un_paid');
            Route::get('/online_booking/index', 'OnlineBookingController@index')->name('online_booking.index');
            Route::get('/online_booking/delete', 'OnlineBookingController@destroy')->name('online_booking.destroy');

            Route::get('building/{id}', 'LeadController@building');
            Route::get('floor/{id}/{building_id}', 'LeadController@floor');

            Route::get('state/{country_id}', 'ClientController@state');
            Route::get('city/{state_id}', 'ClientController@city');
            Route::get('lead/bulk/import/view', 'LeadController@import_view')->name('import.view');
            Route::post('lead/bulk/import/', 'LeadController@bulk_import_data')->name('bulk.import');
            Route::get('lead/bulk/export/', 'LeadController@bulk_export_data')->name('bulk.export');
            route::post('lead/pushed', 'LeadController@pushed')->name('lead.push');
            route::post('lead/arrange', 'LeadController@arrange')->name('lead.arrange');

            //});
        });
        Route::get('/webhook', 'WebHookController@index')->name('webhook.index');
        Route::get('/webhook/show', 'WebHookController@show')->name('webhook.show');
		 Route::get('/webhook/leads_form/{page_id}/{token}', 'WebHookController@leads_form')->name('webhook.leads_form');
        Route::get('/webhook/leads/{page_id}/{token}', 'WebHookController@leads')->name('webhook.leads');
		 Route::get('/webhook/lead_assign_to_mangers/{page_id}/{token}', 'WebHookController@lead_assign_to_mangers')->name('webhook.lead_assign_to_mangers');
        Route::get('/webhook/lead_assign_to_sale_person/{page_id}/{token}', 'WebHookController@lead_assign_to_sale_person')->name('webhook.lead_assign_to_sale_person');
        /*Notification*/
           /*Notification*/
        Route::get('notification/index', 'NotificationController@index')->name('notification.index');
        Route::get('notifications/latest', 'NotificationController@latest')->name('notification.latest');
        Route::get('notification/mark/read', 'NotificationController@mark_read_notification')->name('notification.all_read');
        Route::get('notification/mark/single/read/{id}', 'NotificationController@mark_single_read_notification')->name('notification.single_read');
		Route::get('meeting-alert', 'NotificationController@meeting_alert')->name('meeting_alert');
		Route::get('today-meeting-count', 'NotificationController@today_meeting_count')->name('today_meeting_count');
        Route::get('today-count-read', 'NotificationController@today_count_read')->name('today_count_read');
        Route::get('check-count-read', 'NotificationController@check_count_read')->name('check_count_read');
        Route::get('today-follow-up-count', 'NotificationController@today_follow_up_count')->name('today_follow_up_count');
    });

    //=============//
    /* Project Route */
    //=============//
    Route::group(['middleware' => ['auth:web', 'isAuthType'], 'prefix' => '{panel}'], function () {
        Route::resource('building', 'BuildingController');
        Route::get('building_detail/{id}', 'FloorController@index')->name('building_detail.index');
        Route::get('building_view/{id}', 'BuildingController@building_view')->name('building_view');
        // Flat Apartment and Shop Route
        Route::get('generate-pdf/{id}','BuildingController@generatePDF')->name('generate-pdf');
        Route::get('building/{building_id}/floor/{floor_id}/index', 'FloorDetailController@index')->name('floor_detail.index');
        Route::get('building/{building_id}/floor/{floor_id}/create', 'FloorDetailController@create')->name('floor_detail.create');
        Route::post('building/{building_id}/floor/{floor_id}/store', 'FloorDetailController@store')->name('floor_detail.store');
        Route::get('building/{building_id}/floor/{floor_id}/edit/{id}', 'FloorDetailController@edit')->name('floor_detail.edit');
        Route::post('building/{building_id}/floor/{floor_id}/update/{id}', 'FloorDetailController@update')->name('floor_detail.update');
        Route::delete('building/{building_id}/floor/{floor_id}/delete/{id}', 'FloorDetailController@destroy')->name('floor_detail.destroy');
        Route::get('building/{building_id}/floor/{floor_id}/comments/{id}', 'FloorDetailController@comments')->name('floor_detail.comments');
        Route::post('building/{building_id}/floor/{floor_id}/index/filter', 'FloorDetailController@filter')->name('floor_detail.filter');
        Route::post('building/{building_id}/floor/{floor_id}/index/search', 'FloorDetailController@search')->name('floor_detail.search');
        Route::post('floor_detail/change_status', 'FloorDetailController@change_status')->name('floor_detail.change_status');
        Route::post('floor_detail/change_type', 'FloorDetailController@change_type')->name('floor_detail.change_type');
        Route::get('client/sale_person/{client_id}', 'FloorDetailController@get_sale_person')->name('floor_detail.get_sale_person');
        Route::post('building/floor-detail/image/remove', 'FloorDetailController@remove_image');
        // Building Detail
        Route::get('building-detail', 'BuildingDetailController@index')->name('building_details.index');
        Route::get('building_details/create/{id}', 'BuildingDetailController@create')->name('building_details.create');
        Route::post('building-detail/store/{id}', 'BuildingDetailController@store')->name('building_details.store');
        Route::get('building-detail/edit/{id}', 'BuildingDetailController@edit')->name('building_details.edit');
        Route::put('building-detail/update/{id}', 'BuildingDetailController@update')->name('building_details.update');
        Route::post('banner-detail/payment-image/remove', 'BuildingDetailController@remove_image_payment')->name('building_detail/payment_image/remove');
   
   //====================//
    	/* Task Targets Route */
    	//====================//
        Route::get('my-targets', 'TargetController@my_targets')->name('my_targets');
        Route::get('staff-targets', 'TargetController@staff_targets')->name('staff_targets');
        Route::get('assign-target', 'TargetController@assign_target')->name('assign_target');
        Route::post('store', 'TargetController@store')->name('store');
        Route::get('get-role-list/{role}', 'TargetController@get_role_list')->name('get_role_list');
        Route::get('edit-task/{id}', 'TargetController@edit_task')->name('edit_task');
        Route::post('update-task/{id}', 'TargetController@update_task')->name('update_task');
        Route::get('task-reports', 'TargetController@task_reports')->name('task_reports');
		
        //==============//
        /* Email Route */
        //==============//
        Route::get('email/compose', 'EmailController@email_compose')->name('email.compose');
        Route::post('email/compose/send', 'EmailController@email_compose_send')->name('email.compose.send');
		
		//==============//
    	/* Income Route */
    	//==============//
        Route::get('income/report', 'IncomeController@incomeSummary')->name('income.report');
    	Route::resource('income', 'IncomeController');
   
    });
    
});

Route::group(['middleware' => ['auth:web', 'isSaleManager'], 'prefix' => 'sale-manager', 'as' => 'sale_manager.'], function () {
    Route::group(['namespace' => 'SaleManager'], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::resource('employee', 'EmployeeController');

        /* Property Admin Profile */
        Route::get('profile', 'ProfileController@index')->name('profile.index');
        Route::post('profile/update', 'ProfileController@update')->name('profile.update');
        Route::post('profile/password/update', 'ProfileController@updatePassword')->name('profile.password.update');
    });
});
Route::group(['middleware' => ['auth:web', 'isSalePerson'], 'namespace' => 'SalePerson', 'prefix' => 'sale-person', 'as' => 'sale_person.'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    /* Property Admin Profile */
    Route::get('profile', 'ProfileController@index')->name('profile.index');
    Route::post('profile/update', 'ProfileController@update')->name('profile.update');
    Route::post('profile/password/update', 'ProfileController@updatePassword')->name('profile.password.update');
});

Route::group(['middleware' => ['auth:web', 'isAccountant'], 'namespace' => 'Accountant', 'prefix' => 'accountant', 'as' => 'accountant.'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('hrm', 'HRMController@index');
    /*Route::resource('payment_plan', 'PaymentPlanController');*/
//  Route::get('/attendance', [\App\Http\Controllers\Society\HRMController::class, 'getAttendance']);
//  Route::get('/attendance/history/{employeeId}', [\App\Http\Controllers\Society\HRMController::class, 'getAttendanceHistory']);

    Route::resource('employee', 'EmployeeController');
    Route::resource('employee_payroll', 'EmployeePayrollController');
    Route::resource('expense', 'ExpenseController');
    Route::post('expense_report', 'ExpenseController@expense_report')->name('expense_report');
    Route::resource('office_expense', 'OfficeExpenseController');
    Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
        /*Route::get('/{type}', 'ReportController@index')->name('index');
        Route::post('/{type}/search/{time}', 'ReportController@search')->name('search');*/
        Route::get('/sale', 'ReportController@accountStatement')->name('sale');
        Route::get('/expense_report', 'ReportController@expenseSummary')->name('expense_report');
    });

    /* Property Admin Profile */
    Route::get('profile', 'ProfileController@index')->name('profile.index');
    Route::post('profile/update', 'ProfileController@update')->name('profile.update');
    Route::post('profile/password/update', 'ProfileController@updatePassword')->name('profile.password.update');
});

Route::group(['middleware' => ['auth:web', 'isAccountant'], 'namespace' => 'Accountant', 'prefix' => 'accountant', 'as' => 'accountant.'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('hrm', 'HRMController@index');
    /*Route::resource('payment_plan', 'PaymentPlanController');*/
    //  Route::get('/attendance', [\App\Http\Controllers\Society\HRMController::class, 'getAttendance']);
    //  Route::get('/attendance/history/{employeeId}', [\App\Http\Controllers\Society\HRMController::class, 'getAttendanceHistory']);

    Route::resource('employee', 'EmployeeController');
    Route::resource('employee_payroll', 'EmployeePayrollController');
    Route::resource('expense', 'ExpenseController');
    Route::post('expense_report', 'ExpenseController@expense_report')->name('expense_report');
    Route::resource('office_expense', 'OfficeExpenseController');
    Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
        /*Route::get('/{type}', 'ReportController@index')->name('index');
        Route::post('/{type}/search/{time}', 'ReportController@search')->name('search');*/
        Route::get('/sale', 'ReportController@accountStatement')->name('sale');
        Route::get('/expense_report', 'ReportController@expenseSummary')->name('expense_report');
    });

    /* Property Admin Profile */
    Route::get('profile', 'ProfileController@index')->name('profile.index');
    Route::post('profile/update', 'ProfileController@update')->name('profile.update');
    Route::post('profile/password/update', 'ProfileController@updatePassword')->name('profile.password.update');
});

Route::group(['middleware' => ['auth:web', 'isAgent'], 'prefix' => 'agent'], function () {
    Route::get('/', [\App\Http\Controllers\Agent\DashboardController::class, 'index']);
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [\App\Http\Controllers\Agent\ProfileController::class, 'index']);
        Route::get('edit', [\App\Http\Controllers\Agent\ProfileController::class, 'edit']);
        Route::post('update', [\App\Http\Controllers\Agent\ProfileController::class, 'update']);
    });

    Route::group(['prefix' => 'properties'], function () {
        Route::get('active', [\App\Http\Controllers\Agent\PropertyController::class, 'index']);
        Route::post('add', [\App\Http\Controllers\Agent\PropertyController::class, 'add']);
        Route::post('update', [\App\Http\Controllers\Agent\PropertyController::class, 'update']);
        Route::get('view/{id}', [\App\Http\Controllers\Agent\PropertyController::class, 'view']);
        Route::get('delete/{id}', [\App\Http\Controllers\Agent\PropertyController::class, 'delete']);
        Route::get('restore/{id}', [\App\Http\Controllers\Agent\PropertyController::class, 'restore']);
        Route::get('trash', [\App\Http\Controllers\Agent\PropertyController::class, 'trashView']);
        Route::post('update-status', [\App\Http\Controllers\Agent\PropertyController::class, 'updateStatus']);
    });

    Route::group(['prefix' => 'apartments'], function () {
        Route::get('active', [\App\Http\Controllers\Agent\ApartmentController::class, 'index']);
        Route::get('view/{id}', [\App\Http\Controllers\Agent\ApartmentController::class, 'getDetails']);
        Route::post('add', [\App\Http\Controllers\Agent\ApartmentController::class, 'insert']);
        Route::post('flats/add', [\App\Http\Controllers\Agent\ApartmentController::class, 'addFlats']);
        Route::get('sale/history/{id}', [\App\Http\Controllers\Agent\ApartmentController::class, 'saleHistory']);

        Route::get('sale/installment/{id}', [\App\Http\Controllers\Agent\ApartmentController::class, 'getInstallmentDetails']);

        Route::post('installment-detail/add', [\App\Http\Controllers\Agent\ApartmentController::class, 'addInstallmentDetail']);

        Route::post('update-installment', [\App\Http\Controllers\Agent\ApartmentController::class, 'updateInstallment']);
    });

    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', [\App\Http\Controllers\Agent\EmployeeController::class, 'index']);
        Route::post('/add', [\App\Http\Controllers\Agent\EmployeeController::class, 'store']);

        Route::get('/permission/{employeeId}', [\App\Http\Controllers\Agent\EmployeeController::class, 'permission']);
        Route::post('permission', [\App\Http\Controllers\Agent\EmployeeController::class, 'updatePermissions']);
        Route::get('/delete/{employeeId}', [\App\Http\Controllers\Agent\EmployeeController::class, 'delete']);
        Route::get('/trash', [\App\Http\Controllers\Agent\EmployeeController::class, 'getTrash']);
        Route::get('/restore/{employeeId}', [\App\Http\Controllers\Agent\EmployeeController::class, 'restore']);
    });

    Route::group(['prefix' => 'societies'], function () {
        Route::get('active', [\App\Http\Controllers\Agent\SocietyController::class, 'index']);
        Route::get('view/{id}', [\App\Http\Controllers\Agent\SocietyController::class, 'view']);
        Route::get('plot/status', [\App\Http\Controllers\Agent\SocietyController::class, 'checkPlotStatus']);
        Route::post('sale', [\App\Http\Controllers\Agent\SocietyController::class, 'sale']);
        Route::post('installment/add', [\App\Http\Controllers\Agent\SocietyController::class, 'updateInstallment']);
        Route::get('sale-data/{id}', [\App\Http\Controllers\Agent\SocietyController::class, 'saleData']);
        Route::get('history/{start}', [\App\Http\Controllers\Agent\SocietyController::class, 'history']);
        Route::get('category/get-additional-data', [\App\Http\Controllers\Agent\SocietyController::class, 'getCategoryDetails']);
    });
    Route::get('search/user', [\App\Http\Controllers\Agent\SocietyController::class, 'searchUser']);
});

Auth::routes();
Route::post('/check-username', [\App\Http\Controllers\HomeController::class, 'checkUsername']);
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  //=============//
    /* Acccounts */
    //=============//

Route::group(['prefix' => 'accounts'], function () {
    Route::get('C_O_A', [\App\Http\Controllers\AccountsController::class, 'C_O_A']);
    Route::get('show_tree', [\App\Http\Controllers\AccountsController::class, 'show_tree'])->name('accounts.show_tree');
    Route::post('insert_coa2', [\App\Http\Controllers\AccountsController::class, 'insert_coa2'])->name('accounts.insert_coa2');
    Route::post('selectphead', [\App\Http\Controllers\AccountsController::class, 'selectphead']);
    Route::get('selectedform/{id}', [\App\Http\Controllers\AccountsController::class, 'selectedform']);
    Route::get('updatecoa/{id}', [\App\Http\Controllers\AccountsController::class, 'updatecoa']);
    Route::get('deletehead/{id}', [\App\Http\Controllers\AccountsController::class, 'deletehead']);

    Route::get('debit_voucher', [\App\Http\Controllers\AccountsController::class, 'debit_voucher'])->name('accounts.debit_voucher');
    Route::get('debtvouchercode/{id}', [\App\Http\Controllers\AccountsController::class, 'debtvouchercode'])->name('accounts.debtvouchercode');
    Route::post('create_debit_voucher', [\App\Http\Controllers\AccountsController::class, 'create_debit_voucher'])->name('accounts.create_debit_voucher');

    Route::get('credit_voucher', [\App\Http\Controllers\AccountsController::class, 'credit_voucher'])->name('accounts.credit_voucher');
    Route::post('create_credit_voucher', [\App\Http\Controllers\AccountsController::class, 'create_credit_voucher'])->name('accounts.create_credit_voucher');

    Route::get('contra_voucher', [\App\Http\Controllers\AccountsController::class, 'contra_voucher'])->name('accounts.contra_voucher');
    Route::post('update_contra_voucher', [\App\Http\Controllers\AccountsController::class, 'update_contra_voucher'])->name('accounts.update_contra_voucher');
    Route::post('create_contra_voucher', [\App\Http\Controllers\AccountsController::class, 'create_contra_voucher'])->name('accounts.create_contra_voucher');

    Route::get('journal_voucher', [\App\Http\Controllers\AccountsController::class, 'journal_voucher'])->name('accounts.journal_voucher');
    Route::post('create_journal_voucher', [\App\Http\Controllers\AccountsController::class, 'create_journal_voucher'])->name('accounts.create_journal_voucher');
    Route::get('aprove_v', [\App\Http\Controllers\AccountsController::class, 'aprove_v'])->name('accounts.aprove_v');

    Route::get('voucher_update/{id}', [\App\Http\Controllers\AccountsController::class, 'voucher_update'])->name('accounts.voucher_update');
    Route::get('visactive/{id}', [\App\Http\Controllers\AccountsController::class, 'isactive'])->name('accounts.isactive');

    Route::get('trial_balance', [\App\Http\Controllers\AccountsController::class, 'trial_balance'])->name('accounts.trial_balance');
    Route::post('trial_balance_report', [\App\Http\Controllers\AccountsController::class, 'trial_balance_report'])->name('accounts.trial_balance_report');

    Route::get('vouchar_cash/{date}', [\App\Http\Controllers\AccountsController::class, 'vouchar_cash']);
    Route::get('general_ledger', [\App\Http\Controllers\AccountsController::class, 'general_ledger'])->name('accounts.general_ledger');
    Route::post('general_led', [\App\Http\Controllers\AccountsController::class, 'general_led'])->name('accounts.general_led');

    Route::post('accounts_report_search', [\App\Http\Controllers\AccountsController::class, 'accounts_report_search'])->name('accounts.accounts_report_search');
    Route::get('check_status_report', [\App\Http\Controllers\AccountsController::class, 'check_status_report']);
    Route::any('cash_book', [\App\Http\Controllers\AccountsController::class, 'cash_book'])->name('accounts.cash_book');
    Route::any('bank_book', [\App\Http\Controllers\AccountsController::class, 'bank_book'])->name('accounts.bank_book');
    Route::get('voucher_report', [\App\Http\Controllers\AccountsController::class, 'voucher_report'])->name('accounts.voucher_report');
    Route::post('voucher_report_serach', [\App\Http\Controllers\AccountsController::class, 'voucher_report_serach'])->name('accounts.voucher_report_serach');
    Route::get('coa_print', [\App\Http\Controllers\AccountsController::class, 'coa_print'])->name('accounts.coa_print');
    Route::get('profit_loss_report', [\App\Http\Controllers\AccountsController::class, 'profit_loss_report'])->name('accounts.profit_loss_report');
    Route::post('profit_loss_report_search', [\App\Http\Controllers\AccountsController::class, 'profit_loss_report_search'])->name('accounts.profit_loss_report_search');
    Route::get('cash_flow_report', [\App\Http\Controllers\AccountsController::class, 'cash_flow_report'])->name('accounts.cash_flow_report');
    Route::post('cash_flow_report_search', [\App\Http\Controllers\AccountsController::class, 'cash_flow_report_search'])->name('accounts.cash_flow_report_search');
    Route::get('supplier_headcode/{id}', [\App\Http\Controllers\AccountsController::class, 'supplier_headcode']);
    Route::get('supplier_payments', [\App\Http\Controllers\AccountsController::class, 'supplier_payments'])->name('accounts.supplier_payments');
    Route::post('banklist', [\App\Http\Controllers\AccountsController::class, 'banklist']);
    Route::post('create_supplier_payment', [\App\Http\Controllers\AccountsController::class, 'create_supplier_payment'])->name('accounts.create_supplier_payment');
    Route::get('supplier_paymentreceipt/{supplier_id}/{voucher_no}/{coaid}', [\App\Http\Controllers\AccountsController::class, 'supplier_paymentreceipt'])->name('accounts.supplier_paymentreceipt');
    Route::get('cash_adjustment', [\App\Http\Controllers\AccountsController::class, 'cash_adjustment'])->name('accounts.cash_adjustment');
    Route::post('create_cash_adjustment', [\App\Http\Controllers\AccountsController::class, 'create_cash_adjustment'])->name('accounts.create_cash_adjustment');
    Route::any('balance_sheet', [\App\Http\Controllers\AccountsController::class, 'balance_sheet'])->name('accounts.balance_sheet');
});
  //=============//
    /* Acccounts */
    //=============//