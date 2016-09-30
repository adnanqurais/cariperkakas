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
class AdminInboxController extends Controller {
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

  public function getinbox(){

      if(Session::get('sessionadmin')){
          //Inbox
          $inbx = DB::table('messages')->leftJoin('message_status','messages.status','=','message_status.id')->orderBy('messagesid', 'desc')->get();
          return view('admin/inbox',
          [
          'inbox'=> $inbx,
          ]);
      }else{
          return redirect('admin/login');
      }
  }

  public function getinboxdelete($messageid){

      if(Session::get('sessionadmin')){

          $deleteinbox = DB::table('messages')->where('messagesid', '=', $messageid)->delete();
          if($deleteinbox){
              return Redirect()->back()->with('success-delete', 'Success deleting data');
          }
      }else{
          return redirect('admin/login');
      }

  }
  public function getinboxcompose(){

      if(Session::get('sessionadmin')){
          return view('admin/inbox-compose');
      }else{
          return redirect('admin/login');
      }
  }

  public function getinboxreplay($inboxid){

      if(Session::get('sessionadmin')){
          //Inbox replay
          $inbx = DB::table('messages')->where('messagesid','=', $inboxid)->first();
          return view('admin/inbox-replay',
          [
          'inbox'=> $inbx,
          ]);
      }else{
          return redirect('admin/login');
      }
  }

  public function postinboxreplay()
  {
     $config=DB::table('configuration')->first();

      //PHPMailer Object
      $mail = new PHPMailer;
      // whereas if using SMTP you would have
      $mail->IsMAIL();
      // Set mailer to use SMTP
      //$mail->Host = 'mail.chronosh.com';  // Specify main and backup SMTP servers
      //From email address and name
      $mail->From = $config->email;
      $mail->FromName = $config->sitename;
      //To address and name
      $mail->addAddress(Input::get('email'), "");

      //Address to which recipient will reply
      // $mail->addReplyTo("reply@yourdomain.com", "Reply");

      //CC and BCC
      // $mail->addCC("cc@example.com");
      // $mail->addBCC("bcc@example.com");

      //Send HTML or Plain Text email
      $mail->isHTML(true);

      $mail->Subject = Input::get('subject');
      $mail->Body = Input::get('message');
      $mail->AltBody = "This is the plain text version of the email content";

      if(!$mail->send())
      {
          echo "Mailer Error: " . $mail->ErrorInfo;
      }
      else
      {
          DB::table('messages')->where('messagesid',Input::get('id'))->update(['status' => 2]);
          return Redirect('admin/inbox')->with('success-email', 'Message has been sent successfully');
      }
  }

}
?>
