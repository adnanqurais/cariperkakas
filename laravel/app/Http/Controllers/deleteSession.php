<?php namespace App\Http\Controllers;
use Cart;
use Input;
use DB;
use Session;
use PHPMailer;
class deleteSession extends Controller {
    public function deleteSession(){
        //Forget Shipping Session
            Session::forget('province');
            Session::forget('provincename');
            Session::forget('city');
            Session::forget('cityname');
            Session::forget('package');
            Session::forget('shoppingpackage');
            Session::forget('ongkir');
            Session::forget('shoptotal');

            // DELETE SESSION FOR CHECKOUT INFORMATION
            Session::forget('fullnameSession');
            Session::forget('emailSession');
            Session::forget('addressSession');
            Session::forget('poscodeSession');
            Session::forget('handphoneSession');
            Session::forget('noteSession');
            Session::forget('currentTab');

                                    Session::forget('province');
                        Session::forget('provincename');
                        Session::forget('city');
                        Session::forget('cityname');
                        Session::forget('package');
                        Session::forget('shoppingpackage');
                        Session::forget('ongkir');
						Session::forget('shoptotal');

                        // DELETE SESSION FOR CHECKOUT INFORMATION
                        Session::forget('fullnameSession');
                        Session::forget('emailSession');
                        Session::forget('addressSession');
                        Session::forget('poscodeSession');
                        Session::forget('handphoneSession');
                        Session::forget('noteSession');
                        Session::forget('currentTab');

            // $arr = array(Cart::content());
            //
            // $json = json_encode($arr);
            // echo $json;


    }
}
