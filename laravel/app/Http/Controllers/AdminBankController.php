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
class AdminBankController extends Controller {

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

    public function getBank(){
        if(Session::get('sessionadmin')){    
            //Brands      
            $banks = DB::table('bank')->get();
            return view('admin/bank-list',
            [
                'banks'=> $banks,    
            ]); 
        }else{
            return redirect('admin/login');
        }
    }
    public function getBankAdd(){
        if(Session::get('sessionadmin')){   
        
            return view('admin/bank-list-add');
        }else{
            return redirect('admin/login');
        }
    }
    public function postBankAdd(){
        if(Session::get('sessionadmin')){ 
            $banksname=Input::get('banksname');
            $accountNumber=Input::get('banksAccountNumber');
            $accountName=Input::get('banksAccountName');
            $location=Input::get('banksLocation');    
             // checking file is valid.
            if (Input::hasFile('banksLogo')) {

                if (Input::file('banksLogo')->isValid()) {
                    $destinationPath_banks = 'img/bank-logo/'; // upload path
                    $destinationPath_banks_thumb = 'img/bank-logo/thumbnails/'; // upload path
                    $extension = Input::file('banksLogo')->getClientOriginalExtension(); // getting image extension
                    $fileNameBanks = uniqid().".".$extension; // rename image
                     //Rezize
                    Image::make(Input::file('banksLogo')->getRealPath())->resize(500, null, function ($constraint) { $constraint->aspectRatio();})->save($destinationPath_banks . $fileNameBanks);
                    Image::make(Input::file('banksLogo')->getRealPath())->resize(70, null, function ($constraint) { $constraint->aspectRatio();})->save($destinationPath_banks_thumb . $fileNameBanks);
                }
            }else{
                $fileNameBanks ='';
            }
            DB::table('bank')->insert([     
            'bankname' => $banksname,
            'banknumber' => $accountNumber,
            'bankholder' => $accountName,
            'banklogo'  => $fileNameBanks,
            'location'  => $location
            ]
            );
            return redirect('admin/bank')->with('success-create', 'Success sumbit new brands');
        }else{
            return redirect('admin/login');
        }
    }
    public function getBankDetail($bank_id){
        if(Session::get('sessionadmin')){    
            //Brands View
            $banks = DB::table('bank')->where('bank_id','=',$bank_id)->get();
            return view('admin/bank-list-view',
            [
            'banks'=> $banks,    
            ]); 
        }else{
            return redirect('admin/login');
        }
    }
    public function postBankDetail($bank_id){
        if(Session::get('sessionadmin')){
                $name=Input::get('banksname');
                $accountNumber=Input::get('banksAccountNumber');
                $accountName=Input::get('banksAccountName');
                $location=Input::get('banksLocation');
                
                //echo ($brandsidView);
                if(empty(Input::file('banksLogoEdited'))){//No update logo
                    
                       $q=DB::table('bank')->where('bank_id','=',$bank_id)->update([            
                        'bankname' => $name,
                        'banknumber' => $accountNumber,
                        'bankholder' => $accountName,
                        'location'  => $location
                       ]);

                        return redirect('admin/bank')->with('success-update', 'Success update Banks');
                }else{
                    if (Input::file('banksLogoEdited')->isValid()) {
                      $destinationPath = 'img/bankLogo/'; // upload path
                      $destinationPathThumb = 'img/bankLogo/thumb/'; // upload path
                      $extension = Input::file('banksLogoEdited')->getClientOriginalExtension(); // getting image extension
                      $fileName = rand(11111,99999).".".$extension; // renameing image

                     Image::make(Input::file('banksLogoEdited')->getRealPath())->resize(500, null, function ($constraint) { $constraint->aspectRatio();})->save($destinationPath . $fileName);
                    Image::make(Input::file('banksLogoEdited')->getRealPath())->resize(70, null, function ($constraint) { $constraint->aspectRatio();})->save($destinationPathThumb . $fileName);
           

                       $q=DB::table('banks')->where('bank_id','=',$bank_id)->update([          
                        'bankname' => $name,
                        'banknumber' => $accountNumber,
                        'bankholder' => $accountName,
                        'banklogo'  => $fileNameBanks,
                        'location'  => $location
                       ]);
                        return redirect('admin/bank')->with('success-update', 'Success update Banks');
                    }
                } 
        }else{
            return redirect('admin/login');
        }
    }

    public function getbanksdelete($bank_id){
        if(Session::get('sessionadmin')){ 
            $delete = DB::table('bank')->where('bank_id', '=', $bank_id)->delete();
            if($delete){
                return Redirect()->back()->with('success-delete', 'Success deleting data');
            }
        }else{
        return redirect('admin/login');
        }
    }
}