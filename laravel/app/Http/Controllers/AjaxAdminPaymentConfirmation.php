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
class AjaxAdminPaymentConfirmation extends Controller {


    public function getPaymentDetail(){
        $id = Input::get('id');
        $paymentDetails = DB::table('payment')->where('invoiceid',$id)
        //->where('status','=','0')
        ->first();

        if($paymentDetails != '' || $paymentDetails != NULL){
            echo "<div style='margin:0px auto; text-align:center;'>".
            "<img src='../../img/payment/".$paymentDetails->image."' style='width:70%; height:auto; padding-bottom:30px;'>".
            "</div>".
            "<table id='example1' class='table'>".
                "<tbody>".
                    "<tr>".
                        "<td>ID</td>".
                        "<td>:</td>".
                        "<td>".$paymentDetails->invoiceid."</td>".
                    "</tr>".
                    "<tr>".
                        "<td>Status</td>".
                        "<td>:</td>".
                        "<td>".$paymentDetails->status."</td>".
                    "</tr>".
                    "<tr>".
                        "<td>Bank Account</td>".
                        "<td>:</td>".
                        "<td>".$paymentDetails->bankaccountname."</td>".
                    "</tr>".
                    "<tr>".
                        "<td>Bank</td>".
                        "<td>:</td>".
                        "<td>".$paymentDetails->bank."</td>".
                    "</tr>".
                    "<tr>".
                        "<td>Email</td>".
                        "<td>:</td>".
                        "<td>".$paymentDetails->email."</td>".
                    "</tr>".
                    "<tr>".
                        "<td>Transfer Date</td>".
                        "<td>:</td>".
                        "<td>".$paymentDetails->transferdate."</td>".
                    "</tr>".
                    "<tr>".
                        "<td>Ammount</td>".
                        "<td>:</td>".
                        "<td class='price_format'>".$paymentDetails->transferammount."</td>".
                    "</tr>".
                    "<tr>".
                        "<td>Notes</td>".
                        "<td>:</td>".
                        "<td>".$paymentDetails->notes."</td>".
                    "</tr>".
                "</tbody>".
            "</table>";
            if($paymentDetails->status == 2 || $paymentDetails->status == 5){
                echo "<a href='#' class=\"btn btn-success\" style='float:right; margin-left:2px;' disabled>Confirm</a>";
            }else{
                echo "<a href='".url('admin/payment/confirm/'.$paymentDetails->paymentid.'')."' class=\"btn btn-success\" style='float:right; margin-left:2px;'>Confirm</a>";
            }
            echo "<a href='".url('admin/payment/reject/'.$paymentDetails->paymentid.'')."' class=\"btn btn-warning\" style='float:right; margin-right:2px;'>Decline</a>";

        }else{
            echo "No Payment for this order!!";
        }
    }


    public function updateOrderStatus(){
        $invoiceID      = Input::get('invoiceid');
        $orderStatus    = Input::get('orderStatus');

        DB::table('invoice')->where('invoiceid', $invoiceID)->update(['status' => $orderStatus]);
    }
}
