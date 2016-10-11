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
class AdminPromoController extends Controller {
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
  //
   public function getPromo(){
        if(Session::get('sessionadmin')){
            $promoList = DB::table('promo')->get();
            return view('admin/promotion',[
                'promoList' => $promoList,
            ]);
        }else{
            return redirect('admin/login');
        }
   }

    public function getPromoAdd(){
        if(Session::get('sessionadmin')){
            $products = DB::table('product')->get();
            $brands = DB::table('brands')->get();
            $catgeories = DB::table('product_category')->get();

            $promo_req_type = DB::table('promo_requirement_type')->get();
            $promo_rew_type = DB::table('promo_reward_type')->get();


            return view('admin/promotion-add',[
                'products'              => $products,
                'brands'                => $brands,
                'catgeories'            => $catgeories,
                'promo_reward_type'     => $promo_rew_type,
                'promo_req'             => $promo_req_type,
            ]);
        }else{
            return redirect('admin/login');
        }
   }

   public function postPromoAdd(){
        if(Session::get('sessionadmin')){
            $promotionName      = Input::get('promotionName');
            $promotionCategory  = Input::get('promotionCategory');
            $minRequirement     = Input::get('minRequirement');
            $maxRequirement     = Input::get('maxRequirement');
            $rewardType         = Input::get('rewardType');
            $rewardValue        = Input::get('rewardValue');
            $productReward      = Input::get('productReward');
            $fromDate           = Input::get('fromDate');
            $untilDate          = Input::get('untilDate');
            $stackedStatus      = Input::get('stacked-status');
            $enab               = Input::get('enable');
            $promoMessage       = Input::get('promomessage');
            if(isset($enab)){
                $enable=1;
            }else{
                $enable=0;
            }
            $now=new DateTime();


            /*****************************************/
            /**********Product Requirements***********/
            /*****************************************/
            $products   = implode(';', Input::get('product'));
            $brands     = implode(';', Input::get('brand'));
            $catgeories = implode(';', Input::get('category'));

            //var_dump($promotionName);
            //var_dump($promotionCategory);
            //var_dump($minRequirement);
            //var_dump($maxRequirement);
            //var_dump($rewardType);
            //var_dump($rewardValue);
            //var_dump($productReward);
            //var_dump($fromDate);
            //var_dump($untilDate);
            //echo implode(',',$products);
            //echo implode(',',$brands);
            //echo implode(',',$catgeories);

            DB::table('promo')->insert([
                'enable'                => $enable,
                'promo_title'           => $promotionName,
                'promo_requirements'    => $promotionCategory,
                'promo_min_req'         => $minRequirement,
                'promo_max_req'         => $maxRequirement,
                'promo_reward_type'     => $rewardType,
                'promo_reward_value'    => $rewardValue,
                'promo_reward_product'  => $productReward,
                'promo_message'         => $promoMessage,
                'promo_start_date'      => $fromDate,
                'promo_end_date'        => $untilDate,
                'stacked_status'        => $stackedStatus,
                'product_id'            => $products,
                'category_id'           => $catgeories,
                'brands_id'             => $brands,
                'created_at'            => $now,

            ]);
            return redirect('admin/promo');
        }else{
            return redirect('admin/login');
        }
   }
   public function getPromoDetail($promotionId){
        if(Session::get('sessionadmin')){

            //GET PROMO
            $promolist = db::table('promo')->where('promo_id',$promotionId)->first();

			//GET ALL PRODUCT
            $product = DB::table('product')
            ->leftjoin('product_variation', 'product.productid', '=', 'product_variation.product_id')
            ->groupBy('productname')
            ->get();

            //GET ALL CATEGORY
            $product_category = DB::table('product_category')->get();

            //GET ALL BRANDS
            $product_brands = DB::table('brands')->get();

			//GET ALL PROMO REQUIREMENTS
            $promo_req = DB::table('promo_requirement_type')->get();

            //var_dump($promolist);
            //exit();
            //GET ALL PROMO REWARD
            $promo_reward_type = DB::table('promo_reward_type')->get();
            return view('admin/promotion-detail',[
                'promolist'         => $promolist,
		            'product'           => $product,
                'product_category'  => $product_category,
                'product_brands'    => $product_brands,
		            'promo_req'         => $promo_req,
                'promo_reward_type' => $promo_reward_type,
            ]);

        }else{
            return redirect('admin/login');
        }
   }


   	public function postPromoDetail($promotionid)
    {
        if(Session::get('sessionadmin')){
            $today              = date("m/d/Y");
            $name               = Input::get('promotionName');
            $promotionCategory  = Input::get('promotionCategory');
            $minRequirement     = Input::get('minRequirement');
            $maxRequirement     = Input::get('maxRequirement');
            $rewardValue        = Input::get('rewardValue');
            $fromDate           = Input::get('fromDate');
            $untilDate          = Input::get('untilDate');
            $rewardType         = Input::get('rewardType');
            $listProducts       = Input::get('product');
            $listCategories     = Input::get('category');
            $listBrands         = Input::get('brands');
			$productReward      = Input::get('productReward');
            $promoMessage       = Input::get('promomessage');
            $stackedStatus      = Input::get('stacked-status');
			$enab=Input::get('enable');
            if(isset($enab)){
                $enable=1;
            }else{
                $enable=0;
            }

			if($productReward == 0){
               $productRewardImp = 0;
            }else{
              $productRewardImp = implode(';',$productReward);
            }
            if($listProducts == 0){
               $listProducts = 0;
            }else{
              $listProductsImp = implode(';',$listProducts);
            }
            if($listCategories == 0){
               $listCategories = 0;
            }else{
               echo $listCategories = implode(';',$listCategories);
            }
            if($listBrands == 0){
              $listBrands = 0;
            }else{
               $listBrands = implode(';',$listBrands);
            }

            $q= DB::table('promo')->where('promo_id', '=', $promotionid)
            ->update([
                'promo_title'           => $name,
                'promo_requirements'    => $promotionCategory,
                'promo_min_req'         => $minRequirement,
                'promo_max_req'         => $maxRequirement,
                'promo_reward_type'     => $rewardType,
                'promo_reward_value'    => $rewardValue,
                'promo_message'         => $promoMessage,
				'promo_reward_product'  => $productRewardImp,
                'promo_start_date'      => $fromDate,
                'promo_end_date'        => $untilDate,
                'product_id'            => $listProductsImp,
                'category_id'           => $listCategories,
                'brands_id'             => $listBrands,
                'updated_at'            => $today,
				'enable'            	=> $enable,
                'stacked_status'        => $stackedStatus,
            ]);
            // if($q){
            //     foreach($listProducts as $index => $valid){
            //         DB::table('promo_to_product')
            //         ->insert([
            //             'promoID'       => $q,
            //             'productID'     => $listProducts[$index],
            //         ]);
            //     }
            // }
            return redirect('admin/promo');

        }else{
            return redirect('admin/login');
        }
    }
}
?>
