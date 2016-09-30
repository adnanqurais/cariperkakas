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
use Paginate;
use User;
use Cart;
use DateTime;
use PHPMailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Auth\Guard;
use Image;
// import the Intervention Image Class

//use Intervention\Image\ImageManager;
class FrontCartController extends Controller {
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

    public function getcart(){
        // DELETE SESSION FOR CHECKOUT INFORMATION
		Session::forget('fullnameSession');
		Session::forget('emailSession');
		Session::forget('addressSession');
		Session::forget('poscodeSession');
		Session::forget('handphoneSession');
		Session::forget('noteSession');
		Session::forget('currentTab');

        $today = date("m/d/Y");
        $boolean = FALSE;
        $pushBoolean = FALSE;
        $limitBool = 0;
        //Site Configuration
        $configuration = DB::table('configuration')->first();
        //Brands slider
        $brands = DB::table('brands')->get();
        $content = Cart::content();

        /************************************GET PROMOTION***********************************/
        $ccart = Cart::count(false);
        //CHECK PRODUCT, CATEGORY, AND BRANDS REQUIREMENTS TO APPLY PROMO
        if($ccart != 0){
            $promo = DB::table('promo')
            ->where('promo_start_date', '<=', $today)
            ->where('promo_end_date', '>=', $today)
            ->orderBy('promo_start_date','asc')->get();
            
        }else{
            $promo = 0;
        }

        $limitPromotionProduct = array();//active promo will stored here
        if($promo != 0){
            $productFlag = 0;
            foreach($content as $row){
                //$limitPromotionProduct =
                foreach($promo as $pro){
                     if($row->qty >= $pro->promo_min_req && $row->qty <= $pro->promo_max_req){
                        $boolean = TRUE;
                     }elseif($row->subtotal >= $pro->promo_min_req && $row->subtotal <= $pro->promo_max_req ){
                         $boolean = TRUE;
                     }
                    //if (in_array($row->id, explode(',',$pro->product_id)) && $boolean == TRUE) {
                    //
                    //    if($limitPromotionProduct == NULL){
                    //        $limitPromotionProduct[$row->id][] = $pro;
                    //
                    //    }else{
                    //        foreach($limitPromotionProduct as $limit => $key){
                    //            foreach($limitPromotionProduct[$limit] as $valueArr => $k){
                    //                if($limitPromotionProduct[$limit][$value]->promotionid == $pro->promotionid ){
                    //                    $limitBool++;
                    //                }
                    //            }
                    //        }
                    //        if($limitBool == 0){
                    //             $limitPromotionProduct[$row->id][] = $pro;
                    //        }
                    //    }
                    //}
                    if (in_array('"'.$row->id.'"', explode(';',$pro->product_id)) && $boolean == TRUE) {

                        if($limitPromotionProduct == NULL){
                            $limitPromotionProduct[$row->id] = $pro;
                            break;

                        }else{
                            foreach($limitPromotionProduct as $limit){
                                if($limit->promotionid == $pro->promotionid ){
                                    $limitBool++;
                                }
                            }
                            if($limitBool == 0){
                                 $limitPromotionProduct[ $row->id] = $pro;
                                 break;
                            }
                        }
                    }elseif (in_array('"'.$row->categoryid.'"', explode(';',$pro->category_id)) && $boolean == TRUE) {

                        if($limitPromotionProduct == NULL){
                            $limitPromotionProduct[$row->id] = $pro;
                            break;

                        }else{
                            foreach($limitPromotionProduct as $limit){
                                if($limit->promotionid == $pro->promotionid ){
                                    $limitBool++;
                                }
                            }
                            if($limitBool == 0){
                                 $limitPromotionProduct[$row->id] = $pro;
                                 break;
                            }
                        }
                    }elseif (in_array('"'.$row->brandsid.'"', explode(';',$pro->brands_id)) && $boolean == TRUE) {

                        if($limitPromotionProduct == NULL){
                            $limitPromotionProduct[$row->id] = $pro;
                            break;

                        }else{
                            foreach($limitPromotionProduct as $limit){
                                if($limit->promotionid == $pro->promotionid ){
                                    $limitBool++;
                                }
                            }
                            if($limitBool == 0){
                                 $limitPromotionProduct[ $row->id] = $pro;
                                 break;
                            }
                        }
                    }
                }
            }
        }

        //var_dump($limitPromotionProduct);
        //exit();
        return view('cart',
        [
            'config'                    => $configuration,
            'cart'                      => $content,
            'brands'                    => $brands,
            'promotion'                 => $promo,
            'limitPromotionProduct'     => $limitPromotionProduct,
        ]);
    }


