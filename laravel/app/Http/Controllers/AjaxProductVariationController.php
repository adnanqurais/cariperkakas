<?php namespace App\Http\Controllers;
use Input;
use Auth;
use Session;
use Validator;
use Redirect;
use DB;
use Hash;
use Response;
use Request;
use User;
use Cart;
use DateTime;
use PHPMailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Auth\Guard;
class AjaxProductVariationController extends Controller {

	public function __construct()
	{
		$this->middleware('guest');
	}

    public function getPriceVariant(){
        $variantId = Input::get('variantId');
        $price_variation = DB::table('product_variation')->where('product_variation.var_id','=',$variantId)->first();
        echo $price_variation->var_price;
    }

    public function getDetailVariant(){
        $variantId = Input::get('variantId');
        $prod_variation_details = DB::table('product_variation_details')->where('product_variation_details.var_id','=',$variantId)->get();
        //var_dump($prod_variation_details);
        //exit();
        echo "<table style='margin-top: 2.5%;'>";
         foreach($prod_variation_details as $pvd){
            echo "<tr>"
                ."<td style='padding-right: 5px;'>".$pvd->var_det_title."</td>"
                ."<td style='padding-right: 5px;'> : </td>"
                ."<td>".$pvd->var_det_value."</td>"
                ."</tr>";
         }
         echo '</table>';
         echo "<div class='row' id='loadingVarDet' style='display: none;'>
            <div class='col-sm-4 text-center'>
                <img src='http://chronosh.com/cariperkakas/img/small_loading.gif' alt='loading'>
            </div>
        </div>";
    }
}
