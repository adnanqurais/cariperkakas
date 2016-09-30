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
use Paginate;
use User;
use Cart;
use DateTime;
use PHPMailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Auth\Guard;
class FrontController extends Controller {



	public function __construct()
	{
		$this->middleware('guest');
	}
	public function index()	{
        //Site Configuration
        $configuration = DB::table('configuration')->first();
        $cate_view = DB::table('product_category')->where('enable', '=', 1)->get();
				// dd($cate_view );
        // exit();
        // $allProduct = DB::table('product')->leftJoin('product_category', 'product.category', '=','product_category.categoryid')->where('product.enable', '=', 1 )->get();
        foreach ($cate_view as $c){
            // $homeProducts = DB::table('product')->leftjoin('product_category', 'product.category', '=', 'product_category.categoryid')->take(4)->get();
			$homeProducts[$c->categoryid] = DB::table('product')
			->where('product.category', $c->categoryid)->take(4)->get();

            $subcate[$c->categoryid] = DB::table('product_category')
            ->where('product_category.parent', $c->categoryid)
            ->where('enable', '=', 1)->take(6)->get();

            foreach($homeProducts[$c->categoryid] as $prod){
                $image_product = DB::table('product_image')->where('productid', '=', $prod->productid)->orderBy('productimageid', 'Asc')->get();

                $i = 0;
                foreach($image_product as $prodimg){
                    $i++;
                    if($i == '1'){
                        $product_image['image_small'][$prod->productid] = $prodimg->image_small;
                    }
                }
            }

        }

        //Brands slider
        $brands = DB::table('brands')->get();
        //Cart
        $content = Cart::content();

        //slider
        $slider = DB::table('slider')->get();
        return view('home',
         [
            'config'                    =>  $configuration,
            'category_view'             =>  $cate_view,
            'subcate'                   =>  $subcate,
            'homeProducts'              =>  $homeProducts,
            'products_img'              =>  $product_image,
            'brands'                    =>  $brands,
            'homeslider'                =>  $slider,
            'cart'                      =>  $content
        ]);
	}

    public function errorpage()
	{
        //Site Configuration
        $configuration = DB::table('configuration')->first();
        //Category menu slider
        $prod_cate = DB::table('product_category')->get();
        //Brands slider
        $brands = DB::table('brands')->get();
        return view('errors/503',
        [
        'prod_category'=>$prod_cate,
        'config' => $configuration,
        'brands'=>$brands
        ]);
	}

  public function getlogin()
	{
        //Site Configuration
        $configuration = DB::table('configuration')->first();
        //Brands slider
        $brands = DB::table('brands')->get();
        //Cart
        $content = Cart::content();
        return view('login',
        [
        'config' => $configuration,
        'brands'=>$brands,
        'cart'=>$content
        ]);
	}

    //--------------------------------------------------------------------------------------------
    //REGISTER FUNCTION
    //--------------------------------------------------------------------------------------------
    public function getregister(){
        //Site Configuration
        $configuration = DB::table('configuration')->first();
        //Brands slider
        $brands = DB::table('brands')->get();
        //Cart
        $content = Cart::content();
        return view('register',
        [
        'prod_subcategory'=> array(),
        'config' => $configuration,
        'brands'=>$brands,
        'cart'=>$content
        ]);
	}

    //--------------------------------------------------------------------------------------------
    //USER LOGIN START
    //--------------------------------------------------------------------------------------------
    public function getaccount(){
            return Redirect('account/profile');
    }

    public function getaccountprofile(){

        if(Session::get('sessionmember')){

            //Session Login
            $id = Session::get('memberid');

            //Site Configuration
            $configuration = DB::table('configuration')->first();
            //Brands slider
            $brands = DB::table('brands')->get();
            //Cart
            $content = Cart::content();
            $users= DB::table('users')->where('id',$id)->get();
            foreach($users as $user){
                $fullname=$user->fullname;
            }


            $city=DB::table('city')->get();
            $province=DB::table('province')->get();

            return view('account-profile',
            [
            'config' => $configuration,
            'brands'=>$brands,
            'user'=>$user,
            'cart'=>$content,
            'city'=>$city,
            'province'=>$province
            ]);

        }else{
            Session::flash('error_must_login','Anda harus masuk.');
            return Redirect('login');
        }
    }


