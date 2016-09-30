<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('contact-us','contactUsController@getContactUs');

//*********************Web ajax************************************//
Route::post('ajax/shippingprovince','AjaxController@shippingprovince');
Route::post('ajax/shippingcity','AjaxController@shippingcity');
Route::post('ajax/shippingcost','AjaxController@shippingcost');
Route::post('ajax/shippingsubdistrict', 'AjaxController@shippingsubdistrict');
Route::post('ajax/shippingongkir','AjaxController@shippingongkir');
//Route::get('ajax/carttotal','AjaxController@shippingcarttotal');

//************************Admin Ajax************************//
Route::post('ajax/selectsubcategory','AjaxController@selectsubcategory');

//************************PRODUCT VARIANT AJAX************************//
Route::get('ajaxVariation/priceVariant','AjaxProductVariationController@getPriceVariant');
Route::get('ajaxVariation/detailVariant','AjaxProductVariationController@getDetailVariant');

//**********************!!TESTING!!*****************************//
Route::get('api','FrontController@getapishipping');
Route::get('mail','MailController@getmailtest');
Route::get('deleteSession','deleteSession@deleteSession');

/************************ PDF ************************/
Route::get('invoice/{invoiceid}','PDFController@customerinvoice');
Route::get('deliveryNotes/{invoiceid}','PDFController@deliveryNotes');

//********************************Page Controller**************************//
Route::get('/', 'FrontController@index');
Route::post('sendmessage', 'FrontController@postmessage');


// *************USER RELATED********************//
Route::get('login', 'FrontController@getlogin');
Route::get('register', 'FrontController@getregister');
Route::post('register', 'UserController@postregister');
Route::get('/error', 'FrontController@errorpage');


//*****************************USER ACCOUNT RELATED************************//
Route::get('account', 'FrontController@getaccount');
Route::get('account/profile', 'FrontController@getaccountprofile');
Route::post('account/profile', 'FrontController@postaccountprofile');
Route::get('account/invoice', 'FrontController@getaccountinvoice');
Route::get('guest/invoice', 'FrontController@getguestinvoice');
Route::get('account/invoice/details/{orderid}', 'FrontController@getaccountinvoicedetails');

//******************************PRODUCT VIEW****************************//
Route::get('product/', 'FrontController@getallcategory');
Route::get('product/{by}/{keyword}', 'FrontController@getcategory');
Route::post('product/search/', 'FrontController@postsearch');
Route::get('product-details/{productid}', 'FrontController@getdetails');
//Route::get('product-category/{keyword}', 'FrontController@getcategory');
//Route::get('product-category', ['as' => 'product-category', 'uses' => 'FrontController@getcategory']);


//****************************CART RELATED****************************//
Route::get('cart', 'FrontCartController@getcart');
Route::get('cart/delete/{cartid}', 'FrontCartController@getcartdelete');
Route::post('cart/getvoucher', 'FrontCartController@getvoucher');
Route::post('addcart', 'FrontCartController@addcart');

//CHECKOUT PROCESS
Route::get('checkout/information', 'FrontController@getcheckoutinformation');
Route::get('ajax/getNextTab', 'AjaxCheckoutController@getNextTab');
Route::post('checkout/information', 'FrontController@postcheckoutinformation');
Route::get('checkout/step-2', 'FrontController@getcheckout2');
Route::get('checkout/done', 'FrontController@getcheckoutdone');

Route::get('payment-confirmation/{orderid}', 'FrontController@getpaymentconfirmationwithid');
Route::get('payment-confirmation/', 'FrontController@getpaymentconfirmation');
Route::post('payment-confirmation/', 'FrontController@postpaymentconfirmation');
Route::get('page/{pages}', 'FrontController@getpage');

/*User Controller*/
Route::post('login', 'UserController@postlogin');
Route::get('logout', 'UserController@logout');



/*-----------------------ADMIN ROUTES-----------------------------*/
/*User Controller*/
Route::get('admin/login', 'UserController@getloginadmin');
Route::post('admin/login', 'UserController@postloginadmin');
Route::get('admin/logout', 'UserController@getlogoutadmin');
/*Dashboard Page*/

Route::post('admin/dashboard/email', 'AdminController@postemail');
Route::get('admin/', 'AdminController@getdashboard');
Route::get('admin/dashboard', 'AdminController@getdashboard');

