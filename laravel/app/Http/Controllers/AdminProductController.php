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
class AdminProductController extends Controller {
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
  public function getproduct(){

      if(Session::get('sessionadmin')){
           //Product
         // $products= DB::table('product')->get();
          $products = DB::table('product')
              ->leftJoin('product_category', 'product.category', '=', 'product_category.categoryid')
              ->leftJoin('brands', 'product.brands', '=', 'brands.brandsid')
              ->get();
          if(count($products)>0){
              foreach($products as $prod){

                  $cat= DB::table('product_category')->where('categoryid','=',$prod->category)->get();


                  $products_img = DB::table('product_image')->where('productid', '=', $prod->productid)->orderBy('productimageid', 'Asc')->get();
                  $i = 0;
                  foreach($products_img as $img){
                      $i++;
                      if($i == '1'){
                          $image['image_small'][$prod->productid] = $img->image_small;
                          $image['image_thumb'][$prod->productid] = $img->image_thumb;
                          $image['image_large'][$prod->productid] = $img->image_large;
                      }
                  }
              }
          }else{
             $image=array();
             $cat=array();

          }
          //var_dump($products );
          //foreach($products as $prod){
          //    $categoryName = explode(",",$prod->category);
          //
          //    foreach($categoryName as $cn){
          //        //echo $cn;
          //
          //    }
          //}
          //
         //
          return view('admin/product',
          [
         'product'=> $products,
         'product_img'=> $image,
         'category'=> $cat
          ]);
      }else{
          return redirect('admin/login');
      }
  }


  public function getproductdetails($productid)
  {
      if(Session::get('sessionadmin')){
          $category = array();
          $prod= DB::table('product')->where('productid','=',$productid)->first();
          $prodDetails= DB::table('product_details')->where('product_id','=',$prod->productid)->get();
          $prodVariation= DB::table('product_variation')->where('product_id','=',$prod->productid)->get();
          $allcate = DB::table('product_category')->where('enable','=',1)->groupBy('categoryname')->get();
          $allbrands = DB::table('brands')->where('enable','=',1)->get();
          $img = DB::table('product_image')->where('productid','=',$prod->productid)->get();

          $expl_product_category = explode(",",$prod->category);
          //
          // $i = 0;
          // $j = 0;
          // $k = 0;
          // // dd($allcate );
          // foreach ($allcate as $key => $value) {
          //     if($allcate[$key]->parent == 0){
          //         //$allcate[$key]['parentstat'] = 1;
          //         array_push($category, $allcate[$key]);
          //
          //         foreach ($allcate as $key2 => $value2) {
          //             if($allcate[$key2]->parent == $allcate[$key]->categoryid){
          //                 array_push($category,$allcate[$key2]);
          //
          //                 foreach ($allcate as $key3 => $value3) {
          //                     if($allcate[$key3]->parent == $allcate[$key2]->categoryid){
          //                         array_push($category,$allcate[$key3]);
          //                     }
          //                 }
          //             }
          //         }
          //     }
          // }
          // dd($category );
            // foreach ($allcate as $key) {
          //     $cate[$key->$categoryid] = DB::table('product_category')->where('enable','=',1)->where('parent', $key->$categoryid)->get();
          // }
          //
          // for($i = 0;$i<sizeof($allcate);$i++){
          //     for($j = 0; $j<$i;$j++){
          //         if($allcate[$i][$j]->parent == 0){
          //              echo "silit";
          //         }
          //     }
          // }

          return view('admin/product-details',[
              'products'                =>$prod,
              'prodDetails'             =>$prodDetails,
              'prodVariation'           =>$prodVariation,
              'category'                =>$allcate,
              // 'allcategory'             =>$allcate,
              'expl_product_category'   =>$expl_product_category,
              'brands'                  =>$allbrands,
              'images'                  =>$img
          ]);
      }else{
          return redirect('admin/login');
      }

  }

