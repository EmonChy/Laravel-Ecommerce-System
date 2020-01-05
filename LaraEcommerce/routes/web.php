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

/*
All the routs for products for frontend
*/
// display user homepage
Route::get('/','Frontend\PagesController@index')->name('index');
// display contact page
Route::get('/contact','Frontend\PagesController@contact')->name('contact');
// display all products
Route::get('/products','Frontend\ProductsController@index')->name('products');
// link the products using slug
Route::get('/product/{slug}','Frontend\ProductsController@slug')->name('product.slug');
// product search by user
Route::get('/search','Frontend\PagesController@search')->name('search');

// Category wise Products

Route::get('/category/{id}','Frontend\CategoriesController@show')->name('category.show');

// user routes starts
Route::group(['prefix'=>'user'],function(){
// user routes for verification
Route::get('/token/{token}','Frontend\VerificationController@verify')->name('user.verification');
// user routes to show dashboard
Route::get('/dashboard','Frontend\UsersController@dashboard')->name('user.dashboard');
// show user
Route::get('/profile','Frontend\UsersController@profile')->name('user.profile');
// user profile update
Route::post('/profile/update','Frontend\UsersController@profileUpdate')->name('user.profile.update');
});


// cart routes starts
Route::group(['prefix'=>'carts'],function(){
	// show cart page
	Route::get('/','Frontend\CartsController@index')->name('carts');
	// carts data store into db
	Route::post('/store','Frontend\CartsController@store')->name('carts.store');
	// carts update data store into db
	Route::post('/update/{id}','Frontend\CartsController@update')->name('carts.update');
	// carts data delete
	Route::post('/delete/{id}','Frontend\CartsController@destroy')->name('carts.destroy');

	});

// checkout routes starts
Route::group(['prefix'=>'checkouts'],function(){
	// show checkout page
	Route::get('/','Frontend\CheckoutsController@index')->name('checkouts');
	// checkout data store into db
	Route::post('/store','Frontend\CheckoutsController@store')->name('checkouts.store');

	});	

// Admin routes start
	