    public function postaccountprofile()
    {
        if(Session::get('sessionmember')){

            $id = Session::get('memberid');
            $email=Input::get('email');
            $poscode=Input::get('poscode');
            $handphone=Input::get('handphone');
            $fullname=Input::get('fullname');
            $address=Input::get('address');
            $city=Input::get('city');
            $province=Input::get('province');
            $now= new DateTime();
            //get Users
            $user= DB::table('users')->where('id','=',$id)->first();

            //Check email
            $use = DB::table('users')->where('email','=',$email)->first();

            if($email == $user->email){

                 $q=DB::table('users')
                    ->where('id','=',$id)
                    ->update([
                        'poscode'=>$poscode,
                        'handphone' => $handphone,
                        'fullname' => $fullname,
                        'address' => $address,
                        'city'=>$city,
                        'province'=>$province,
                        'updated_at'=>$now
                    ]);
                    if($q){
                        Session::set('membername',$fullname);
                        return redirect()->back()->with('success-update-profile', 'Success update profile');
                    }

            }else{

                if(count($use)>0){
                        return redirect()->back()->with('emailready', 'Email is ready !')->withInput();
                }else{
                    $q=DB::table('users')
                    ->where('id','=',$id)
                    ->update([
                        'email' => $email,
                        'poscode'=>$poscode,
                        'handphone' => $handphone,
                        'fullname' => $fullname,
                        'address' => $address,
                        'city'=>$city,
                        'province'=>$province,
                        'updated_at'=>$now
                    ]);
                    if($q){

                        Session::set('membername',$fullname);
                        return redirect()->back()->with('success-update-profile', 'Success update profile');
                    }
                }
            }
        }else{
            Session::flash('error_must_login','Anda harus masuk.');
            return Redirect('login');
        }

    }

    //--------------------------------------------------------------------------------------------
    //USER LOGIN END
    //--------------------------------------------------------------------------------------------



    //--------------------------------------------------------------------------------------------
    //ORDER FUNCTION
    //------------------------------------------------------------------------------------------
    public function getaccountinvoice(){
        //Site Configuration
        $configuration = DB::table('configuration')->first();
        $banks = DB::table('bank')->get();

        //Brands slider
        $brands = DB::table('brands')->get();
        //Cart
        $content = Cart::content();

        if(Session::get('sessionmember')){
            $id=Session::get('memberid');
            //Purchase Data
            $invoice = DB::table('invoice')->where('byusers','=',$id)->orderBy('invoiceid', 'desc')->get();
            $users= DB::table('users')->where('id',$id)->first();

            return view('account-invoice',
            [
                'config'        => $configuration,
                'brands'        =>$brands,
                'user'          =>$users,
                'newinvoice'    =>$invoice,
                'cart'          =>$content,
                'banks'         =>$banks
            ]);

        }else{
            return Redirect('guest/invoice');
        }
    }

    public function getguestinvoice(){
        //user input
        $email=Input::get('email');
        $user = DB::table('users')->where('email', '=', $email)->first();

        //Site Configuration
        $configuration = DB::table('configuration')->first();
        $banks = DB::table('bank')->get();

        //Brands slider
        $brands = DB::table('brands')->get();
        //Cart
        $content = Cart::content();

        //CHECK byusers VALUE
        $checkByUsers = DB::table('invoice')->where('order_email','=',$email)->where('byusers','=',0)->orderBy('status', 'desc')->first();

        //LOAD DATA OR REDIRECT TO LOGIN PAGE
        if(count($user)>0 && $checkByUsers->byusers != 0){
           return Redirect('login')->with('emailalready','Email is registered! Please Login as Member')->withInput();
        }else{
            ////Purchase Data
            $invoice = DB::table('invoice')->where('order_email','=',$email)->where('byusers','=',0)->orderBy('status', 'desc')->get();

            return view('guest-invoice',
            [
                'config'        => $configuration,
                'brands'        =>$brands,
                'newinvoice'    =>$invoice,
                'cart'          =>$content,
                'banks'         =>$banks
            ]);
        }
    }