  public function postproductdetails(){

      if(Session::get('sessionadmin')){
          $now= new DateTime();
          $productid=Input::get('productid');
          $cate=Input::get('category');
          $title=Input::get('title');
          $weight=Input::get('weight');
          $length=Input::get('length');
          $width=Input::get('width');
          $height=Input::get('height');
          $volume=Input::get('volume');
          $name=Input::get('name');
          $brands=Input::get('brands');
          $stock=Input::get('stock');
          $price=Input::get('price');
          $detail_title=Input::get('detail_title');
          $detail_value=Input::get('detail_value');

          // echo $name;
          // var_dump($detail_title);
          // exit();
          //

          $productinformation=Input::get('productinformation');
          $productdescription=Input::get('productdescription');
          $productspecification=Input::get('productspecification');

          if($cate == 0 || $cate == NULL){
              return redirect()->back()->with('success-create', 'Please Choose Your Product Category');
          }else{
              //Checkbox array implode
              $imp_cate=implode(',',$cate);
          }

          $enab=Input::get('enable');

          if(isset($enab)){
              $enable=1;
          }else{
              $enable=0;
          }

          $featured=Input::get('$featured');

          if(isset($featured)){
              $feat=1;
          }else{
              $feat=0;
          }

          // echo $feat;
          // exit();
           //Filename
          if(Input::hasFile('image')){

              //Path
              $destinationPath_small = 'img/product/small/'; // upload path
              $destinationPath_thumb = 'img/product/thumb/'; // upload path
              $destinationPath_large = 'img/product/large/'; // upload path

                  foreach(Input::file('image') as $file){
                      $extension = $file->getClientOriginalName(); // getting image extension
                      $filetype = explode('.', $extension);
                      $fileName = rand(11111,99999).'.'.$filetype[1]; // rename image

                      //echo $fileName;
                      //exit();

                      //Rezize
                      Image::make($file->getRealPath())->resize(411, null, function ($constraint) { $constraint->aspectRatio();})->save($destinationPath_small . $fileName);
                      Image::make($file->getRealPath())->resize(100, null, function ($constraint) { $constraint->aspectRatio();})->save($destinationPath_thumb . $fileName);
                      Image::make($file->getRealPath())->resize(1280, null, function ($constraint) { $constraint->aspectRatio();})->save($destinationPath_large . $fileName);

                      //Insert Table Product Image
                      $p=DB::table('product')->where('productname','=',$name)->first();
                      $q=DB::table('product_image')
                      ->where('productid','=',$productid)
                      ->insert([
                          'image_small' => $fileName,
                          'image_thumb' => $fileName,
                          'image_large' => $fileName,
                          'productid'   => $productid
                       ]);
                  }
              }

          $q = DB::table('product')
              ->where('productid', $productid)
              ->update([
                  'enable'                => $enable,
                  'featured_status'       => $feat,
                  'category'              => $imp_cate,
                  'brands'                => $brands,
                  'producttitle'          => $title,
                  'productname'           => $name,
                  'productinformation'    => $productinformation,
                  'productdescription'    => $productdescription,
                  'productspecification'  => $productspecification,
                  'stock'                 => $stock,
                  'weight'                => $weight,
                  'length'                => $length,
                  'width'                 => $width,
                  'height'                => $height,
                  'volume'                => $volume
              ]);

              if($detail_title != NULL){
                  if($detail_title != ''){
                      //Insert Table PRODUCT DETAILS
                      foreach($detail_title as $per_title => $var1){
                          $r=DB::table('product')->where('productname','=',$name)->first();
                          DB::table('product_details')->insert([
                              'product_id' => $r->productid,
                              'product_code' => $r->code,
                              'title'     => $detail_title[$per_title],
                              'value'     => $detail_value[$per_title]
                          ]);
                      }
                  }
              }

          // return redirect('admin/product')->with('success-update', 'Success update product');
          return redirect()->back()->with('success-update', 'Success update product');
      }else{
          return redirect('admin/login');
      }
  }

  public function getproductdelete($code){

      if(Session::get('sessionadmin')){
          $deleteproduct = DB::table('product')->where('id', '=', $id)->delete();
          if($deleteproduct){
              return Redirect()->back()->with('success-delete', 'Success deleting data');
          }
      }else{
          return redirect('admin/login');
      }
  }

  public function getproductimgdelete($imgid){

      if(Session::get('sessionadmin')){
          $delete = DB::table('product_image')->where('productimageid', '=', $imgid)->delete();
          if($delete){
              return Redirect()->back()->with('success-delete', 'Success deleting data');
          }
      }else{
          return redirect('admin/login');
      }
  }