/*Order Page*/
Route::get('admin/order/new', 'AdminOrderController@getordernew');
Route::post('admin/order/new', 'AdminOrderController@postordernew');
Route::get('admin/order/cancel/{orderid}', 'AdminOrderController@getordercancel');
Route::get('admin/order/delete/{orderid}', 'AdminOrderController@getorderdelete');
Route::get('admin/order/detail/{orderid}', 'AdminOrderController@getorderdetail');
Route::get('admin/order/history', 'AdminOrderController@getorderhistory');
Route::get('admin/ajax/order/new/package', 'AjaxAdminController@postNewPackage');
Route::get('admin/ajax/confirm/payment', 'AjaxAdminPaymentConfirmation@getPaymentDetail');
Route::get('admin/ajax/order/status', 'AjaxAdminPaymentConfirmation@updateOrderStatus');


/*Payment Page*/
Route::get('admin/payment/new', 'AdminPaymentController@getpaymentnew');
Route::get('admin/payment/confirm/{payid}', 'AdminPaymentController@getpaymentconfirm');
Route::get('admin/payment/reject/{payid}', 'AdminPaymentController@getpaymentreject');
Route::get('admin/payment/history/delete/{payid}', 'AdminPaymentController@getpaymentdelete');
Route::get('admin/payment/history', 'AdminPaymentController@getpaymenthistory');

/*Inbox Page*/
Route::get('admin/inbox', 'AdminInboxController@getinbox');
Route::get('admin/inbox/replay/{inboxid}', 'AdminInboxController@getinboxreplay');
Route::post('admin/inbox/replay/', 'AdminInboxController@postinboxreplay');
Route::get('admin/inbox/delete/{messageid}', 'AdminInboxController@getinboxdelete');
Route::get('admin/inbox/compose', 'AdminInboxController@getinboxcompose');

/*Voucher*/
Route::get('admin/voucher', 'AdminController@getvoucher');
Route::get('admin/voucher/add', 'AdminController@getvoucheradd');
Route::post('admin/voucher/add', 'AdminController@postvoucheradd');
Route::get('admin/voucher/delete/{voucherid}', 'AdminController@getvoucherdelete');
Route::get('admin/voucher/view/{voucherid}', 'AdminController@getvoucherview');
Route::post('admin/voucher/view', 'AdminController@postvoucherview');

/*Slider*/
Route::get('admin/slider', 'AdminController@getslider');
Route::get('admin/slider/add', 'AdminController@getslideradd');
Route::post('admin/slider/add', 'AdminController@postslideradd');
Route::get('admin/slider/delete/{sliderid}', 'AdminController@getsliderdelete');
Route::get('admin/slider/view/{sliderid}', 'AdminController@getsliderview');
Route::post('admin/slider/view', 'AdminController@postsliderview');

/*Promotion Others */
Route::get('admin/others', 'AdminController@getothers');
Route::post('admin/others', 'AdminController@postothers');

/*Category Page*/
Route::get('admin/category', 'AdminCategoryController@getcategory');
Route::get('admin/category/add', 'AdminCategoryController@getcategoryadd');
Route::post('admin/category/add', 'AdminCategoryController@postcategoryadd');
Route::get('admin/category/delete/{cateid}', 'AdminCategoryController@getcategorydelete');
Route::get('admin/category/view/{cateid}', 'AdminCategoryController@getcategoryview');
Route::post('admin/category/view/', 'AdminCategoryController@postcategoryview');

/*Sub Category Page*/
Route::get('admin/subcategory', 'AdminCategoryController@getsubcategory');
Route::get('admin/subcategory/delete/{scateid}', 'AdminCategoryController@getsubcategorydelete');
Route::get('admin/subcategory/add', 'AdminCategoryController@getsubcategoryadd');
Route::post('admin/subcategory/add', 'AdminCategoryController@postsubcategoryadd');


/**********************************************************************/
/************************PRODUCT PAGE*********************************/
/*********************************************************************/

Route::get('admin/product', 'AdminProductController@getproduct');
Route::get('admin/product/view/{code}', 'AdminProductController@getproductdetails');
Route::post('admin/product/view/', 'AdminProductController@postproductdetails');
Route::get('admin/product/delete/{code}', 'AdminProductController@getproductdelete');
Route::get('admin/product/add/image', 'AdminProductController@getproductaddimage');
Route::post('admin/product/add/image', 'AdminProductController@postproductaddimage');
Route::get('admin/product/add', 'AdminProductController@getproductadd');
Route::post('admin/product/add', 'AdminProductController@postproductadd');
Route::get('admin/product/add/variation/{productid}', 'AdminProductController@getproductvariationadd');
Route::get('admin/product/delete/variation/{id}', 'AdminProductController@getvariationdelete');
Route::get('admin/product/view/imgdelete/{imgid}', 'AdminProductController@getproductimgdelete');
Route::get('admin/product/edit/variation/{variantid}', 'AdminProductController@getproductvariationdetails');
Route::post('admin/product/edit/variation/{variantid}', 'AdminProductController@postproductvariationdetails');
Route::get('admin/product/variation/details/delete/{id}', 'AdminProductController@getVariationDetailsDelete');