    /**************************************************************************************************************************
    ************************************************DELETE CART ITEM FUNCTION**************************************************
    **************************************************************************************************************************/
    public function getcartdelete($cartid){
        Cart::content();
        //get Cart by id
        $rowId = Cart::search(array('id' => $cartid));

        //$get=DB::table('product')->where('code','=',$cartid)->first();
        //$qty= Cart::get($rowId[0])->qty;
        //$sum=$get->stock + $qty;

        ////Restore stock
        //$update=DB::table('product')
        //->where('code','=',$cartid)
        //->update([
        //    'stock' => $sum
        //]);

        //if($update){
            Cart::remove($rowId[0]);
			Session::forget('shoptotal');
			Session::forget('shoppingpackage');
			Session::forget('package');
            return Redirect()->back()->with('success-delete', 'Success deleting cart');
        //}
    }

    public function getvoucher(){
        $cod=Input::get('code');
        $check=DB::table('voucher')->where('code','=',$cod)->where('limit','>',0)->first();
        if(count($check)>0){

            if($check->type==1){

                    Session::set('vouchercode',$cod);
                    Session::set('vouchertype',$check->type);
                    Session::set('vouchervalue',$check->value);

                    $cut=$check->limit - 1;
                        DB::table('voucher')
                        ->where('code','=',Session::get('vouchercode'))
                        ->update(
                        ['limit' => $cut]

                    );
                    return Redirect()->back()->with('success-voucher','Selamat anda mendapatkan potongan harga dari kami !');


            }elseif($check->type==2){
                if($check->value<cart::total()){
                    Session::set('vouchercode',$cod);
                    Session::set('vouchertype',$check->type);
                    Session::set('vouchervalue',$check->value);
                    return Redirect()->back()->with('success-voucher','Selamat anda mendapatkan potongan harga dari kami !');

                    $cut=$check->limit - 1;
                        DB::table('voucher')
                        ->where('code','=',Session::get('vouchercode'))
                        ->update(
                        ['limit' => $cut]

                    );

                }else{

                    return Redirect()->back()->with('error-vouchervalue','Nilai Voucher anda melebihi total pembelanjaan ! Silahkan belanja lagi')->withInput();
                }
            }

        }else{
                return Redirect()->back()->with('error-voucher','Kode Voucher ini tidak tersedia !')->withInput();
        }
    }


    /**************************************************************************************************************************
    *****************************************************ADD TO CART FUNCTION**************************************************
    **************************************************************************************************************************/
    public function addcart(){

        $cod            =Input::get('code');
        $brandsid       =Input::get('brandsid');
        $categoryid     =Input::get('categoryid');
        $title          =Input::get('title');
        $qty            =Input::get('qty');
        $price          =Input::get('price');
        $image          =Input::get('image');
        $productWeight  =Input::get('weight');
        $productVolume  =Input::get('volume');
        $var_id         =Input::get('variantId');

        //COUNT VOLUME VALUE FOR SHIPPING COST
        $productVolume = $productVolume / 6;

        /*COMPARE PRODUCT VOLUME WITH PRODUCT WEIGHT
         *
         *
         *SET $weight AND SAVE INTO CART
        **/
        if($productWeight > $productVolume){
            $weight = $productWeight;
        }else{
            $weight = $productVolume;
        }

        $prod=DB::table('product')->where('productid','=',$cod)->first();
        $prod_variation=DB::table('product_variation')->where('var_id','=',$var_id)->first();
        if($prod->stock == 0 && $prod_variation == NULL && $prod_variation->var_stock == 0){
            return redirect()->back()->with('stocknull', 'Sorry , this product not ready !');

        }else{
            Cart::add($cod, $title, $qty, $price,["image" =>$image, "weight"=>$weight, "var_id"=>$var_id, "var_code"=>$prod_variation->var_code, "var_name"=>$prod_variation->var_name, "brandsid"=>$brandsid, "categoryid"=>$categoryid]);
            return redirect()->back()->with('success-addcart', 'Success add this items to Cart');

        }

    }
}
?>
