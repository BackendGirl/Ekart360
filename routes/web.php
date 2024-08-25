<?php

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

// Web Routes
Route::middleware(['XSS'])->namespace('Web')->group(function () {

    // Home Route
    Route::get('/', function() {
       return redirect()->route('student.dashboard.index');
    });

    // SetCookie Route
    Route::get('/set-cookie', 'HomeController@setCookie')->name('setCookie');
});


// Ajax Filter Routes
Route::post('filter-district', 'AddressController@filterDistrict')->name('filter-district');
Route::post('filter-batch', 'FilterController@filterBatch')->name('filter-batch');
Route::post('filter-program', 'FilterController@filterProgram')->name('filter-program');
Route::post('filter-session', 'FilterController@filterSession')->name('filter-session');
Route::post('filter-semester', 'FilterController@filterSemester')->name('filter-semester');
Route::post('filter-section', 'FilterController@filterSection')->name('filter-section');
Route::post('filter-subject', 'FilterController@filterSubject')->name('filter-subject');
Route::post('filter-enroll-subject', 'FilterController@filterEnrollSubject')->name('filter-enroll-subject');
Route::post('filter-student-subject', 'FilterController@filterStudentSubject')->name('filter-student-subject');


// Set Lang Version
Route::get('locale/language/{locale}', function ($locale){

    \Session::put('locale', $locale);

    \App::setLocale($locale);

    return redirect()->back();
    
})->name('version');


// Auth Routes
Route::middleware(['XSS'])->prefix('admin')->group(function () {
    // Auth::routes();
    Auth::routes(['register' => false]);
});


// Admin Routes
Route::middleware(['auth:web','admin'])->name('admin.')->namespace('Admin')->prefix('admin')->group(function () {
//    Route::name('admin.')->namespace('Admin')->prefix('admin')->group(function () {

    // Dashboard Route
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

    Route::resource('product-category', 'ProductCategoryController');    
    Route::resource('products', 'ProductController');    
    Route::resource('about-us', 'AboutController');    
    Route::resource('team-members', 'TeamMembersController'); 
    Route::resource('testimonials', 'TestimonialController');    
    Route::resource('blog-categories', 'BlogCategoryController');
    Route::resource('blogs', 'BlogsController');
    Route::resource('banner', 'BannerController');
    Route::resource('product-banner', 'ProductBannerController');
    Route::resource('sale-banner', 'SaleBannerController');
    Route::resource('orders', 'OrderController');
    Route::patch('orders-process/{id}', 'OrderController@order_process')->name('orders.order_process');
    Route::get('delivered-orderes', 'OrderController@delivered_orderes')->name('delivered_orders');
    Route::get('print-invoice/{id}', 'OrderController@print_order')->name('orders.print');
    Route::resource('themes', 'ThemeController');
    Route::resource('saller', 'SallerController');
    Route::resource('saller-data', 'SallerDataController');

    Route::get('deal_of_the_day', 'ProductController@deal_of_the_day')->name('deal_of_the_day');    

    Route::get('about-history', 'AboutController@history')->name('about.history');    
    Route::post('about-history', 'AboutController@history_update')->name('about.history.update');    



    // Student Routes
    Route::resource('admission/student', 'StudentController');    
    Route::get('admission/student-card/{id}', 'StudentController@card')->name('student.card');
    // Route::resource('about', 'AboutController');

    //ck editor
    Route::post('/ekeditor-upload',"AboutController@ckeditor_upload")->name('ckeditor.upload');  

    // mini-banner-update
    Route::post('about-banner-update', 'AboutController@banner_update')->name('about.banner.update');  

    //about-beds show
    Route::get('about-profile', 'AboutController@profile')->name('about.profile');

    //about-beds update
    Route::post('about-profile-update', 'AboutController@profile_update')->name('about.profile.update');  

    //shapers_of_st_beds
    Route::get('about-shapers-of-beds', 'AboutController@shapers_of_beds')->name('about.shapers_of_beds');
    Route::get('about-shapers-of-beds-edit/{id}', 'AboutController@shapers_of_beds_edit')->name('about.shapers_of_beds.edit');
    Route::post('about-shapers-of-beds-delete', 'AboutController@shapers_of_beds_delete')->name('about.shapers_of_beds.delete');
    Route::get('about-shapers-of-beds-create', 'AboutController@shapers_of_beds_create')->name('about.shapers_of_beds.create');

    Route::resource('users-admin', 'UserController');

    Route::resource('contact-admin', 'ContactController');
    Route::resource('offers', 'OffersController');  
    Route::resource('header-notifications', 'HeaderNotificationsController');    
    Route::resource('product-reviews', 'ProductReviewsController');
    Route::resource('faq', 'FaqController');  
    // Route::post('contact-delete', 'ContactController@delete')->name('contact.delete');

     //Gallery
     Route::resource('gallery/gallery', 'GalleryController');
     Route::post('gallery-delete', 'GalleryController@delete')->name('gallery.delete');

     //Gallery category
     Route::resource('gallery/gallery-category', 'GallerycategoryController');
     Route::post('gallery-category-delete', 'GallerycategoryController@delete')->name('gallery_category.delete');

     //Gallery sub category
     Route::resource('gallery/gallery-sub-category', 'GallerysubcategoryController');
     Route::post('gallery-sub-category-delete', 'GallerysubcategoryController@delete')->name('gallery_sub_category.delete');

     Route::resource('collaboration', 'CollaborationController');
     Route::post('collaboration-delete', 'CollaborationController@delete')->name('collaboration.delete');

    

    // Setting Routes
    Route::get('setting', 'SettingController@index')->name('setting.index');
    Route::post('setting/siteinfo', 'SettingController@siteInfo')->name('setting.siteinfo');

   

    // Language Routes
    Route::resource('setting/language', 'LanguageController');
    Route::get('setting/language-default/{id}', 'LanguageController@default')->name('language.default');


    // Roles And Permission Routes
    Route::resource('setting/role','RoleController');

    // Env Setting Routes
    Route::resource('setting/mail-setting','MailSettingController');
    Route::resource('setting/sms-setting','SMSSettingController');

    
    // Sechedule Setting
    Route::resource('setting/schedule-setting', 'ScheduleSettingController');

    // Profile Routes
    Route::resource('profile','ProfileController');
    Route::get('profile/account', 'ProfileController@account')->name('profile.account');
    Route::post('profile/changemail', 'ProfileController@changeMail')->name('profile.changemail');
    Route::post('profile/changepass', 'ProfileController@changePass')->name('profile.changepass');
});

