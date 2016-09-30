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
use PDF;

use Illuminate\Support\Facades\Mail;
class PDFController extends Controller {

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
    public function customerinvoice($invoiceid){


        $invoice =DB::table('invoice')->where('invoiceid','=',$invoiceid)->first();
        $config =DB::table('configuration')->first();
        $bank =DB::table('bank')->get();


        $detailinvoice = DB::table('orders_details')
                            ->leftJoin('product', 'orders_details.product_id', '=', 'product.productid')
                            ->where('invoiceid','=',$invoiceid)
                            ->get();

        $pdf = PDF::loadView('pdf.customerinvoice',['invoice'=>$invoice,'detailinvoice'=>$detailinvoice,'config' => $config,'bank'=>$bank])->setPaper('a4', 'potrait');
        return $pdf->stream('invoice.pdf');
    }

    public function deliveryNotes($invoiceid){


        $invoice =DB::table('invoice')->where('invoiceid','=',$invoiceid)->first();
        $config =DB::table('configuration')->first();
        $bank =DB::table('bank')->get();


        $detailinvoice = DB::table('orders_details')
                            ->leftJoin('product', 'orders_details.product_id', '=', 'product.productid')
                            ->where('invoiceid','=',$invoiceid)
                            ->get();

        $pdf = PDF::loadView('admin.deliverynotes',['invoice'=>$invoice,'detailinvoice'=>$detailinvoice,'config' => $config,'bank'=>$bank])->setPaper('a4', 'potrait');
        return $pdf->stream('invoice.pdf');
    }


}
