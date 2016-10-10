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
class AdminController extends Controller {

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

    public function getdashboard()
    {
        if(Session::get('sessionadmin')){

            $ord=DB::table('invoice')->get();
                    $c_order=count($ord);

            $pay=DB::table('payment')->where('status','=',0)->get();
                    $c_pay=count($pay);

            $mess=DB::table('messages')->orderBy('messagesid', 'desc')->Paginate(4);
            $mess->setPath('dashboard');

                    $c_mess=count($mess);

            $user=DB::table('users')->get();
                    $c_user=count($user);

            return view('/admin/dashboard',
            [
            'corders'=> $c_order,
            'cmess'=> $c_mess,
            'cpayment'=> $c_pay,
            'cusers'=> $c_user,
            'messages'=> $mess
            ]);

        }else{
            return redirect('admin/login');
        }
    }

     public function postemail()
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

                return Redirect('admin/dashboard')->with('success-email', 'Message has been sent successfully');
        }
     }


    public function getvoucher()
    {
        if(Session::get('sessionadmin')){
            //Voucher View
            $voucher = DB::table('voucher')->get();
            return view('admin/voucher',
            [
            'voucher'=> $voucher,
            ]);

        }else{
            return redirect('admin/login');
        }

    }


    public function getvoucheradd()
    {
         if(Session::get('sessionadmin')){
            return view('admin/voucher-add');
        }else{
            return redirect('admin/login');
        }
    }

    public function postvoucheradd()
    {
        if(Session::get('sessionadmin')){
            $code=rand(11111,99999);
            $limit=Input::get('limit');
            $type=Input::get('type');
            $val=Input::get('value');
            $now=new DateTime();
            $q= DB::table('voucher')->insert([
                'code' => $code,
                'type' => $type,
                'limit' => $limit,
                'value' => $val,
                'created_at' => $now
            ]);
            if($q){

                return redirect('admin/voucher')->with('success-create','Success added New Voucher');

            }else{

                return redirect('admin/voucher/add')->with('error-created','Something is Error !');

            }


        }else{
            return redirect('admin/login');
        }

    }
    public function getvoucherdelete($voucherid){

        if(Session::get('sessionadmin')){
            $delete = DB::table('voucher')->where('voucherid', '=', $voucherid)->delete();
            if($delete){
                return Redirect()->back()->with('success-delete', 'Success deleting data');
            }
        }else{
        return redirect('admin/login');
        }
    }

    public function getslider()
    {

        if(Session::get('sessionadmin')){
            //Sliders View
            $slider = DB::table('slider')->get();
            return view('admin/slider',
            [
            'slider'=> $slider,
            ]);

        }else{
            return redirect('admin/login');
        }

    }

    public function getslideradd()
    {
         if(Session::get('sessionadmin')){
            return view('admin/slider-add');
        }else{
            return redirect('admin/login');
        }
    }


    public function postslideradd(){

        if(Session::get('sessionadmin')){
            $now= new DateTime();
            $position=Input::get('position');
            $link=Input::get('link');
            $enab=Input::get('enable');
            if(isset($enab)){
                $enable=1;
            }else{
                $enable=0;
            }


             // checking file is valid.
            if (Input::file('image')->isValid()) {

              $destinationPath = 'img/slide/'; // upload path

              $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
              $fileName = rand(11111,99999).'.'.$extension; // renameing image

                Image::make(Input::file('image')->getRealPath())->resize(1583, null, function ($constraint) { $constraint->aspectRatio();})->save($destinationPath . $fileName);


                $q=DB::table('slider')->insert([
                'position' => $position,
                'enable' => $enable,
                'link' => $link,
                'image'=>$fileName,
                'position' => $position,
                'created_at' => $now,
                'updated_at' => 'never'
                ]);

                if($q){
                    return redirect('admin/slider')->with('success-create', 'Success add Slider');
                }

            }else{

                return redirect()->back();

            }

        }else{
            return redirect('admin/login');
        }
    }


    public function getsliderdelete($sliderid){

        if(Session::get('sessionadmin')){
            $delete = DB::table('slider')->where('sliderid', '=', $sliderid)->delete();
            if($delete){
                return Redirect()->back()->with('success-delete', 'Success deleting data');
            }
        }else{
        return redirect('admin/login');
        }
    }



    public function getsliderview($sliderid)
    {
        if(Session::get('sessionadmin')){
            $slider = DB::table('slider')->where('sliderid', '=', $sliderid)->first();
            return view('admin/slider-view',
            [
            'slider'=> $slider,
            ]);

        }else{
            return redirect('admin/login');
        }
    }

    public function postsliderview()
    {
        if(Session::get('sessionadmin')){
            $id=Input::get('id');
            $position=Input::get('position');
            $link=Input::get('link');
            $now=new DateTime();
            $enab=Input::get('enable');
            if(isset($enab)){
                $enable=1;
            }else{
                $enable=0;
            }

            if (Input::file('image')->isValid()) {

              $destinationPath = 'img/slide/'; // upload path

              $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
              $fileName = rand(11111,99999).'.'.$extension; // renameing image

                Image::make(Input::file('image')->getRealPath())->resize(1583, null, function ($constraint) { $constraint->aspectRatio();})->save($destinationPath . $fileName);


                $q= DB::table('slider')
                ->where('sliderid','=',$id)
                ->update([
                    'position' => $position,
                    'link' => $link,
                    'enable' => $enable,
                    'image' => $fileName,
                    'updated_at' => $now
                ]);

                if($q){
                    return redirect('admin/slider')->with('success-update','Slider has Updated');
                }

            }else{

                return redirect()->back();

            }



        }else{
            return redirect('admin/login');
        }

    }


    public function getothers()
    {
        if(Session::get('sessionadmin')){
            $promotion = DB::table('promotion')->get();
            return view('admin/others',
            [
            'promo'=> $promotion,
            ]);

        }else{
            return redirect('admin/login');
        }
    }

    public function postothers()
    {
        if(Session::get('sessionadmin')){
            $dcaption=Input::get('dcaption');
            $mcaption=Input::get('mcaption');
            $link=Input::get('link');
            $now=new DateTime();
            if(Input::get('enable')){
                $enab=1;
            }else{
                $enab=0;
            }
            $q= DB::table('promotion')
            ->insert([
                'dekstopcaption' => $dcaption,
                'mobilecaption' => $mcaption,
                'link' => $link,
                'enable' => $enab,
                'created_at' => $now,
                'updated_at' => 'never'
            ]);

            if($q){
                return redirect()->back()->with('success-update','Success update');
            }


        }else{
            return redirect('admin/login');
        }

    }

    public function getusers(){

        if(Session::get('sessionadmin')){

            //Users
            $users = DB::table('users')
                ->leftjoin('users_access', 'users.level', '=', 'users_access.usersaccessid')
                ->get();

            return view('admin/users',
            [
            'users'=> $users,
            ]);
        }else{
        return redirect('admin/login');
        }
    }
    public function getusersadd(){

        if(Session::get('sessionadmin')){
            //useraccess
            $acc = DB::table('users_access')->get();

            return view('admin/users-add',
            [
            'access'=> $acc,
            ]);
        }else{
        return redirect('admin/login');
        }


    }
     public function postusersadd(){

        if(Session::get('sessionadmin')){
            $lvl=Input::get('level');
            $fullname=Input::get('fullname');
            $username=Input::get('username');
            $email=Input::get('email');
            $pass1=Input::get('password1');
            $pass2=Input::get('password1');

            $enab=Input::get('enable');

            if(isset($enab)){
                $enable=1;
            }else{
                $enable=0;
            }

            $now= new DateTime();
            //check users
            $readyname = DB::table('users')->where('username','=',$username)->first();
            $readyemail = DB::table('users')->where('username','=',$username)->first();
            if(count($readyname)>0 or count($readyemail)>0 ){
                    return redirect('admin/users/add')->with('ready', 'Username or Email is already !')->withInput();
            }else{

                if($pass1 != $pass2){
                    return redirect('admin/users/add')->with('notmatch', 'Password not match !')->withInput();
                }else{
                    $password = md5(md5(Input::get('password1'), 'random^%$&%&^(' ));
                    DB::table('users')->insert([
                    'enable' => $enable,
                    'level' => $lvl,
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'created_at' => $now,
                    'updated_at' => 'Never'
                    ]);
                    return redirect('admin/users')->with('success-create', 'Success add new user');
                }
            }
        }else{
        return redirect('admin/login');
        }
    }


    public function getusersdelete($userid){

        if(Session::get('sessionadmin')){
             $delete = DB::table('users')->where('id', '=', $userid)->delete();

            if($delete){
                return Redirect('admin/users')->with('success-delete', 'Success deleting data');
            }
        }else{
        return redirect('admin/login');
        }

    }

    public function getusersdetails($userid){

        if(Session::get('sessionadmin')){

            $acc = DB::table('users_access')->get();
            //Brands View
            $users = DB::table('users')->where('id','=',$userid)->first();
            return view('admin/users-details',
            [
            'users'=> $users,
            'access'=> $acc,
            ]);
        }else{
            return redirect('admin/login');
        }
    }
    public function postusersdetails(){

        if(Session::get('sessionadmin')){
            $userid=Input::get('id');
            $lvl=Input::get('level');
            $fullname=Input::get('fullname');
            $username=Input::get('username');
            $email=Input::get('email');
            $pass1=Input::get('password1');
            $pass2=Input::get('password1');

            $enab=Input::get('enable');

            if(isset($enab)){
                $enable=1;
            }else{
                $enable=0;
            }

            $now= new DateTime();
            //check users
           // $readyname = DB::table('users')->where('username','=',$username)->first();
            //$readyemail = DB::table('users')->where('username','=',$username)->first();
           // if(count($readyname)>0 or count($readyemail)>0 ){
                    //return redirect()->back()->with('ready', 'Username or Email is already !')->withInput();
           // }else{
            if(isset($pass)){
                if($pass1 != $pass2){
                    return redirect()->back()->with('notmatch', 'Password not match !')->withInput();
                }else{
                    $password = md5(md5(Input::get('password1'), 'random^%$&%&^(' ));
                    DB::table('users')
                    ->where('id','=',$userid)
                    ->update([
                    'enable' => $enable,
                    'level' => $lvl,
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'created_at' => $now,
                    'updated_at' => 'Never'
                    ]);
                    return redirect('admin/users')->with('success-update', 'Success update this user !');
                }
            }else{
                 $password = md5(md5(Input::get('password1'), 'random^%$&%&^(' ));
                    DB::table('users')
                    ->where('id','=',$userid)
                    ->update([
                    'enable' => $enable,
                    'level' => $lvl,
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $email,
                    'updated_at' => $now
                    ]);
                    return redirect('admin/users')->with('success-update', 'Success update this user !');
            }
           // }
        }else{
            return redirect('admin/login');
        }
    }

    public function getmenu()
    {
        if(Session::get('sessionadmin')){
            //Menu
            $menu = DB::table('menu')->get();
            return view('admin/menu',
            [
            'menu'=> $menu,
            ]);
        }else{
        return redirect('admin/login');
        }


    }

    public function getmenuadd()
    {
        if(Session::get('sessionadmin')){
            //Menu
            //$menu = DB::table('menu')->get();
            return view('admin/menu-add');
        }else{
        return redirect('admin/login');
        }
    }
    public function postmenuadd(){
        if(Session::get('sessionadmin')){
            $position=Input::get('position');
            $url=Input::get('url');
            $title=Input::get('title');
            DB::table('menu')->insert([
            'position' => $position,
            'url' => $url,
            'title' => $title,
            ]);
            return redirect('admin/menu')->with('success-create', 'Success create new menu');
        }else{
        return redirect('admin/login');
        }
    }
    public function getmenudelete($menuid){
        if(Session::get('sessionadmin')){
             $delete = DB::table('menu')->where('menuid', '=', $menuid)->delete();
            if($delete){
                return Redirect()->back()->with('success-delete', 'Success deleting data');
            }
        }else{
        return redirect('admin/login');
        }
    }
    public function getconfiguration(){

        if(Session::get('sessionadmin')){
            //configuration
            $config = DB::table('configuration')->first();
            return view('admin/configuration',
            [
            'configuration'=> $config,
            ]);
        }else{
        return redirect('admin/login');
        }
    }
    public function postconfiguration(){

        if(Session::get('sessionadmin')){
            $url=Input::get('url');
            $sitename=Input::get('sitename');
            $company=Input::get('company');
            $email=Input::get('email');
            $telephone=Input::get('telephone');
            $address=Input::get('address');
            $mapURL=Input::get('map_url');
            $terms_condition=Input::get('terms_condition');

            $checkoutheader=Input::get('checkoutheader');
            $checkoutfooter=Input::get('checkoutfooter');
            $registerheader=Input::get('registerheader');
            $registerfooter=Input::get('registerfooter');
            $paymentheader=Input::get('paymentheader');
            $paymentfooter=Input::get('paymentfooter');

            $q=DB::table('configuration')->update([
                'url' => $url,
                'sitename' => $sitename,
                'companyname' => $company,
                'email' => $email,
                'telephone' => $telephone,
                'address' => $address,
                'map_url' => $mapURL,
                'terms_condition' => $terms_condition,
                'checkoutmail_header' => $checkoutheader,
                'checkoutmail_footer' => $checkoutfooter,
                'registermail_header' => $registerheader,
                'registermail_footer' => $registerfooter,
                'paymentmail_header' => $paymentheader,
                'paymentmail_footer' => $paymentfooter
            ]);
            if($q){
                    return redirect()->back()->with('success-update', 'Success update web configuration');
            }

        }else{
        return redirect('admin/login');
        }
    }


}