Route::middleware(['auth:web'])->name('user.')->prefix('user')->group(function () {
    Route::get('/','UserController@index')->name('user_dashboard');
    Route::post('add-user-address','UserController@add_user_address')->name('add_user_address');
    Route::post('update-user-address','UserController@update_user_address')->name('update_user_address');
    Route::get('remove-user-address/{id?}','UserController@remove_user_address')->name('remove_user_address');
    Route::post('update-profile','UserController@update_profile')->name('update_profile');
    Route::get('user-show/{id}','UserController@show')->name('user_dashboard.show');
    Route::get('cancel-order/{id}','UserController@cancelorder')->name('user_dashboard.cancelorder');
    Route::get('print-invoice/{id}', 'UserController@print_order')->name('user_dashboard.print');
});

Route::middleware(['vender'])->name('vender.')->prefix('vender')->group(function () {
    Route::get('/','VenderController@index')->name('vender_dashboard');
    Route::get('product-create','VenderController@create')->name('vender_dashboard.create');
    Route::post('product-create','VenderController@store')->name('vender_dashboard.store');
    Route::get('product-edit','VenderController@edit')->name('vender_dashboard.edit');
    Route::delete('product-destroy/{id}','VenderController@destroy')->name('vender_dashboard.destroy');
    Route::patch('product-update/{id}','VenderController@update')->name('vender_dashboard.update');
    Route::get('product-show/{id}','VenderController@show')->name('vender_dashboard.show');
    Route::patch('order-update/{id}','VenderController@order_update')->name('vender_dashboard.order_update');
    Route::patch('profile-update/{id}','VenderController@profile_update')->name('vender_dashboard.profile_update');
    Route::patch('account-deactivate/{id}','VenderController@account_deactivate')->name('vender_dashboard.account_deactivate');
    Route::patch('account-delete/{id}','VenderController@account_delete')->name('vender_dashboard.account_delete');
    Route::get('logout','VenderController@logout')->name('vender_dashboard.logout');
});

