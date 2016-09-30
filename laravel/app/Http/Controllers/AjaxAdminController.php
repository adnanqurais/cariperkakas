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
class AjaxAdminController extends Controller {

	public function __construct()
	{
		$this->middleware('guest');
	}

    public function postNewPackage(){
          //
					// Session::set('fullnameSession', Input::get('fullname'));
	        // Session::set('emailSession',Input::get('email'));
	        // Session::set('addressSession', Input::get('address'));
	        // Session::set('poscodeSession', Input::get('poscode'));
	        // Session::set('handphoneSession', Input::get('handphone'));
	        // Session::set('noteSession', Input::get('note'));

          $invoiceid        = Input::get('invoiceid');
          $package          = Input::get('package');
          $newShippingCost  = Input::get('newShippingCost');
          $oldTotalPayment  = DB::table('invoice')->where('invoiceid','=',$invoiceid)->first();

          $newTotalPayment  = $oldTotalPayment->total_product_payment + $newShippingCost;

          // print_r($newTotalPayment);
          // exit();

          DB::table('invoice')->where('invoiceid','=',$invoiceid)->update(['shippingpackage' => $package, 'total' => $newTotalPayment, 'shippingcost' => $newShippingCost]);

          // echo "WE DID IT!!!";

    }
}