    public function getaccountinvoicedetails($orderid)
    {
        if(Session::get('sessionmember')){
            $id=Session::get('memberid');
            //Site Configuration
            $configuration = DB::table('configuration')->first();
            //Brands slider
            $brands = DB::table('brands')->get();
            //Cart
            $content = Cart::content();

            $users= DB::table('users')->where('id',$id)->first();

            //foreach($users as $user){
            //    $fullname=$user->fullname;
            //}

            $invoice = DB::table('invoice')->where('invoiceid','=',$orderid)->first();


            $detailinvoice = DB::table('orders_details')
                            ->leftJoin('product', 'orders_details.product_id', '=', 'product.productid')
							->leftJoin('product_variation', 'orders_details.var_id', '=', 'product_variation.var_id')
                            ->where('invoiceid','=',$orderid)
                            ->get();

						//var_dump($detailinvoice);
						//exit();
            return view('account-invoice-details',
            [
                'config' => $configuration,
                'brands'=>$brands,
                'user'=>$users,
                'invoice'=>$invoice,
                'detailinvoice'=>$detailinvoice,
                'cart'=>$content
            ]);

        }else{
           //Site Configuration
            $configuration = DB::table('configuration')->first();
            //Brands slider
            $brands = DB::table('brands')->get();
            //Cart
            $content = Cart::content();

            $invoice = DB::table('invoice')->where('invoiceid','=',$orderid)->first();

            $detailinvoice = DB::table('orders_details')
														->leftJoin('product', 'orders_details.product_id', '=', 'product.productid')
														->leftJoin('product_variation', 'orders_details.var_id', '=', 'product_variation.var_id')
                            ->where('invoiceid','=',$orderid)
                            ->get();


            return view('account-invoice-details',
            [
                'config' => $configuration,
                'brands'=>$brands,
                'invoice'=>$invoice,
                'detailinvoice'=>$detailinvoice,
                'cart'=>$content
            ]);

        }
    }

    //--------------------------------------------------------------------------------------------
    //ORDER FUNCTION END
    //--------------------------------------------------------------------------------------------


    //--------------------------------------------------------------------------------------------
    //PAGES FUNCTION
    //--------------------------------------------------------------------------------------------
    public function getpage($pages){

        //Site Configuration
        $configuration = DB::table('configuration')->first();
        //Brands slider
        $brands = DB::table('brands')->get();
        //Cart
        $content = Cart::content();


        //All Page
        $allpages = DB::table('pages')->get();

        //Page
        $pages = DB::table('pages')->where('name','=',$pages)->get();

        if(($pages)==0){
            return Redirect('/')->with('notfound', 'Pages not found');
        }else{
            return view('page',
            [
            'config' => $configuration,
            'brands'=>$brands,
            'allpages' => $allpages,
            'pages' => $pages,
            'cart'=>$content
            ]);
        }
    }
    //--------------------------------------------------------------------------------------------
    //PAGES FUNCTION ENDS
    //--------------------------------------------------------------------------------------------


    //--------------------------------------------------------------------------------------------
    //CART & CHECKOUT FUNCTION
    //--------------------------------------------------------------------------------------------



     public function getcheckoutinformation(){
         //Site Configuration
        $configuration = DB::table('configuration')->first();
        //Site Configuration
        $bank = DB::table('bank')->get();
        //Brands slider
        $brands = DB::table('brands')->get();
        //Cart
        $content = Cart::content();

        if(Session::get('sessionmember')){
            $id=Session::get('memberid');
            $users = DB::table('users')->where('id',$id)->first();

            $pro = DB::table('province')->get();
            $city = DB::table('city')->get();

            return view('checkout-information',
            [
            'config' => $configuration,
            'brands'=>$brands,
            'banks'=>$bank,
            'cart'=>$content,
            'users'=>$users,
            'province'=>$pro,
            'city'=>$city
            ]);


        }else{
            return view('checkout-information',
            [
                'config' => $configuration,
                'brands'=>$brands,
                'banks'=>$bank,
                'cart'=>$content
            ]);
        }
    }