  public function getproductadd(){

      if(Session::get('sessionadmin')){

          $cate = DB::table('product_category')->where('enable','=',1)->get();
          $brands = DB::table('brands')->get();

          //var_dump($cate);
          //exit();
          return view('admin/product-add',[
              'category'=>$cate,
              'brands'=>$brands
              ]);

      }else{
          return redirect('admin/login');
      }
  }


  public function postproductadd(){

      if(Session::get('sessionadmin')){
          $var_status=Input::get('var-status');
          $now= new DateTime();
          $code=Input::get('code');
          $cate=Input::get('category');
          $title=Input::get('title');
          $name=Input::get('name');
          $brands=Input::get('brands');
          $stock=Input::get('stock');
          $weight=Input::get('weight');
          $length=Input::get('length');
          $width=Input::get('width');
          $height=Input::get('height');
          $volume=Input::get('volume');
          $price=Input::get('price');
          $detail_title=Input::get('detail_title');
          $detail_value=Input::get('detail_value');
          $productinformation=Input::get('productinformation');
          $productdescription=Input::get('productdescription');
          $productspecification=Input::get('productspecification');


          if($cate == 0 || $cate == NULL){
              return redirect()->back()->with('success-create', 'Please Choose Your Product Category');
          }else{
              //Checkbox array implode
              $imp_cate=implode(',',$cate);
          }

          $enab=Input::get('enable');
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

          // echo $feat;
          // exit();
          //var_dump($imp_cate);

           // checking file is valid.
          if (Input::hasFile('image')) {

              //Path
              $destinationPath_small = 'img/product/small/'; // upload path
              $destinationPath_thumb = 'img/product/thumb/'; // upload path
              $destinationPath_large = 'img/product/large/'; // upload path

              //Insert Table product
              $q = DB::table('product')->insert([
              'code'                  => $code,
              'category'              => $imp_cate,
              'producttitle'          => $title,
              'productname'           => $name,
              'brands'                => $brands,
              'stock'                 => $stock,
              'price'                 => $price,
              'enable'                => $enable,
              'featured_status'       => $feat,
              'weight'                => $weight,
              'length'                => $length,
              'width'                 => $width,
              'height'                => $height,
              'volume'                => $volume,
              'productinformation'    => $productinformation,
              'productdescription'    => $productdescription,
              'productspecification'  => $productspecification
              ]);

              if($q){
                  //Insert Table PRODUCT DETAILS
                  foreach($detail_title as $per_title => $var1){
                      $r=DB::table('product')->where('productname','=',$name)->first();
                      DB::table('product_details')->insert([
                          'product_id' => $r->productid,
                          'product_code' => $r->code,
                          'title'     => $detail_title[$per_title],
                          'value'     => $detail_value[$per_title]
                      ]);
                  }
              }
              //Filename
              if(Input::hasFile('image')){
                  foreach(Input::file('image') as $file){
                      $extension = $file->getClientOriginalName(); // getting image extension
                      $filetype = explode('.', $extension);
                      $fileName = rand(11111,99999).'.'.$filetype[1]; // rename image
                      //Rezize
                      Image::make($file->getRealPath())->resize(411, null, function ($constraint) { $constraint->aspectRatio();})->save($destinationPath_small . $fileName);
                      Image::make($file->getRealPath())->resize(100, null, function ($constraint) { $constraint->aspectRatio();})->save($destinationPath_thumb . $fileName);
                      Image::make($file->getRealPath())->resize(1280, null, function ($constraint) { $constraint->aspectRatio();})->save($destinationPath_large . $fileName);

                      //Insert Table Product Image
                      $p=DB::table('product')->where('productname','=',$name)->first();
                      $q=DB::table('product_image')->insert([
                          'productcode' => $p->code,
                          'image_small' => $fileName,
                          'image_thumb' => $fileName,
                          'image_large' => $fileName
                       ]);
                  }
              }

              if($var_status == 1){
                  $prod_info = DB::table('product')->where('producttitle','=', $title)->first();
                  return redirect('admin/product/add/variation/'.$prod_info->productid);
              }else{
                  return redirect('admin/product')->with('alert', 'Success add product');
              }
          } else {
              return redirect()->back()->with('alert', 'Please insert your Product Image');
          }

      }else{
          return redirect('admin/login');
      }
  }


