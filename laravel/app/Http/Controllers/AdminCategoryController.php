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
class AdminCategoryController extends Controller {
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

  public function getcategory()
  {

      if(Session::get('sessionadmin')){
          //Sub Category
          $categ = DB::table('product_category')->orderBy('categoryid', 'desc')->get();
          return view('admin/category',
          [
          'category'=> $categ,
          ]);
      }else{
          return redirect('admin/login');
      }
  }
  public function getcategorydelete($cateid){

      if(Session::get('sessionadmin')){
          $delete = DB::table('product_category')->where('categoryid', '=', $cateid)->delete();
          if($delete){
              return Redirect()->back()->with('success-delete', 'Success deleting data');
          }
      }else{
          return redirect('admin/login');
      }
  }

  public function getcategoryview($cateid)
  {

      if(Session::get('sessionadmin')){
          //Sub Category
          $categ = DB::table('product_category')->where('categoryid','=',$cateid)->first();
          $categ_parent = DB::table('product_category')->get();
          return view('admin/category-detail',
          [
              'category'=> $categ,
              'parent'=> $categ_parent,
          ]);
      }else{
          return redirect('admin/login');
      }

  }

  public function postcategoryview()
  {
      if(Session::get('sessionadmin')){
          $now= new DateTime();
          $id=Input::get('id');
          $title=Input::get('title');
          $name=Input::get('name');
          $parent=Input::get('parent');
          $color=Input::get('color');

          $cate=DB::table('product_category')->where('categoryid','=',$id)->first();

          if(Input::hasFile('imageicon')){
               if (Input::file('imageicon')->isValid()) {
                  $destinationPath_icon = 'img/icon-category/'; // upload path
                  $extension = Input::file('imageicon')->getClientOriginalExtension(); // getting image extension
                  $fileNameicon = rand(11111,99999).'.'.$extension; // renameing image
                  Image::make(Input::file('imageicon')->getRealPath())->resize(70, 70)->save($destinationPath_icon . $fileNameicon);
              }
          }else{
              $fileNameicon =$cate->icon;
          }
          if(Input::hasFile('imagesbanner')){
              if (Input::file('imagesbanner')->isValid()) {
                  $destinationPath_banner = 'img/product/banner/product-category/'; // upload path
                  $extension = Input::file('imagesbanner')->getClientOriginalExtension(); // getting image extension
                  $fileNamebanner = rand(11111,99999).'.'.$extension; // renameing image
                  Image::make(Input::file('imagesbanner')->getRealPath())->resize(243, 398)->save($destinationPath_banner . $fileNamebanner);
              }
          }else{
              $fileNamebanner =$cate->banner;
          }
          if(Input::hasFile('imageslide1')){
               if (Input::file('imageslide1')->isValid()) {
                  $destinationPath_slide1 = 'img/product/banner/product-category/slider/'; // upload path
                  $extension = Input::file('imageslide1')->getClientOriginalExtension(); // getting image extension
                  $fileNameslide1 = rand(11111,99999).'.'.$extension; // renameing image
                  Image::make(Input::file('imageslide1')->getRealPath())->resize(560, 400)->save($destinationPath_slide1 . $fileNameslide1);
              }
          }else{
              $fileNameslide1 =$cate->slider1;
          }
          if(Input::hasFile('imageslide2')){
              if (Input::file('imageslide2')->isValid()) {
                  $destinationPath_slide2 = 'img/product/banner/product-category/slider/'; // upload path
                  $extension = Input::file('imageslide2')->getClientOriginalExtension(); // getting image extension
                  $fileNameslide2 = rand(11111,99999).'.'.$extension; // renameing image
                  Image::make(Input::file('imageslide2')->getRealPath())->resize(560, 400)->save($destinationPath_slide2 . $fileNameslide2);
              }
          }else{
              $fileNameslide2 =$cate->slider2;
          }
          if(Input::hasFile('imageslide3')){
              if (Input::file('imageslide3')->isValid()) {
                  $destinationPath_slide3 = 'img/product/banner/product-category/slider/'; // upload path
                  $extension = Input::file('imageslide3')->getClientOriginalExtension(); // getting image extension
                  $fileNameslide3 = rand(11111,99999).'.'.$extension; // renameing image
                  Image::make(Input::file('imageslide3')->getRealPath())->resize(560, 400)->save($destinationPath_slide3 . $fileNameslide3);
              }
          }else{
              $fileNameslide3 =$cate->slider3;
          }
          $q=DB::table('product_category')
          ->where('categoryid','=',$id)
          ->update([
              'categorytitle' => $title,
              'categoryname'  => $name,
              'parent'        => $parent,
              'color'         => $color,
              'icon'          => $fileNameicon,
              'banner'        => $fileNamebanner,
              'slider1'       => $fileNameslide1,
              'slider2'       => $fileNameslide2,
              'slider3'       => $fileNameslide3,
              'updated_at'    => $now
          ]);
          if($q){
              return redirect('admin/category')->with('success-update', 'Product category has updated');
          }else{

              return redirect()->back()->with('error-update', 'Something error')->withInput();

          }
      }else{
          return redirect('admin/login');
      }


  }
  public function getcategoryadd()
  {

      if(Session::get('sessionadmin')){
          $parent = DB::table('product_category')->get();
          return view('admin/category-add',[
              'parent' => $parent,
          ]);
      }else{
          return redirect('admin/login');
      }
  }
  public function getsubcategory(){

      if(Session::get('sessionadmin')){
          //Sub Category
          $scateg=DB::table('product_subcategory')
              ->leftJoin('product_category', 'product_subcategory.categoryid', '=', 'product_category.categoryid')
              ->get();
          return view('admin/subcategory',
          [
          'subcategory'=> $scateg,
          ]);
      }else{
          return redirect('admin/login');
      }
  }