    public function postcheckoutinformation(){

            //Site Configuration
            $configuration = DB::table('configuration')->first();

            //GET SHIPPING INFORMATION
            $province               = Session::get('provincename');
            $city                   = Session::get('cityname');
            $subdistrict            = Session::get('subdistrictname');
			$courier                = Session::get('kurir');
            $package                = Session::get('package');
            $ongkir                 = Session::get('ongkir');
            $paymentMethod          = input::get('paymentMethod');
            $total_product_payment  = Cart::total();

            //echo $subdistrict;
            //exit();

            //Input
            $fullname   =	Session::get('fullnameSession');
            $email      =   Session::get('emailSession');
            $address    =	Session::get('addressSession');
            $poscode    =	Session::get('poscodeSession');
            $handphone  =	Session::get('handphoneSession');
            $note       =	Session::get('noteSession');

            //Voucher
            $vcode      =	Session::get('vouchercode');
            $type       =	Session::get('vouchertype');
            $val        =	Session::get('vouchervalue');

            //
            $now 		= new DateTime();
            $content 	= Cart::content();
            $count		= Cart::count(false);

            if(!empty(Session::get('vouchercode'))) {
                $v=DB::table('voucher')->where('code','=',Session::get('vouchercode'))->first();
                if(count($v)>0){
                    $vc=$v->code;
                    if($v->type==1){
                        $disc=Cart::total()/100*Session::get('vouchervalue');
                        $total=Cart::total()-$disc;
                    }elseif($v->type==2){
                        $total=Cart::total()-Session::get('vouchervalue');
                        $disc=Session::get('vouchervalue');
                    }
                }


            }else{
                        $vc=0;
                        $disc=0;
                        $total = Session::get('shoptotal');
            }

			/*-------------------------------------------------
            ---------------------------------------------------
            /*****CHECKOUT PROCESS********/
		    /*--------------------------------------------------
            ---------------------------------------------------*/
        if(Session::get('sessionmember')){
            $id=Session::get('memberid');

            /*-------------------------------------------------
            ---------------------------------------------------
            ----THIS PART CHECKOUT isset for MEMBER CHECKOUT----
            --------------------------------------------------
            ---------------------------------------------------*/

            $q=DB::table('invoice')->insertGetId([
                    'total'                     => $total,
                    'total_product_payment'     => $total_product_payment,
                    'vouchercode'               => $vc,
                    'disc'                      => $disc,
                    'orderdate'                 => $now,
                    'byusers'                   => $id,
                    'order_fullname'            => $fullname,
                    'order_email'               => $email,
                    'order_address'             => $address,
                    'order_poscode'             => $poscode,
                    'order_handphone'           => $handphone,
                    'order_note'                => $note,
                    'order_province'            => $province,
                    'order_city'                => $city,
                    'order_subdistrict'         => $subdistrict,
					'shipping_courier'          => $courier,
                    'shippingpackage'           => $package,
                    'shippingcost'              => $ongkir,
                    'payment_method'            => $paymentMethod
            ]);

            $invoiceid = DB::table('invoice')->orderby('invoiceid','desc')->first();
            //// Insert Orders Detail
            foreach($content as $row){
				if($row->options->var_id != 0 || $row->options->var_id != NULL || $row->options->var_id !=""){
					$detail1 = DB::table('product_variation')->select('var_code')->where('var_id','=',$row->options->var_id)->first();
                    $detailValue = $detail1->var_code;
				}else{
					$detail1 = DB::table('product')->select('code')->where('productid','=',$row->id)->first();
                    $detailValue = $detail1->code;
				}
				DB::table('orders_details')
					->insert([
						'invoiceid'     => $q,
						'product_id'    => $row->id,
						'var_id'   		=> $row->options->var_id,
						'productcode'   => $detailValue,
						'qty'           => $row->qty,
						'subtotal'      => $row->subtotal
				]);


                //Stock Change
                $prod=DB::table('product')->where('productid','=',$row->id)->first();
				if($row->options->var_id != 0 || $row->options->var_id != NULL){
						$prod_var = DB::table('product_variation')->where('var_id','=',$row->options->var_id)->first();
				}
                if($row->options->var_id != 0 || $row->options->var_id != NULL){
                    $cut =$prod_var->var_stock - $row->qty;
                    DB::table('product_variation')
                    ->where('var_id','=',$row->options->var_id)
                    ->update([
                        'var_stock' => $cut
                    ]);
                }else{
                    $cut =$prod->stock - $row->qty;
                    DB::table('product')
                    ->where('code','=',$row->id)
                    ->update([
                        'stock' => $cut
                    ]);
                }
            }

            DB::table('users')
            ->where('id','=',$id)
            ->update([
                    'fullname'      => $fullname,
                    'email'         => $email,
                    'address'       => $address,
                    'province'      => $province,
                    'city'          => $city,
                    'poscode'       => $poscode,
                    'handphone'     => $handphone
            ]);



            $order= DB::table('invoice')->where('invoiceid','=',$invoiceid->invoiceid)->first();

            Cart::destroy();
            Session::forget('vouchercode');
            Session::forget('vouchertype');
            Session::forget('vouchervalue');

                //Sending Mail
                //===============================================================================================
                //Site Configuration
                $config = DB::table('configuration')->first();
                $users = DB::table('users')->where('id',$id)->first();
               //PHPMailer Object
                $mail = new PHPMailer;
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
                $mail->Body = $configuration->checkoutmail_header;
                $mail->AltBody = "This is the plain text version of the email content";
                if(!$mail->send())
                {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                }
                else
                {
                    //Sending Mail
                    //===============================================================================================
                    Session::set('membername',  $fullname);
                    if($paymentMethod == "transfer"){
                        //echo "BISA NIH";
                        // Forget Shipping Session
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
                          return Redirect('account/invoice/details/'.$invoiceid->invoiceid)->with('success-add', 'Pesanan berhasil di tambahkan ! Silahkan lakukan pembayaran untuk melanjutkan');
                    }elseif($paymentMethod == "creditcard"){
                        // Forget Shipping Session
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
                        return Redirect('account/invoice/details/'.$invoiceid)->with('success-add', 'Pesanan berhasil di tambahkan ! Silahkan lakukan pembayaran untuk melanjutkan');
                }
            }
        }else{


            /*-------------------------------------------------
            ---------------------------------------------------
            ----THIS PART CHECKOUT is set for GUEST CHECKOUT----
            --------------------------------------------------
            ---------------------------------------------------*/


                $q=DB::table('invoice')->insertGetId([
                    'total'             		=> $total,
                    'total_product_payment'     => $total_product_payment,
                    'vouchercode'       		=> $vc,
                    'disc'              		=> $disc,
                    'orderdate'        			=> $now,
                    'order_fullname'            => $fullname,
                    'order_email'               => $email,
                    'order_address'             => $address,
                    'order_poscode'             => $poscode,
                    'order_handphone'           => $handphone,
                    'order_note'                => $note,
                    'order_province'            => $province,
                    'order_city'                => $city,
                    'order_subdistrict'         => $subdistrict,
					'shipping_courier'  	    => $courier,
                    'shippingpackage'   		=> $package,
                    'shippingcost'      		=> $ongkir,
                    'payment_method'    		=> $paymentMethod
            ]);

            $invoiceid = DB::table('invoice')->orderby('invoiceid','desc')->first();
            //// Insert Orders Detail
            foreach($content as $row){
			    if($row->options->var_id != 0 || $row->options->var_id != NULL || $row->options->var_id !=""){
				    $detail1 = DB::table('product_variation')->select('var_code')->where('var_id','=',$row->options->var_id)->first();
				    $detailValue = $detail1->var_code;
			    }else{
				    $detail1 = DB::table('product')->select('code')->where('productid','=',$row->id)->first();
				    $detailValue = $detail1->code;
			    }
				    // print_r($detail1);
				    // print_r($row->options->var_id);
				    // echo " ";
				    // print_r($row->id);
				    // exit();
                DB::table('orders_details')
                    ->insert([
                        'invoiceid'     => $q,
						'product_id'   	=> $row->id,
						'var_id'   		=> $row->options->var_id,
                        'productcode'   => $detailValue,
                        'qty'           => $row->qty,
                        'subtotal'      => $row->subtotal
                ]);

                //Stock Change
                $prod=DB::table('product')->where('productid','=',$row->id)->first();
				if($row->options->var_id != 0 || $row->options->var_id != NULL){
						$prod_var = DB::table('product_variation')->where('var_id','=',$row->options->var_id)->first();
				}
                //var_dump($row->options->var_id);
                if($row->options->var_id != 0 || $row->options->var_id != NULL){
                    $cut =$prod_var->var_stock - $row->qty;
                    DB::table('product_variation')
                    ->where('var_id','=',$row->options->var_id)
                    ->update([
                        'var_stock' => $cut
                    ]);
                }else{
                    $cut =$prod->stock - $row->qty;
                    DB::table('product')
                    ->where('code','=',$row->id)
                    ->update([
                        'stock' => $cut
                    ]);
                }
            }
                Cart::destroy();
                Session::forget('vouchercode');
                Session::forget('vouchertype');
                Session::forget('vouchervalue');



                //Sending Mail
                //===============================================================================================
                //Site Configuration
                $config = DB::table('configuration')->first();
               //PHPMailer Object
                $mail = new PHPMailer;
                $mail->SMTPDebug = 3;                               // Enable verbose debug output

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
                $mail->Body = $configuration->checkoutmail_header;
                $mail->AltBody = "This is the plain text version of the email content";
                if(!$mail->send())
                {
                    //IF EMAIL NOT SENT
                    echo "Mailer Error: " . $mail->ErrorInfo;
                }
                else
                {
                    //IF EMAIL SENT
                    Session::set('membername',  $fullname);
                    if($paymentMethod == "transfer"){
                        //echo "BISA NIH";
                        // Forget Shipping Session
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
                          return Redirect('account/invoice/details/'.$invoiceid->invoiceid)->with('success-add', 'Pesanan berhasil di tambahkan ! Silahkan lakukan pembayaran untuk melanjutkan');
                    }elseif($paymentMethod == "creditcard"){
                        // Forget Shipping Session
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
                        return Redirect('account/invoice/details/'.$invoiceid)->with('success-add', 'Pesanan berhasil di tambahkan ! Silahkan lakukan pembayaran untuk melanjutkan');
                    }

                }
        }
    }
    //--------------------------------------------------------------------------------------------
    //CART & CHECKOUT FUNCTION END
    //--------------------------------------------------------------------------------------------