Route::group(['prefix'=>'admin'],function(){

	// log in action
	Route::post('/login/submit','Auth\Admin\LoginController@login')->name('admin.login.submit');
	// show admin login form
	Route::get('/login','Auth\Admin\LoginController@showLoginForm')->name('auth.admin.login')->middleware('access');

	Route::group(['middleware'=>'logUser'],function(){
	// show the admin dashboard
	Route::get('/','Backend\PagesController@index')->name('admin.index');
	});
   // logout
	Route::post('/logout','Auth\Admin\LoginController@logoutAdmin')->name('admin.logout');
   // password email send for admin
	Route::get('/password/reset','Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email','Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
   // password reset for admin
   Route::get('/password/reset/{token}','Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
   Route::post('/password/reset','Auth\Admin\ResetPasswordController@reset')->name('admin.password.update');
	
// Product routes start for admin or backend

	Route::group(['prefix'=>'/products'],function(){
		// view all products
		Route::get('/','Backend\ProductsController@index')->name('admin.products');
		// view product insert form
		Route::get('/create','Backend\ProductsController@create')->name('admin.product.create');
		// view product edit form of their respective id 
	    Route::get('/edit/{id}','Backend\ProductsController@edit')->name('admin.product.edit');
        // product store into db via post method
		Route::post('/store','Backend\ProductsController@store')->name('admin.product.store');
		// update product edit form by their respective id
		Route::post('/edit/{id}','Backend\ProductsController@update')->name('admin.product.update');
		// delete product from db
	    Route::post('/delete/{id}','Backend\ProductsController@delete')->name('admin.product.delete');
		
 });

// Order routes start for admin or backend

Route::group(['prefix'=>'/orders'],function(){
	// view all orders
	Route::get('/','Backend\OrdersController@index')->name('admin.orders');
	// view individual user order
	Route::get('/view/{id}','Backend\OrdersController@show')->name('admin.order.show');
	// delete order from db
	Route::post('/delete/{id}','Backend\OrdersController@delete')->name('admin.order.delete');
    // order completetion by admin
	Route::post('/completed/{id}','Backend\OrdersController@completed')->name('admin.order.completed');
    // order paid confirm by admin
	Route::post('/paid/{id}','Backend\OrdersController@paid')->name('admin.order.paid');
    // updated charge on products by admin
	Route::post('/charge-update/{id}','Backend\OrdersController@chargeUpdate')->name('admin.order.charge');
    // generate pdf invoice 
	Route::get('/invoice/{id}','Backend\OrdersController@generateInvoice')->name('admin.order.invoice');
   

}); 

// Category routes start for admin or backend

	Route::group(['prefix'=>'/categories'],function(){
		// view all categories
		Route::get('/','Backend\CategoriesController@index')->name('admin.categories');
		// view category insert form
		Route::get('/create','Backend\CategoriesController@create')->name('admin.category.create');
		// view category edit form
	    Route::get('/edit/{id}','Backend\CategoriesController@edit')->name('admin.category.edit');
        // category store into db via post method
		Route::post('/store','Backend\CategoriesController@store')->name('admin.category.store');
		// update category edit form
		Route::post('/edit/{id}','Backend\CategoriesController@update')->name('admin.category.update');
		// delete category from db
	    Route::post('/delete/{id}','Backend\CategoriesController@delete')->name('admin.category.delete');
 });

// Brand routes start for admin or backend

	Route::group(['prefix'=>'/brands'],function(){
		// view all brands		
		Route::get('/','Backend\BrandsController@index')->name('admin.brands');
		// view brand insert form
		Route::get('/create','Backend\BrandsController@create')->name('admin.brand.create');
		// view brand edit form
	    Route::get('/edit/{id}','Backend\BrandsController@edit')->name('admin.brand.edit');
        // brand store into db via post method
		Route::post('/store','Backend\BrandsController@store')->name('admin.brand.store');
		// update brand edit form
		Route::post('/edit/{id}','Backend\BrandsController@update')->name('admin.brand.update');
		// delete brand from db
		Route::post('/delete/{id}','Backend\BrandsController@delete')->name('admin.brand.delete');
		
 });

 // Division routes start for admin or backend

 Route::group(['prefix'=>'/divisions'],function(){
	// view all divisions		
	Route::get('/','Backend\DivisionsController@index')->name('admin.divisions');
	// view division insert form
	Route::get('/create','Backend\DivisionsController@create')->name('admin.division.create');
	// view division edit form
	Route::get('/edit/{id}','Backend\DivisionsController@edit')->name('admin.division.edit');
	// division store into db via post method
	Route::post('/store','Backend\DivisionsController@store')->name('admin.division.store');
	// update division edit form
	Route::post('/edit/{id}','Backend\DivisionsController@update')->name('admin.division.update');
	// delete division from db
	Route::post('/delete/{id}','Backend\DivisionsController@delete')->name('admin.division.delete');
	
});

 // District routes start for admin or backend

 Route::group(['prefix'=>'/districts'],function(){
	// view all districts		
	Route::get('/','Backend\DistrictsController@index')->name('admin.districts');
	// view district insert form
	Route::get('/create','Backend\DistrictsController@create')->name('admin.district.create');
	// view district edit form
	Route::get('/edit/{id}','Backend\DistrictsController@edit')->name('admin.district.edit');
	// district store into db via post method
	Route::post('/store','Backend\DistrictsController@store')->name('admin.district.store');
	// update district edit form
	Route::post('/edit/{id}','Backend\DistrictsController@update')->name('admin.district.update');
	// delete district from db
	Route::post('/delete/{id}','Backend\DistrictsController@delete')->name('admin.district.delete');
	
});

// slider routes starts for frontend

Route::group(['prefix'=>'/sliders'],function(){
	// view all sliders		
	Route::get('/','Backend\SlidersController@index')->name('admin.sliders');
	// slider store into db via post method
	Route::post('/store','Backend\SlidersController@store')->name('admin.slider.store');
	// update slider edit form
	Route::post('/edit/{id}','Backend\SlidersController@update')->name('admin.slider.update');
	// delete slider from db
	Route::post('/delete/{id}','Backend\SlidersController@delete')->name('admin.slider.delete');
	
});

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// custom user logout
Route::post('logout','Auth\LoginController@logoutUser')->name('logout');


// API routes
// dependent dropdown list 
Route::get('get-districts/{id}',function($id){
	return json_encode(App\Models\District::where('division_id',$id)->get());

});