// Route::get('generate_pdf/{id}','FrontendController@generate_pdf')->name('generate_pdf');

//about
Route::get('/','FrontendController@index')->name('index');

Route::get('contact','FrontendController@contact')->name('contact');
Route::post('contact_submit','FrontendController@contact_store')->name('contact_submit');


Route::get('curriculam-activities/{id?}','FrontendController@curriculam_activities')->name('curriculam_activities');
Route::get('blogs/{id?}','FrontendController@blogs')->name('blogs');

Route::get('gallery','FrontendController@gallery')->name('gallery');
Route::get('gallery/{id?}/{cat_id?}','FrontendController@gallery_specific')->name('gallery.specific');

Route::get('under-constructions',"FrontendController@under_constructions")->name('under_constructions');

Route::get('products/{id?}',"FrontendController@products")->name('products');
Route::get('products-details/{slug?}',"FrontendController@products_detail")->name('products_detail');
Route::get('search-products',"FrontendController@search_products")->name('search_products');
Route::get('compare/{slug?}',"FrontendController@compare")->name('compare');
Route::get('about-us',"FrontendController@about_us")->name('about_us');
Route::get('blogs/{id?}',"FrontendController@blogs")->name('blogs');
Route::get('blog-detail/{id?}',"FrontendController@blog_detail")->name('blog_detail');


Route::get('/cart','FrontendController@cart')->name('cart');
Route::get('/add-to-cart','CartController@addToCart')->name('add-to-cart');
Route::post('/add-to-cart','CartController@addToCart')->name('add-to-cart');
Route::post('cart-delete','CartController@cartDelete')->name('cart_delete');
// Route::get('cart-update','CartController@cartUpdate')->name('cart.update');
// Route::get('/wishlist/{slug}','WishlistController@wishlist')->name('add_to_wishlist');
Route::get('/wishlist','FrontendController@wishlist')->name('wishlist');
Route::post('wishlist-delete','CartController@wishlistDelete')->name('wishlist_delete');

Route::any('checkout','FrontendController@checkout')->name('checkout');
Route::any('checkout-product','FrontendController@checkout2')->name('checkout2');
// Route::get('checkout-product','FrontendController@checkout_cart')->name('checkout2');
// Route::get('product-checkout','FrontendController@checkout_wishlist')->name('checkout3');
Route::post('order','FrontendController@order')->name('order');

// Route::post('pay','FrontendController@pay')->name('pay');

// Route::get('pay','FrontendController@get_product_price')->name('get_product_price');

// Route::get('change_order_status','FrontendController@change_order_status')->name('change_order_status');

// Route::get('clear',function(){
//     Artisan::call('cache:clear');
// })->name('clear');


// Route::view('success','frontend.pages.success');

Route::get('login','FrontendController@login')->name('login');
Route::post('login','FrontendController@login_submit')->name('login_submit');
Route::get('register','FrontendController@register')->name('register');
Route::post('register','FrontendController@register_submit')->name('register_submit');
Route::get('forgot-password','FrontendController@forgot_password')->name('forgot_password');
Route::post('forgot-password','FrontendController@forgot_password_submit')->name('forgot_password_submit');

//vender
Route::get('vender-login','FrontendController@vender_login')->name('vender_login');
Route::post('vender-login','FrontendController@vender_login_submit')->name('vender_login_submit');

Route::post('save-customer-review','FrontendController@save_customer_review')->name('save_customer_review');
Route::post('newsletter','FrontendController@newsletter')->name('newsletter');

Route::get('terms-and-conditions','FrontendController@terms')->name('terms');
Route::get('faq','FrontendController@faq')->name('faq');
Route::get('become-saller','FrontendController@become_seller')->name('become_seller');
Route::post('become-a-saller','FrontendController@become_a_saller')->name('become_a_saller');

Route::get('track_order','FrontendController@track_order')->name('track_order');

Route::get('generate_pdf/{id}','FrontendController@generate_pdf')->name('generate_pdf');

Route::fallback('FrontendController@fallback');

Route::get('phpinfo',function(){
    return phpinfo();
});