    //--------------------------------------------------------------------------------------------
    //PAYMENT CONFIRMATION
    //--------------------------------------------------------------------------------------------
    public function getpaymentconfirmation(){
        //Site Configuration
        $configuration = DB::table('configuration')->first();
        //Brands slider
        $brands = DB::table('brands')->get();
        //Cart
        $content = Cart::content();
        return view('payment-confirmation',
        [
        'config' => $configuration,
        'brands'=>$brands,
        'cart'=>$content
        ]);

    }

    public function getpaymentconfirmationwithid($orderid){
        //Site Configuration
        $configuration = DB::table('configuration')->first();
        //Brands slider
        $brands = DB::table('brands')->get();
        //Cart
        $content = Cart::content();
        return view('payment-confirmation',
        [
        'config' => $configuration,
        'brands'=>$brands,
        'cart'=>$content,
        'orderid'=>$orderid
        ]);
    }


    public function postpaymentconfirmation(){
        $orderid=Input::get('orderid');
        $bankacc=Input::get('bankaccount');
        $bank=Input::get('bank');
        $email=Input::get('email');
        $transferdate=Input::get('transferdate');
        $transferammount=Input::get('transferammount');
        $notes=Input::get('notes');
        $now= new DateTime();


        $order = DB::table('invoice')
            ->where('invoiceid','=',$orderid)
            ->where('status','=',0)
            ->get();
        if(count($order)==0){
                return redirect()->back()->with('idnotfound', 'Order ID not found !')->withInput();
        }else{

                if(!empty(Input::file('image'))){
                    if (Input::file('image')->isValid()) {
                          $destinationPath = 'img/payment'; // upload path
                          $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                          $fileName = rand(11111,99999).'.'.$extension; // renameing image

                          Input::file('image')->move($destinationPath, $fileName); // uploading file to given path    //

                          $q=DB::table('payment')->insert([
                            'invoiceid' => $orderid,
                            'bankaccountname' => $bankacc,
                            'bank'=>$bank,
                            'email' => $email,
														'status' => 1,
                            'transferdate' => $transferdate,
                            'transferammount' => $transferammount,
                            'notes'=>$notes,
                            'image'=>$fileName,
                            'created_at'=>$now
                        ]);

                        $data=DB::table('invoice')->where('invoiceid','=',$orderid)->first();

                        $configuration=DB::table('configuration')->first();

                        if($q){

                            //Sending Mail   ===============================================================================================
                            $mail = new PHPMailer;
                            $mail->IsMAIL();
                            $mail->From = $configuration->email;
                            $mail->FromName = $configuration->sitename;
                            $mail->addAddress($email, "");
                            //Send HTML or Plain Text email
                            $mail->isHTML(true);
                            $mail->Subject = "Register";
                            $mail->Body = $configuration->registermail_header.'<br>Content here<br>'.$configuration->registermail_header;
                            $mail->AltBody = "This is the plain text version of the email content";

                            if(!$mail->send()){
                                echo "Mailer Error: " . $mail->ErrorInfo;
                            }else{
                                return redirect()->back()->with('success-submit-payment', 'Success sumbit payment');
                            }
                        }
                    }
                }else{

                        $q=DB::table('payment')->insert([
                            'invoiceid' => $orderid,
                            'bankaccountname' => $bankacc,
                            'bank'=>$bank,
														'status' => 1,
                            'email' => $email,
                            'transferdate' => $transferdate,
                            'transferammount' => $transferammount,
                            'notes'=>$notes,
                            'created_at'=>$now
                        ]);

                        $configuration=DB::table('configuration')->first();

                        $data=DB::table('invoice')->where('invoiceid','=',$orderid)->first();

                        if($q){
                            //Sending Mail   ===============================================================================================
                            $mail = new PHPMailer;
                            $mail->IsMAIL();
                            $mail->From = $configuration->email;
                            $mail->FromName = $configuration->sitename;
                            $mail->addAddress($email, "");
                            //Send HTML or Plain Text email
                            $mail->isHTML(true);
                            $mail->Subject = "Register";
                            $mail->Body = $configuration->registermail_header.'<br>Content here<br>'.$configuration->registermail_header;
                            $mail->AltBody = "This is the plain text version of the email content";

                            if(!$mail->send()){
                                echo "Mailer Error: " . $mail->ErrorInfo;
                            }else{
                                return redirect()->back()->with('success-submit-payment', 'Success sumbit payment');
                            }
                            return redirect('payment-confirmation')->with('success-submit-payment', 'Success sumbit payment');
                        }

                }
        }

    }
    //--------------------------------------------------------------------------------------------
    //PAYMENT CONFIRMATION END
    //--------------------------------------------------------------------------------------------


