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
class AdminPagesController extends Controller {
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

  public function getpages(){

      if(Session::get('sessionadmin')){
          //Pages
          $page = DB::table('pages')->join('users','pages.by','=','users.id')->get();
          return view('admin/pages',
          [
              'pages'=> $page,
          ]);
      }else{
      return redirect('admin/login');
      }
  }


  public function getpagescreate(){
      if(Session::get('sessionadmin')){
          //Pages Create
          return view('admin/pages-create');
      }else{
      return redirect('admin/login');
      }
  }
  public function postpagescreate(){
      if(Session::get('sessionadmin')){
          $name       =Input::get('name');
          $title      =Input::get('title');
          $enable     =Input::get('enable');
          $content    =Input::get('content');

          $by=Session::get('adminid');
          $now= new DateTime();
          DB::table('pages')->insert([
          'name'          => "page/".$name,
          'title'         => $title,
          'enable'        => $enable,
          'content'       => $content,
          'by'            => $by,
          'create_at'     => $now,
          'lastupdate'    => 'Never'
          ]);
          return redirect('admin/pages')->with('success-create', 'Success create new page');
      }else{
      return redirect('admin/login');
      }

  }

  public function getpagesdelete($pagesid){
      if(Session::get('sessionadmin')){
           $deletepage = DB::table('pages')->where('pagesid', '=', $pagesid)->delete();

          if($deletepage){
              return Redirect()->back()->with('success-delete', 'Success deleting data');
          } //else {
              //return Redirect::back()->withErrors("Error, Please contact administrator!")->withInput();
          //}
      }else{
      return redirect('admin/login');
      }

  }
  public function getpagesdetails($pagesid){

      if(Session::get('sessionadmin')){
          //Brands View
          $pages = DB::table('pages')->where('pagesid','=',$pagesid)->first();
          return view('admin/pages-details',
          [
          'pages'=> $pages,
          ]);
      }else{
          return redirect('admin/login');
      }
  }

   public function postpagesdetails(){
      if(Session::get('sessionadmin')){
          $name=Input::get('name');
          $title=Input::get('title');
          $enable=Input::get('enable');
          $content=Input::get('content');
          $pagesid=Input::get('pagesid');

          $by=Session::get('adminid');
          $now= new DateTime();
          $q=DB::table('pages')->where('pagesid','=',$pagesid)->update([
          'name' => $name,
          'title' => $title,
          'enable' => $enable,
          'content' => $content,
          'by' => $by,
          'lastupdate' => $now
          ]);
          if($q){
              return redirect('admin/pages')->with('success-update', 'Success update page');
          }
      }else{
      return redirect('admin/login');
      }

  }
}
?>
