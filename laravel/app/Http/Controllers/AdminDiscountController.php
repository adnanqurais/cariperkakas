<?php
namespace App\Http\Controllers;

use Input;
use Auth;
use Session;
use Validator;
use Redirect;
use DB;
use Hash;
use Response;
use Request;
use PHPMailer;

//use Intervention\Image\ImageManagerStatic as Image;
use DateTime;

use Image;
// import the Intervention Image Class
//use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Mail;

//use Intervention\Image\ImageManager;
class AdminDiscountController extends Controller {
  /*
  |--------------------------------------------------------------------------
  | Home Controller
  |--------------------------------------------------------------------------
  |
  | This controller renders your application's "dashboard" for users that
  | are authenticated. Of course, you are free to change or remove the
  | controller as you wish. It is just here to get your app started!
  |
  */

  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getDiscountCatalog(){
      if(Session::get('sessionadmin')){
          $discount = DB::table('discount_catalog')->get();
          return view('admin/discount',[
            'discounts' => $discount,
          ]);
        }else{
            return redirect('admin/login');
        }
    }

    public function getDiscountAdd(){
      if(Session::get('sessionadmin')){
          $products = DB::table('product')
          ->groupBy('productname')
          ->get();
          $brands = DB::table('brands')->get();
          $catgeories = DB::table('product_category')->get();
          return view('admin/discount-add',[
            'products'      => $products,
            'brands'        => $brands,
            'catgeories'    => $catgeories,
          ]);
       }else{
            return redirect('admin/login');
        }
    }

    public function postDiscountAdd(){
        if(Session::get('sessionadmin')){
            $discountName       = Input::get('discountName');
            $discountType       = Input::get('discountType');
            $discountValue      = Input::get('discountValue');
            $fromDate           = Input::get('fromDate');
            $untilDate          = Input::get('untilDate');
            $stackedStatus      = Input::get('stacked-status');
            $products           = Input::get('product');
            $brands             = Input::get('brand');
            $categories         = Input::get('category');

            //get current date and time
            $now                = new DateTime();

            //implode data
            if($products == 0){
               $products = 0;
            }else{
              $products = implode(';',$products);
            }
            if($categories == 0){
               $categories = 0;
            }else{
               $categories = implode(';',$categories);
            }
            if($brands == 0){
              $brands = 0;
            }else{
               $brands = implode(';',$brands);
            }

            $q = DB::table('discount_catalog')->insert([
                'name'              => $discountName,
                'discount_type'     => $discountType,
                'discount_value'    => $discountValue,
                'start_date'        => $fromDate,
                'end_date'          => $untilDate,
                'product_id'        => $products,
                'category_id'       => $categories,
                'brands_id'         => $brands,
                'created_at'        => $now
            ]);

            if($q){
                return redirect('admin/discount')->with('success-create', 'Discount has successfully created!!!');
            }else{
                return redirect()->back()->with('create-failed', 'Failed!!!');
            }
       }else{
            return redirect('admin/login');
        }
    }

    //GET EDIT DISCOUNT PAGE
    public function getDiscountDetail($discountId){
        if(Session::get('sessionadmin')){

            //GET PROMO
            $discountList = db::table('discount_catalog')->where('id',$discountId)->first();

			//GET ALL PRODUCT
            $product = DB::table('product')
            ->leftjoin('product_variation', 'product.productid', '=', 'product_variation.product_id')
            ->groupBy('productname')
            ->get();

            //GET ALL CATEGORY
            $product_category = DB::table('product_category')->get();

            //GET ALL BRANDS
            $product_brands = DB::table('brands')->get();

            //var_dump($promolist);
            //exit();
            return view('admin/discount-edit',[
                'discountList'      => $discountList,
				'product'           => $product,
                'product_category'  => $product_category,
                'product_brands'    => $product_brands,
            ]);

        }else{
            return redirect('admin/login');
        }
    }

    public function postDiscountDetail($discountId){
        if(Session::get('sessionadmin')){
            $discountName       = Input::get('discountName');
            $discountType       = Input::get('discountType');
            $discountValue      = Input::get('discountValue');
            $fromDate           = Input::get('fromDate');
            $untilDate          = Input::get('untilDate');
            $stackedStatus      = Input::get('stacked-status');
            $products           = Input::get('product');
            $brands             = Input::get('brand');
            $categories         = Input::get('category');
            $stackedStatus      = Input::get('stacked-status');

            //get current date and time
            $now                = new DateTime();

            //implode data
            if($products == 0){
               $products = 0;
            }else{
              $products = implode(';',$products);
            }
            if($categories == 0){
               $categories = 0;
            }else{
               $categories = implode(';',$categories);
            }
            if($brands == 0){
              $brands = 0;
            }else{
               $brands = implode(';',$brands);
            }

            $q = DB::table('discount_catalog')->where('discount_catalog.id',$discountId)->update([
                'name'              => $discountName,
                'discount_type'     => $discountType,
                'discount_value'    => $discountValue,
                'start_date'        => $fromDate,
                'end_date'          => $untilDate,
                'product_id'        => $products,
                'category_id'       => $categories,
                'brands_id'         => $brands,
                'updated_at'        => $now,
                'stacked_status'    => $stackedStatus,
            ]);

            if($q){
                return redirect('admin/discount')->with('success-create', 'Discount has successfully created!!!');
            }else{
                return redirect()->back()->with('create-failed', 'Failed!!!');
            }
       }else{
            return redirect('admin/login');
        }
    }

}
?>