    public function postsearch()
    {
        $by="search";
        $keyword=Input::get('keyword');
        if(preg_match('/^ *$/', $keyword)){
            return redirect('product/')->with('category-notfound', 'Produk tidak ada ! Silahkan pilih produk lain nya');
        }else{
            return redirect('product/search/'.$keyword);
        }


    }


    public function getallcategory(){
        //Site Configuration
        $configuration = DB::table('configuration')->first();
        //Brands slider
        $brands = DB::table('brands')->get();
        //Cart
        $content = Cart::content();

        $catmenu = DB::table('product_category')->where('enable', '=', 1)->get();
        foreach ($catmenu as $ca){
            $scatmenu[$ca->categoryid] = DB::table('product_subcategory')->where('enable', '=', 1 )->where('categoryid', $ca->categoryid)->get();
        }

        /** GET ALL PRODUCT
         **
         **
         **
         **
         **SET URL FOR PRODUCT PAGES*/
        $product_category_prod = DB::table('product')->leftjoin('product_category', 'product.category', '=', 'product_category.categoryid')->paginate(9);
        $product_category_prod->setPath('product');
        //END

        if(!empty($product_category_prod)){
            foreach($product_category_prod as $prod){
                $product_category_prodimg = DB::table('product_image')->where('productid', '=', $prod->productid)->orderBy('productimageid', 'Asc')->get();
                $i = 0;
                if(!empty($product_category_prodimg)){
                    foreach($product_category_prodimg as $prodimg){
                        $i++;
                        if($i == '1'){
                            $product_image['image_small'][$prod->productid] = $prodimg->image_small;
                            $product_image['image_thumb'][$prod->productid] = $prodimg->image_thumb;
                            $product_image['image_large'][$prod->productid] = $prodimg->image_large;
                        }
                    }
                }else{
                    $product_image['image_small'][$prod->productid] = "";
                    $product_image['image_thumb'][$prod->productid] = "";
                    $product_image['image_large'][$prod->productid] = "";
                }
            }
        }else{
                return redirect('product')->with('category-notfound', 'Produk tidak ada ! Silahkan pilih produk lain nya');
        }

        //View
        return view('product-category',[
        'categorymenu'=>$catmenu,
        'subcategorymenu'=>$scatmenu,
        'products'=>$product_category_prod,
        'products_img'=>$product_image,
        'config' => $configuration,
        'brands'=>$brands,
        'cart'=>$content
        ]);


    }