  public function postcategoryadd()
  {
      if(Session::get('sessionadmin')){
          $now= new DateTime();
          $title=Input::get('title');
          $name=Input::get('name');
          $parent=Input::get('parent');
          $color=Input::get('color');
          $enab=Input::get('enable');
          if(isset($enab)){
              $enable=1;
          }else{
              $enable=0;
          }
          if (Input::file('imageicon')->isValid()) {
              $destinationPath_icon = 'img/icon-category/'; // upload path
              $extension = Input::file('imageicon')->getClientOriginalExtension(); // getting image extension
              $fileNameicon = rand(11111,99999).'.'.$extension; // renameing image
              Image::make(Input::file('imageicon')->getRealPath())->resize(70, 70)->save($destinationPath_icon . $fileNameicon);
          }
          if (Input::file('imagesbanner')->isValid()) {
              $destinationPath_banner = 'img/product/banner/product-category/'; // upload path
              $extension = Input::file('imagesbanner')->getClientOriginalExtension(); // getting image extension
              $fileNamebanner = rand(11111,99999).'.'.$extension; // renameing image
              Image::make(Input::file('imagesbanner')->getRealPath())->resize(243, 398)->save($destinationPath_banner . $fileNamebanner);
          }
          if (Input::file('imageslide1')->isValid()) {
              $destinationPath_slide1 = 'img/product/banner/product-category/slider/'; // upload path
              $extension = Input::file('imageslide1')->getClientOriginalExtension(); // getting image extension
              $fileNameslide1 = rand(11111,99999).'.'.$extension; // renameing image
              Image::make(Input::file('imageslide1')->getRealPath())->resize(560, 400)->save($destinationPath_slide1 . $fileNameslide1);
          }
          if (Input::file('imageslide2')->isValid()) {
              $destinationPath_slide2 = 'img/product/banner/product-category/slider/'; // upload path
              $extension = Input::file('imageslide2')->getClientOriginalExtension(); // getting image extension
              $fileNameslide2 = rand(11111,99999).'.'.$extension; // renameing image
              Image::make(Input::file('imageslide2')->getRealPath())->resize(560, 400)->save($destinationPath_slide2 . $fileNameslide2);
          }
          if (Input::file('imageslide3')->isValid()) {
              $destinationPath_slide3 = 'img/product/banner/product-category/slider/'; // upload path
              $extension = Input::file('imageslide3')->getClientOriginalExtension(); // getting image extension
              $fileNameslide3 = rand(11111,99999).'.'.$extension; // renameing image
              Image::make(Input::file('imageslide3')->getRealPath())->resize(560, 400)->save($destinationPath_slide3 . $fileNameslide3);
          }


          DB::table('product_category')->insert([
          'enable'        => $enable,
          'categorytitle' => $title,
          'categoryname'  => $name,
          'parent'        => $parent,
          'color'         => $color,
          'icon'          => $fileNameicon,
          'banner'        => $fileNamebanner,
          'slider1'       => $fileNameslide1,
          'slider2'       => $fileNameslide2,
          'slider3'       => $fileNameslide3,
          'created_at'    => $now,
          'updated_at'    => 'never'
          ]);
          return redirect('admin/category')->with('success-create', 'Success sumbit new category');
      }else{
          return redirect('admin/login');
      }


  }
   public function getsubcategorydelete($scateid){

      if(Session::get('sessionadmin')){
          $delete = DB::table('product_subcategory')->where('subcategoryid', '=', $scateid)->delete();
          if($delete){
              return Redirect()->back()->with('success-delete', 'Success deleting data');
          }
      }else{
          return redirect('admin/login');
      }

  }


  public function getsubcategoryadd(){

      if(Session::get('sessionadmin')){
          //Category
          $categ = DB::table('product_category')->get();
          return view('admin/subcategory-add',
          [
          'category'=> $categ,
          ]);

          return view('admin/subcategory-add');
      }else{
          return redirect('admin/login');
      }
  }
  public function postsubcategoryadd(){

      if(Session::get('sessionadmin')){

          $now= new DateTime();
          $cate=Input::get('category');
          $title=Input::get('title');
          $name=Input::get('name');
          $enab=Input::get('enable');
          if(isset($enab)){
              $enable=1;
          }else{
              $enable=0;
          }


          DB::table('product_subcategory')->insert([
          'enable' => $enable,
          'categoryid' => $cate,
          'subcategorytitle' => $title,
          'subcategoryname' => $name,
          'created_at' => $now,
          'updated_at' => 'never'
          ]
          );
          return redirect('admin/subcategory')->with('success-create', 'Success sumbit new Sub category');

      }else{
          return redirect('admin/login');
      }
  }
}
?>
