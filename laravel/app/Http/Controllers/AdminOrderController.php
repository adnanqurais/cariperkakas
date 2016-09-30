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
class AdminOrderController extends Controller {

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

        public function getordernew(){
        if(Session::get('sessionadmin')){

            $ord=DB::table('invoice')
                ->leftJoin('users', 'invoice.byusers', '=', 'users.id')
                ->leftJoin('invoice_status', 'invoice_status.statusid', '=', 'invoice.status')
                ->where('status', '!=',4)
                ->get();
                // dd($ord);
                // exit();

            return view('admin/order-new',['orders'=> $ord]);

        }else{
            return redirect('admin/login');
        }

    }


    public function getorderdelete($orderid){

        if(Session::get('sessionadmin')){

             $deleteorder = DB::table('invoice')->where('invoiceid', '=', $orderid)->delete();

             $deleteorder = DB::table('orders_details')->where('invoiceid', '=', $orderid)->delete();

            if($deleteorder){
                return Redirect()->back()->with('success-delete', 'Success deleting data');
            }

        }else{
            return redirect('admin/login');
        }

    }

    public function getordercancel($orderid){

        if(Session::get('sessionadmin')){
            $flag = 0;
            $purchased_stocks = DB::table('orders_details')->select('invoiceid','productcode','qty')->where('invoiceid', '=', $orderid)->get();

            foreach($purchased_stocks as $purchased_stock){
                $current_stock = DB::table('product')->select('stock')->where('code', '=', $purchased_stock->productcode)->first();
                if($current_stock == '' || $current_stock == NULL){
                    $current_stock = DB::table('product_variation')->select('var_stock')->where('var_code', '=', $purchased_stock->productcode)->first();
                    $flag = 1;
                }
                $coba = $current_stock->var_stock;
                $cancelled_stock = $purchased_stock->qty;
                $returned_stock = $coba + $cancelled_stock;
                echo ($coba + $cancelled_stock);

                if($flag = 1){
                    DB::table('product_variation')->select('var_stock')
                    ->where('var_code', '=', $purchased_stock->productcode)
                    ->update([
                        'var_stock' => $returned_stock,
                    ]);
                }else{
                    DB::table('product')->select('stock')
                    ->where('code', '=', $purchased_stock->productcode)
                    ->update([
                        'stock' => $returned_stock,
                    ]);   
                }
            }


             $cancelorder = DB::table('invoice')->where('invoiceid', '=', $orderid)->update([
                'status'    => '4'
             ]);

            if($cancelorder){
                return Redirect()->back()->with('success-delete', 'Success deleting data');
            }

        }else{
            return redirect('admin/login');
        }

    }

    public function getorderdetail($orderid){

        if(Session::get('sessionadmin')){

            $ord=DB::table('invoice')->where('invoiceid','=',$orderid)->first();


            $ord_det=DB::table('orders_details')
                ->leftJoin('product', 'orders_details.product_id', '=', 'product.productid')
                ->leftJoin('product_variation', 'orders_details.var_id', '=', 'product_variation.var_id')
                ->where('invoiceid','=',$orderid)
                ->get();
            
            $invoice_status = DB::table('invoice_status')->get();

            $province=DB::table('province')->get();
            $city=DB::table('city')->get();



            return view('admin/order-details',
            [
            'orders'=> $ord,
            'orders_details'=> $ord_det,
            'province'=> $province,
            'city'=> $city,
            'invoice_status'=> $invoice_status,
            ]);

        }else{
            return redirect('admin/login');
        }
    }

    public function postordernew()
    {
        if(Session::get('sessionadmin')){

            $orderid        = Input::get('orderid');
            $byusers        = Input::get('byusers');
            $deliverydate   = Input::get('deliverydate');
            $resi           = Input::get('resi');
            $fullname       = Input::get('fullname');
            $address        = Input::get('address');
            $poscode        = Input::get('poscode');
            $province       = Input::get('province');
            $city           = Input::get('city');
            $handphone      = Input::get('handphone');
            if($resi == '' || $resi == NULL){
                $status         = 1;
            }else{
                $status         = 2;
            }

            $now            = new DateTime();

            if(isset($deliverydate) and isset($resi)){
                $deliv=1;
            }else{
                $deliv=0;
            }
            //Update Orders
            DB::table('invoice')
            ->where('invoiceid','=',$orderid)
            ->update([
                'delivery'          => $deliv,
                'delivery_date'     => $deliverydate,
                'resi'              => $resi,
                'updated_at'        => $now,
                'status'            => $status,
                'order_address'     => $address,
                'order_city'        => $city,
                'order_province'    => $province,
                'order_poscode'     => $poscode,
            ]);

            //Update Users
            DB::table('users')
            ->where('id','=',$byusers)
            ->update([
                'fullname'      => $fullname,
                'address'       => $address,
                'poscode'       => $poscode,
                'province'      => $province,
                'city'          => $city,
                'handphone'     => $handphone
            ]);

            return redirect('admin/order/new')->with('success-update', 'Success update order');

        }else{
            return redirect('admin/login');
        }
    }


    public function getorderhistory()
    {
       if(Session::get('sessionadmin')){

            $ord=DB::table('invoice')
                ->leftJoin('users', 'invoice.byusers', '=', 'users.id')
                ->leftJoin('invoice_status', 'invoice.status', '=', 'invoice_status.statusid')
                ->where('delivery','=',3)
                ->orwhere('status', '=',4)
                ->get();

            return view('admin/order-history',
            [
                'orders'=> $ord,
            ]);

        }else{
            return redirect('admin/login');
        }

    }
}
?>