/****************************AJAX PART************************************************/
Route::get('admin/product/category/search', 'AdminProductController@getCategorySearch');
Route::get('admin/product/details/edit', 'AdminProductController@getEditProductDetails');
Route::post('admin/product/details/edit', 'AdminProductController@postEditProductDetails');
Route::get('admin/product/details/delete', 'AdminProductController@deleteProductDetails');
Route::post('admin/product/add/variation', 'AjaxAdminProductVariation@postProductVariation');
Route::get('admin/product/variation/details/edit', 'AjaxAdminProductVariation@editVariationDetails');
Route::get('admin/product/variation/details/edit/post', 'AjaxAdminProductVariation@postEditVariationDetails');
Route::get('admin/product/details/edit/post', 'AjaxAdminProductVariation@postEditVariationDetails');


//Route::get('admin/product/edit/variation', 'AjaxAdminProductVariation@editVariation');
//Route::post('admin/product/edit/variation/post', 'AjaxAdminProductVariation@postEditVariation');

/**********************************************************************/
/************************PRODUCT PAGE END*********************************/
/*********************************************************************/


/*Brands Page*/
Route::get('admin/brands', 'AdminBrandsController@getbrands');
Route::get('admin/brands/view/{brandsid}', 'AdminBrandsController@getbrandsdetails');
Route::get('admin/brands/view', 'AdminBrandsController@postbrandsdetails');
Route::get('admin/brands/delete/{brandsid}', 'AdminBrandsController@getbrandsdelete');
Route::get('admin/brands/add', 'AdminBrandsController@getbrandsadd');
Route::post('admin/brands/add', 'AdminBrandsController@postbrandsadd');

/*Users Page*/
Route::get('admin/users', 'AdminController@getusers');
Route::get('admin/users/add', 'AdminController@getusersadd');
Route::post('admin/users/add', 'AdminController@postusersadd');
Route::get('admin/users/delete/{userid}', 'AdminController@getusersdelete');

Route::get('admin/users/view/{userid}', 'AdminController@getusersdetails');
Route::post('admin/users/view/', 'AdminController@postusersdetails');

/*Page Page*/
Route::get('admin/pages', 'AdminPagesController@getpages');
Route::get('admin/pages/create', 'AdminPagesController@getpagescreate');
Route::post('admin/pages/create', 'AdminPagesController@postpagescreate');
Route::get('admin/pages/view/{pagesid}', 'AdminPagesController@getpagesdetails');
Route::post('admin/pages/view', 'AdminPagesController@postpagesdetails');


/*Menu*/
Route::get('admin/menu', 'AdminController@getmenu');
Route::get('admin/menu/add', 'AdminController@getmenuadd');
Route::post('admin/menu/add', 'AdminController@postmenuadd');
Route::get('admin/menu/delete/{menuid}', 'AdminController@getmenudelete');
/*Configuration Page*/
Route::get('admin/configuration', 'AdminController@getconfiguration');
Route::post('admin/configuration', 'AdminController@postconfiguration');

/*Bank Page*/
Route::get('admin/bank', 'AdminBankController@getBank');
Route::get('admin/bank/view/{banksid}', 'AdminBankController@getBankDetail');
Route::post('admin/bank/postview/{banksidView}', 'AdminBankController@postBankDetail');
Route::get('admin/bank/delete/{banksid}', 'AdminBankController@getbanksdelete');
Route::get('admin/bank/add', 'AdminBankController@getBankAdd');
Route::post('admin/bank/add', 'AdminBankController@postBankAdd');

/*Promo Page*/
Route::get('admin/promo', 'AdminPromoController@getPromo');
Route::get('admin/promo/view/{promoid}', 'AdminPromoController@getPromoDetail');
Route::post('admin/promo/postview/{promoidView}', 'AdminPromoController@postPromoDetail');
//Route::get('admin/bank/delete/{banksid}', 'AdminPromoController@getbanksdelete');
Route::get('admin/promo/add', 'AdminPromoController@getPromoAdd');
Route::post('admin/promo/add', 'AdminPromoController@postPromoAdd');

/*Discount Page*/
Route::get('admin/discount', 'AdminDiscountController@getDiscountCatalog');
Route::get('admin/discount/view/{discountid}', 'AdminDiscountController@getDiscountDetail');
Route::post('admin/discount/view/{discountIdView}', 'AdminDiscountController@postDiscountDetail');
//Route::get('admin/bank/delete/{banksid}', 'AdminDiscountController@getbanksdelete');
Route::get('admin/discount/add', 'AdminDiscountController@getDiscountAdd');
Route::post('admin/discount/add', 'AdminDiscountController@postDiscountAdd');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
