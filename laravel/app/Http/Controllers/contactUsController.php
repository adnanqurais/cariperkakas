<?php namespace App\Http\Controllers;

use Input;
use Auth;
use Session;
use Validator;
use Redirect;
use DB;
use Hash;
use DateTime;
use App\User;
use PHPMailer;
use Cart;

use Illuminate\Support\Facades\Mail;
class contactUsController extends Controller {

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

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
    public function getContactUs(){
			$content = Cart::content();
			$brands = DB::table('brands')->get();
			//Site Configuration
			$configuration = DB::table('configuration')->first();
			return view('contact-us',[
				'config' => $configuration,
				'cart' => $content,
				'brands'=>$brands
			]);
    }
}
