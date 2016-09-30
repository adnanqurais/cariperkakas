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
class AdminPaymentController extends Controller {

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

    public function getpaymentnew(){

        if(Session::get('sessionadmin')){
            // payment new
            $payment = DB::table('payment')->where('status','=',1)->get();
            return view('admin/payment-new',
            [
            'payment'=> $payment,
            ]);
            return view('admin/payment-new');
        }else{
            return redirect('admin/login');
        }
    }

    public function getpaymentconfirm($payid){

        if(Session::get('sessionadmin')){


            DB::table('payment')->where('paymentid', '=', $payid)->update(['status' => 2]);


            $pay = DB::table('payment')->where('paymentid', '=', $payid)->get();
            foreach ($pay as $p) {
                # code...
                $ord= $p->invoiceid;

                DB::table('invoice')->where('invoiceid', '=',$ord)->update(['status' => 1]);
            }

            return Redirect()->back()->with('success-update', 'Success confirmation this Payment');
        }else{
            return redirect('admin/login');
        }
    }

    public function getpaymentreject($payid){

        if(Session::get('sessionadmin')){
            $update = DB::table('payment')->where('paymentid', '=', $payid)->update(['status' => 5]);
            if($update){
                return Redirect()->back()->with('success-update', 'Success reject this Payment');
            }
        }else{
            return redirect('admin/login');
        }

    }
    public function getpaymenthistory(){

        if(Session::get('sessionadmin')){
            // payment History
            $payment = DB::table('payment')->where('status','<>',0)->get();
            return view('admin/payment-history',
            [
            'payment'=> $payment,
            ]);
        }else{
            return redirect('admin/login');
        }
    }


    public function getpaymentdelete($payid){

        if(Session::get('sessionadmin')){
            $delete = DB::table('payment')->where('paymentid', '=', $payid)->delete();
            if($delete){
                return Redirect()->back()->with('success-delete', 'Success deleting data');
            }
        }else{
            return redirect('admin/login');
        }

    }
}
?>