  public function getproductvariationadd($productid){

      if(Session::get('sessionadmin')){
          $product_info = DB::table('product')->where('productid','=', $productid)->first();
          $product_variation_info = DB::table('product_variation')->where('product_id','=', $productid)->get();
          $img = DB::table('product_image')->where('productid','=',$product_info->productid)->get();
          //var_dump($product_variation_info);
          //exit();
          return view('admin/product-variation-add',[
              'product_info'            => $product_info,
              'product_variation_info'  => $product_variation_info
          ]);
      }else{
          return redirect('admin/login');
      }
  }
  public function getproductvariationdetails($variantid){

      if(Session::get('sessionadmin')){
          $product_var_info= DB::table('product_variation')->where('var_id','=', $variantid)->first();
          $product_var_details= DB::table('product_variation_details')->where('var_id','=', $variantid)->get();
          $product_info = DB::table('product')->where('productid','=', $product_var_info->product_id)->first();

          return view('admin/product-variation-details',[
              'product_var_info' => $product_var_info,
              'product_var_details' => $product_var_details,
              'product_info' => $product_info,

          ]);
      }else{
          return redirect('admin/login');
      }
  }


  public function postproductvariationdetails($variantid){

      if(Session::get('sessionadmin')){
          $producttitle=Input::get('producttitle');
          $code=Input::get('var_code');
          $name=Input::get('var_name');
          $stock=Input::get('var_stock');
          $price=Input::get('var_price');
          $var_detail_title =Input::get('var_det_title');
          $var_detail_value=Input::get('var_det_value');
          //var_dump($var_detail_title);
          //exit();
          $product = DB::table('product')->where('producttitle','=',$producttitle)->first();
          //var_dump($product_name2);
          //Insert Table product variation
          $q = DB::table('product_variation')->where('var_id','=',$variantid)->update([
              'var_code'          => $code,
              //'subcategory'     => " ",
              'var_name'          => $name,
              'var_stock'          => $stock,
              'var_price'         => $price,
          ]);


          if(isset($var_detail_title)){
              if(!empty(array_filter($var_detail_title))){
                    //Insert Table PRODUCT VARIATION DETAILS
                      foreach($var_detail_title as $per_title => $var1){
                          //$r=DB::table('product_variation_details')->where('var_id','=',$variantid)->get();
                          //var_dump($product);
                          //if($r == NULL){
                              DB::table('product_variation_details')->insert([
                                  'var_id'            => $variantid,
                                  'var_det_title'     => $var_detail_title[$per_title],
                                  'var_det_value'     => $var_detail_value[$per_title]
                              ]);
                          //}else{
                          //    DB::table('product_variation_details')->where('var_id','=',$variantid)->update([
                          //        'var_det_title'     => $var_detail_title[$per_title],
                          //        'var_det_value'     => $var_detail_value[$per_title]
                          //    ]);
                          //}
                      }
              }
          }
          return redirect()->back()->with('success-create', 'Success add product variation');
      }else{
          return redirect('admin/login');
      }
  }
  public function postproductvariationadd(){

      if(Session::get('sessionadmin')){
          $producttitle=Input::get('producttitle');
          $code=Input::get('var_code');
          $name=Input::get('var_name');
          $stock=Input::get('var_stock');
          $price=Input::get('var_price');
          $detail_title=Input::get('var_det_title');
          $detail_value=Input::get('var_det_value');

          $product = DB::table('product')->where('producttitle','=',$producttitle)->first();
          //var_dump($product);
          //Insert Table product variation
          $q = DB::table('product_variation')->where('product_id','=',$product->productid)->insert([
              'var_code'          => $code,
              'product_id'        => $product->productid,
              //'subcategory'     => " ",
              'var_name'          => $name,
              'var_stock'         => $stock,
              'var_price'         => $price,
          ]);

          if(isset($detail_title)){
            if(!empty(array_filter($detail_title))){
                //Insert Table PRODUCT VARIATION DETAILS
                foreach($detail_title as $per_title => $var1){
                        $r=DB::table('product_variation')->where('var_code','=',$code)->first();
                        DB::table('product_variation_details')->insert([
                            'var_id'            => $r->var_id,
                            'var_det_title'     => $detail_title[$per_title],
                            'var_det_value'     => $detail_value[$per_title]
                        ]);
                }
            }
          }
          return redirect('admin/product')->with('success-create', 'Success add product variation');
      }else{
          return redirect('admin/login');
      }
  }