    public function getcategory($by,$keyword){
        //Site Configuration
        $configuration = DB::table('configuration')->first();
        //Brands slider
        $brands = DB::table('brands')->get();
        //Cart
        $content = Cart::content();

        $pagelimit=1;

       //$cate = DB::table('product_subcategory')
            //->join('product_category', 'product_subcategory.categoryid', '=', 'product_category.categoryid')
            //->select('product_category.*', 'product_subcategory.subcategorytitle')
         //   ->get();

        $catmenu = DB::table('product_category')->where('enable', '=', 1)->get();
        foreach ($catmenu as $ca){
            $scatmenu[$ca->categoryid] = DB::table('product_subcategory')->where('enable', '=', 1 )->where('categoryid', $ca->categoryid)->get();
        }

        if($by =="search"){
            //By search form

            $search=DB::table('product')->where('producttitle', 'LIKE','%'.$keyword.'%')->first();
            if(count($search)==0){  //by Category
                  return redirect('product')->with('category-notfound', 'Produk tidak ada ! Silahkan pilih produk lain nya');
            }else{
                        $product_category_prod = DB::table('product')->where('producttitle', 'LIKE', '%'.$keyword.'%')
                        ->leftjoin('product_category', 'product.category', '=', 'product_category.categoryid')
                        ->paginate(9)->setPath($keyword);
                        if(count($product_category_prod)>0){
                            foreach($product_category_prod as $prod){
                                $product_category_prodimg = DB::table('product_image')->where('productcode', '=', $prod->code)->orderBy('productimageid', 'Asc')->get();
                                $i = 0;
                                if(!empty($product_category_prodimg)){
                                    foreach($product_category_prodimg as $prodimg){
                                        $i++;
                                        if($i == '1'){
                                            $product_image['image_small'][$prod->productid] = $prodimg->image_small;
                                            $product_image['image_thumb'][$prod->productid] = $prodimg->image_thumb;
                                            $product_image['image_large'][$prod->productid] = $prodimg->image_large;
                                        }
                                    }
                                }else{
                                    $product_image['image_small'][$prod->productid] = "";
                                    $product_image['image_thumb'][$prod->productid] = "";
                                    $product_image['image_large'][$prod->productid] = "";
                                }
                            }
                        }else{
                            return redirect('product')->with('category-notfound', 'Produk tidak ada ! Silahkan pilih produk lain nya');

                        }


            }
        }elseif($by=="category"){
            $category=DB::table('product_category')->where('categoryname', '=', $keyword)->first();
            if(count($category)==0){  //by Category
                  return redirect('product')->with('category-notfound', 'Produk tidak ada ! Silahkan pilih produk lain nya');
            }else{

                    $product_category_prod = DB::table('product')->where('category', $category->categoryid)
                        ->leftjoin('product_category', 'product.category', '=', 'product_category.categoryid')
												->leftjoin('product_variation', 'product.productid', '=', 'product_variation.product_id')
												->groupBy('productname')
                        ->paginate(12)->setPath($category->categoryname);
                    if(count($product_category_prod)>0){
                    foreach($product_category_prod as $prod){
                        $product_category_prodimg = DB::table('product_image')->where('productid', '=', $prod->productid)->orderBy('productimageid', 'Asc')->get();
                        $i = 0;
                        if(!empty($product_category_prodimg)){
                            foreach($product_category_prodimg as $prodimg){
                                $i++;
                                if($i == '1'){
                                    $product_image['image_small'][$prod->productid] = $prodimg->image_small;
                                    $product_image['image_thumb'][$prod->productid] = $prodimg->image_thumb;
                                    $product_image['image_large'][$prod->productid] = $prodimg->image_large;
                                }
                            }
                        }else{
                            $product_image['image_small'][$prod->productid] = "";
                            $product_image['image_thumb'][$prod->productid] = "";
                            $product_image['image_large'][$prod->productid] = "";
                        }
                    }
                }else{
                  return redirect('product')->with('category-notfound', 'Produk tidak ada ! Silahkan pilih produk lain nya');

                }
            }
        }
         //View
        return view('product-category',[
        'categorymenu'=>$catmenu,
        'subcategorymenu'=>$scatmenu,
        'products'=>$product_category_prod,
        'products_img'=>$product_image,
        'config' => $configuration,
        'brands'=>$brands,
        'cart'=>$content
        ]);


    }

