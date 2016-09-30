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

use Illuminate\Support\Facades\Mail;
class UserController extends Controller {

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
    public function postregister(){
        
        //Site Configuration
        $configuration = DB::table('configuration')->first();

        $username=Input::get('username'); 
        $fullname=Input::get('fullname');   
        $email=Input::get('email');   
        $pass = md5(md5(Input::get('password'), 'random^%$&%&^(' ));
        $passconfrim= md5(md5(Input::get('passwordconfirm'), 'random^%$&%&^(' ));

        $now=new DateTime();
        $user = DB::table('users')->where('email', '=', $email)->first();

        if(count($user)>0){

                 return Redirect()->back()->with('emailalready','Email ini Sudah ada!')->withInput(); 

        }else{

            if($pass != $passconfrim){       

                    return Redirect()->back()->with('notmatch','Kata Sandi tidak sama !')->withInput(); 
            
             }else{
                    $q= DB::table('users')->insert([
                     'enable'       =>1, 
                     'level'        =>2,
                     'username'     => $username, 
                     'fullname'     => $fullname, 
                     'email'        => $email, 
                     'password'     => $pass,
                     'created_at'   => $now
                     ]);
                    //Create Session
                    $use= DB::table('users')->where('email', '=', $email)->first();

                    Session::set('memberid', $use->id);
                    Session::set('membername', $use->fullname);
                    Session::set('sessionmember', Hash::make($use->id));  

                    if($q){

                        ////Sending Mail   ===============================================================================================     
                        $mail = new PHPMailer;                
                        //$mail->IsMAIL();     
                        //$mail->From = $configuration->email;
                        //$mail->FromName = $configuration->sitename;
                        //$mail->addAddress($email, "");
                        ////Send HTML or Plain Text email
                        //$mail->isHTML(true);
                        //$mail->Subject = "Register";
                        //$mail->Body = $configuration->registermail_header.'<br>Content here<br>'.$configuration->registermail_header;
                        //$mail->AltBody = "This is the plain text version of the email content";
                        $mail->SMTPDebug = 3;  
                        //Set PHPMailer to use SMTP.
                        $mail->isSMTP();            
                        //Set SMTP host name                          
                        $mail->Host = "	srv2.niagahoster.com";
                        //Set this to true if SMTP host requires authentication to send email
                        $mail->SMTPAuth = true;                          
                        //Provide username and password     
                        $mail->Username = $configuration->email;                 
                        $mail->Password = "elvendi1";                           
                        //If SMTP requires TLS encryption then set it
                        $mail->SMTPSecure = "ssl";                           
                        //Set TCP port to connect to 
                        $mail->Port = 465;                                   

                        $mail->From = $configuration->email;
                        $mail->FromName = $configuration->sitename;

                        $mail->addAddress($email, "");

                        $mail->isHTML(true);

                        $mail->Subject = "Selamat datang di cariperkakas.com";
                        $mail->Body = $configuration->registermail_header;
                        $mail->AltBody = "This is the plain text version of the email content";

                        if(!$mail->send()){

                            echo "Mailer Error: " . $mail->ErrorInfo;

                        } else {

                            return Redirect('account/profile')->with('successregister','Selamat Datang.'); 

                        }
                    }
            }

        }

    }

    
    public function postlogin(){
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {
            $password = md5(md5(Input::get('password'), 'random^%$&%&^(' ));
            // create our user data for the authentication   
            $user = DB::table('users')->where('email', '=', Input::get('email'))->where('password','=', $password)->first();

            if(count($user)>0){
                Session::set('memberid', $user->id);
                Session::set('membername', $user->fullname);
                Session::set('sessionmember', Hash::make($user->email));    
                //echo Session::get('memberid');

                //echo Session::get('sessionmember');
               // echo $password;
                return redirect('account')->with('welcome','Selamat datang kembali !');               
            }else{
                echo Session::get('sessionmember');
                return Redirect('login')->with('notfound','Account Tidak ditemukan !')->withInput();
            }
        }
    }

    public function logout()
    {

        Session::forget('sessionmember');        
        Session::forget('memberid');
        //Session::flush();
        Session::flash('message', "Selamat datang kembali");
        return Redirect('/');
    }



    //====================================================Administrator============================================================//
    
    public function getloginadmin(){

        Session::forget('sessionadmin');        
        Session::forget('adminid');
        return view('admin/login');

    }

    public function postloginadmin(){
        // validate the info, create rules for the inputs
        $rules = array(
            'username'    => 'required', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('admin/login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {
            $password = md5(md5(Input::get('password'), 'random^%$&%&^(' ));
            // create our user data for the authentication
            $user = DB::table('users')->where('username', '=', Input::get('username'))->where('password','=', $password)->where('level','=', 1)->first();

            if(count($user)>0){

                Session::set('sessionadmin', Hash::make($user->id));  

                Session::set('adminid', $user->id);  

                return redirect('admin/dashboard')->with('welcome','Selamat datang kembali !');
              
            }else{

                return Redirect('admin/login')->with('error-login','Account Not found !')->withInput();
            }
        }
    }
    
    public function postloginadmin1(){
        // validate the info, create rules for the inputs
        $rules = array(
            'username'    => 'required|min:3', // make sure the email is an actual email
            'password' => 'required|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('admin/login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdataadmin = array(

                'username'     => Input::get('username'),
                'password'  => md5(Input::get('password'))
            );

            // attempt to do the login

                echo Input::get('username');
                echo md5(Input::get('password'));
          if (Auth::attempt($userdataadmin)) {
                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success 

              //  echo md5(Input::get('password'));
              // return Redirect('admin/dashboard')->with('success-login', 'Welcome back Administrator');
            } else {        
               // validation not successful, send back to form            
               // return Redirect('admin/login')->with('error-login', 'Error Login! please try again');
            }

        }
    }

    public function getlogoutadmin()
    {
        Session::forget('sessionadmin');        
        Session::forget('adminid');
        Session::flash('message', "Selamat datang kembali");
        return Redirect('admin/login');
    }
}