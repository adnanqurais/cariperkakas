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
class AdminBrandsController extends Controller {

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
    public function getbrands()
    {

        if(Session::get('sessionadmin')){
            //Brands
            $brand = DB::table('brands')->get();
            return view('admin/brands',
            [
            'brands'=> $brand,
            ]);
        }else{
            return redirect('admin/login');
        }
    }



    public function getbrandsdetails($brandsid){

        if(Session::get('sessionadmin')){
            //Brands View
            $brand = DB::table('brands')->get();
            return view('admin/brands-details',
            [
            'brands'=> $brand,
            ]);
        }else{
            return redirect('admin/login');
        }
    }

    public function postbrandsdetails(){

        if(Session::get('sessionadmin')){

                $name=Input::get('name');
                $ena=Input::get('enable');
                if(empty($ena)){
                    $enable="";
                }else{
                    $enable=Input::get('enable');
                }

                $featured=Input::get('$featured');
                if(isset($featured)){
                    $feat=0;
                }else{
                    $feat=1;
                }

                if(empty(Input::file('image'))){//No update logo

                       $q=DB::table('brands')->update([
                        'name'            => $name,
                        'featured_status' => $feat,
                        'enable'          => $enable
                       ]);

                        return redirect('brands')->with('success-update', 'Success update Brands');

                }else{
                    if (Input::file('image')->isValid()) {
                      $destinationPath = 'img/brand'; // upload path
                      $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                      $fileName = rand(11111,99999).'.'.$extension; // renameing image

                      Input::file('image')->move($destinationPath, $fileName); // uploading file to given path    //

                       $q=DB::table('brands')->update([
                        'name'            => $name,
                        'enable'          => $enable,
                        'featured_status' => $feat,
                        'logo'            => $fileName
                       ]);

                        return redirect('brands')->with('success-update', 'Success update Brands');

                    }


                }
        }else{
        return redirect('admin/login');
        }
    }

    public function getbrandsadd(){

        if(Session::get('sessionadmin')){

            return view('admin/brands-add');
        }else{
        return redirect('admin/login');
        }

    }
    public function getbrandsdelete($brandsid){

        if(Session::get('sessionadmin')){
            $delete = DB::table('brands')->where('brandsid', '=', $brandsid)->delete();
            if($delete){
                return Redirect()->back()->with('success-delete', 'Success deleting data');
            }
        }else{
        return redirect('admin/login');
        }
    }



    public function postbrandsadd(){

        if(Session::get('sessionadmin')){

            $enab=Input::get('enable');
            $brandsname=Input::get('brandsname');
            if(isset($enab)){
                $enable=1;
            }else{
                $enable=0;
            }

            $featured=Input::get('$featured');
            if(isset($featured)){
                $feat=0;
            }else{
                $feat=1;
            }

            if (Input::file('brand')->isValid()) {
                $destinationPath_brand = 'img/brand/'; // upload path
                $extension = Input::file('brand')->getClientOriginalExtension(); // getting image extension
                $fileNamebrand = rand(11111,99999).'.'.$extension; // renameing image
                Image::make(Input::file('brand')->getRealPath())->resize(70, null, function ($constraint) { $constraint->aspectRatio();})->save($destinationPath_brand . $fileNamebrand);
            }

            DB::table('brands')->insert([
            'enable'          => $enable,
            'featured_status' => $feat,
            'name'            => $brandsname,
            'logo'            => $fileNamebrand
            ]
            );
            return redirect('admin/brands')->with('success-create', 'Success sumbit new brands');
        }else{
        return redirect('admin/login');
        }

    }

    public function updateBrandsFeatured($id){
        $fStat = DB::table('brands')->where('brandsid', '=', $id)->first();
        if($fStat->featured_status == 1){
            DB::table('brands')->where('brandsid', '=', $id)->update([
              'featured_status' => 0
            ]);
        }else{
            DB::table('brands')->where('brandsid', '=', $id)->update([
              'featured_status' => 1
            ]);
        }
    }
}
?>