  public function getvariationdelete($id){
      if(Session::get('sessionadmin')){
          $deletevariation = DB::table('product_variation')->where('var_id', '=', $id)->delete();
          $deletevariationDetail = DB::table('product_variation_details')->where('var_id', '=', $id)->delete();
          if($deletevariation){
              return Redirect()->back()->with('success-delete', 'Success deleting Product Variant');
          }
      }else{
          return redirect('admin/login');
      }
  }

  public function getVariationDetailsDelete($id){
      if(Session::get('sessionadmin')){
          $deletevariationDetail = DB::table('product_variation_details')->where('var_det_id', '=', $id)->delete();
          if($deletevariationDetail){
              return Redirect()->back()->with('success-delete', 'Success deleting Product Variant');
          }
      }else{
          return redirect('admin/login');
      }
  }


  /*========================================================*/
  /*********************   AJAX FUNCTION  *******************/
  /*========================================================*/
  public function getCategorySearch(){
      $searchCategory = Input::get('searchCategory');
      $productid = Input::get('productid');

      $prod = DB::table('product')->where('productid','=',$productid)->first();
      $expl_product_category = explode(",",$prod->category);

      $searchResult = DB::table('product_category')->where('categorytitle','LIKE', '%'.$searchCategory.'%')->get();

      foreach($searchResult as $categ){
          if ($categ->parent == '0'){
              echo'<label class="col-sm-12 css-label"><input id="category" type="checkbox" value="'. $categ->categoryid.'" name="category[]"';
                echo '><strong><span>'. $categ->categorytitle .'</span></strong></label>';

              foreach($searchResult as $cate){
                  if ($cate->parent == $categ->categoryid){
                      echo '<label class="col-sm-12 css-label" style="padding-left: 10%;"><input id="category" type="checkbox" value="'. $cate->categoryid .'" name="category[]"';
                      echo '><span>'.$cate->categorytitle.'</span></label>';

                      foreach($searchResult as $subcate){
                          if ($subcate->parent == $cate->categoryid){
                                echo '<label class="col-sm-12 css-label"style="padding-left: 20%;"><input id="category" type="checkbox" value="'. $subcate->categoryid .'" name="category[]"';
                                echo '><span>'. $subcate->categorytitle.'</span></label>';
                          }
                      }
                  }
              }
          }
      }
  }
  public function getEditProductDetails(){
      $id = Input::get('id');
      $data = DB::table('product_details')->where('id', '=', $id)->first();

      echo '<table class="table table-hover table-bordered">
          <tbody>
              <tr>
                  <th>Title</th>
                  <th>Value</th>
              </tr>
          </tbody>
          <tbody id="items">
              <tr>
                  <td>
                      <input type="text" class="form-control" placeholder="Title" name="edited_detail_title" value="'.$data->title.'">
                  </td>
                  <td>
                      <input type="text" class="form-control" placeholder="Value" name="edited_detail_value" value="'.$data->value.'">
                  </td>
              </tr>
          </tbody>
      </table>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal" onclick="postEditedProductDetails('.$data->id.')">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>';
  }

  public function postEditProductDetails(){
      $id = Input::get('id');
      $title = Input::get('edited_detail_title');
      $value = Input::get('edited_detail_value');
      DB::table('product_details')->where('id', '=', $id)->update([
        'title' => $title,
        'value' => $value
      ]);

  }

  public function deleteProductDetails(){
      $id = Input::get('id');
      DB::table('product_details')->where('id', '=', $id)->delete();
  }

  public function updateFeaturedStatus($id){
      $fStat = DB::table('product')->where('productid', '=', $id)->first();
      if($fStat->featured_status == 1){
          DB::table('product')->where('productid', '=', $id)->update([
            'featured_status' => 0
          ]);
      }else{
          DB::table('product')->where('productid', '=', $id)->update([
            'featured_status' => 1
          ]);
      }
  }
}
?>
