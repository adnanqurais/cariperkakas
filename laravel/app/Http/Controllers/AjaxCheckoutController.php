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
class AjaxCheckoutController extends Controller {

	public function __construct()
	{
		$this->middleware('guest');
	}

    public function getNextTab(){
        //$fullname = Input::get('fullname');
        //$email = Input::get('email');
        //$address = Input::get('address');
        //$poscode = Input::get('poscode');
        //$handphone = Input::get('handphone');
        //$note = Input::get('note');

					Session::set('fullnameSession', Input::get('fullname'));
	        Session::set('emailSession',Input::get('email'));
	        Session::set('addressSession', Input::get('address'));
	        Session::set('poscodeSession', Input::get('poscode'));
	        Session::set('handphoneSession', Input::get('handphone'));
	        Session::set('noteSession', Input::get('note'));

				if(Input::get('payment') != ""){
					Session::set('paymentSession', Input::get('payment'));
				}

    }
}