    public function getdetails($productname){
        //get product by name
        $prod_by_name =  DB::table('product')->where('productname','=',$productname)->first();
        //Site Configuration
        $configuration = DB::table('configuration')->first();
        $url = $configuration->url;
        //Brands slider
        $brands = DB::table('brands')->where('enable','=',1)->get();
        //Product details Page
        $prod_detail= DB::table('product')
            ->leftjoin('brands', 'product.brands', '=', 'brands.brandsid')
            ->leftjoin('product_image', 'product.productid', '=', 'product_image.productid')
            ->leftjoin('product_category', 'product.category', '=', 'product_category.categoryid')
            ->where('productname','=',$productname)
            ->first();
            //var_dump($prod_detail );
        $prod_information_details= DB::table('product_details')->where('product_details.product_id','=',$prod_detail->productid)->get();
        $prod_variation = DB::table('product_variation')->where('product_variation.product_id','=',$prod_detail->productid)->orderBy('var_id','asc')->get();
        if($prod_variation != NULL){
            foreach($prod_variation as $pv){
                $prod_variation_details = DB::table('product_variation_details')->where('product_variation_details.var_id','=',$pv->var_id)->get();
                }
        }else{
            $prod_variation_details = 0;
        }

        $prod_img = DB::table('product_image')->where('product_image.productid','=',$prod_detail->productid)->get();
        $prod_img_primary = DB::table('product_image')->where('product_image.productid','=',$prod_detail->productid)->first();

        //Cart
        $content = Cart::content();


        return view('product-details',
        [
        'products'=>$prod_detail,
        'prod_information_details'=>$prod_information_details,
        'prod_variation_details'=>$prod_variation_details,
        'prod_variation'=>$prod_variation,
        'products_img'=>$prod_img,
        'products_img_primary'=>$prod_img_primary,
        'config' => $configuration,
        'brands'=>$brands,
        'cart'=> $content
        ]);


    }

    /**
     * handle data posted by ajax request
     */
    public function postmessage() {
        $msg_name=Input::get('msg_name');
        $msg_email=Input::get('msg_email');
        $msg_message=Input::get('msg_message');
        $now= new DateTime();
        DB::table('messages')->insert([
        'name' => $msg_name,
        'email' => $msg_email,
        'message' => $msg_message,
        'datetime'=>$now
        ]);
    }
}
