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
class AjaxAdminProductVariation extends Controller {

	public function __construct()
	{
		$this->middleware('guest');
	}

    public function postProductVariation(){
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
          $q = DB::table('product_variation')->insert([
              'var_code'          => $code,
              'product_id'        => $product->productid,
              //'subcategory'     => " ",
              'var_name'          => $name,
              'var_stock'         => $stock,
              'var_price'         => $price,
          ]);

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

    public function editVariation(){
        $id = Input::get('id');
        $editVar = DB::table('product_variation')->where('var_id','=',$id)->first();
        $product_info = DB::table('product')->where('productid','=',$editVar -> product_id)->first();
        $edit_product_var_details= DB::table('product_variation_details')->where('var_id','=', $id)->get();

       echo '<form id="editVariationForm" class="form-horizontal" enctype="multipart/form-data">'.
                '<input id="token" type="hidden" name="_token" value="'.csrf_token().'">
                <input type="hidden" name="producttitle" value="'.$product_info->producttitle.'">
                <input type="hidden" name="variantid" value="'.$editVar->var_id.'">
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="row">
                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Variation Code</label>
                            <div class="col-sm-9">
                                <input id="var_code" type="text" class="form-control" placeholder="Product Code" name="var_code" value="'.$editVar->var_code.'" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Variation Name</label>
                            <div class="col-sm-9">
                                <input id="var_name" type="text" class="form-control" placeholder="Product Name" name="var_name" value="'.$editVar->var_code.'">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Stock</label>
                            <div class="col-sm-9">
                                <input id="var_name" type="number" class="form-control" placeholder="Stock" name="var_stock" value="'.$editVar->var_stock.'">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Price (Rp)</label>
                            <div class="col-sm-9">
                                <input id="var_name" type="text" class="form-control" placeholder="Price" name="var_price" value="'.$editVar->var_price.'">
                            </div>
                        </div>
                        </div><!--./row-->
                    </div><!--./Col-->

                    <div class="col-md-12">
                        <a onclick="additem()" class="btn btn-success" style="text-decoration: none; cursor: pointer; float:right; margin-bottom:2%"> + add detail</a>
                        <div class="form-group">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                        <label for="inputEmail3" class="col-sm-3 text-left">Variation Details</label>
                            <div class="col-sm-12">
                                <table id="myTable" class="table table-hover table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Title</th>
                                            <th>Value</th>
                                            <th style="text-align: center;">Remove</th>
                                        </tr>
                                    </tbody>
                                    <tbody id="items">';
                                    if($edit_product_var_details != NULL || $edit_product_var_details != ''){
                                        foreach($edit_product_var_details as $pvd){
                                            echo '<tr>
                                                <td>
                                                    <input type="text" class="form-control" placeholder="Title" name="var_det_title[]" value="'.$pvd->var_det_title.'">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" placeholder="Value" name="var_det_value[]" value="'.$pvd->var_det_value.'">
                                                </td>
                                                <td style="text-align: center;">
                                                    <a type="button" onclick="deleteItem(this)" id="deleteRow" class="btn btn-sm btn-danger"><i class="icon ion-android-close"></i></a>
                                                </td>
                                            </tr>';
                                        }
                                    }
                                    echo '</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                    <div class="box-footer">
                    <div class="col-md-12" style="text-align: right">
                        <button type="button" class="btn btn-primary" onclick="postEditVariant()">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>';
    }

    //public function postEditVariation(){
    //    $variantid=Input::get('variantid');
    //    $producttitle=Input::get('producttitle');
    //    $code=Input::get('var_code');
    //    $name=Input::get('var_name');
    //    $stock=Input::get('var_stock');
    //    $price=Input::get('var_price');
    //    $detail_title=Input::get('var_det_title');
    //    $detail_value=Input::get('var_det_value');

    //    $product = DB::table('product')->where('producttitle','=',$producttitle)->first();
    //    //var_dump($product_name2);
    //    //Insert Table product variation
    //    $q = DB::table('product_variation')->where('var_id','=',$variantid)->update([
    //        'var_code'          => $code,
    //        //'subcategory'     => " ",
    //        'var_name'          => $name,
    //        'var_stock'          => $stock,
    //        'var_price'         => $price,
    //    ]);
    //        //Insert Table PRODUCT VARIATION DETAILS
    //        foreach($detail_title as $per_title => $var1){
    //            $r=DB::table('product_variation_details')->where('var_id','=',$variantid)->get();
    //            if($r == NULL){
    //                DB::table('product_variation_details')->insert([
    //                    'var_id'            => $variantid,
    //                    'var_det_title'     => $detail_title[$per_title],
    //                    'var_det_value'     => $detail_value[$per_title]
    //                ]);
    //            }else{
    //                DB::table('product_variation_details')->where('var_id','=',$variantid)->update([
    //                    'var_det_title'     => $detail_title[$per_title],
    //                    'var_det_value'     => $detail_value[$per_title]
    //                ]);
    //            }
    //        }
    //}


    public function editVariationDetails(){
        $id = Input::get('id');
        $edit_product_var_details= DB::table('product_variation_details')->where('var_det_id','=', $id)->first();

       echo '<form id="editVariantDetail" class="form-horizontal" enctype="multipart/form-data">'.
                '<input id="token" type="hidden" name="_token" value="'.csrf_token().'">
                <input type="hidden" id="variantDetailId" name="variantDetailId" value="'.$edit_product_var_details->var_det_id.'">
                    <table id="myTable" class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th>Title</th>
                                <th>Value</th>
                            </tr>
                        </tbody>
                        <tbody id="items">
                            <tr>
                                <td>
                                    <input type="text" class="form-control" placeholder="Title" id="detail_tittle" name="detail_tittle" value="'.$edit_product_var_details->var_det_title.'">
                                </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Value" id="detil_value" name="detil_value" value="'.$edit_product_var_details->var_det_value.'">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary" onclick="postEditVariant()">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>';
    }

    public function postEditVariationDetails(){
        $id             = Input::get('variantDetailId');
        $detail_tittle  = Input::get('detail_tittle');
        $detil_value    = Input::get('detil_value');

        DB::table('product_variation_details')->where('var_det_id','=',$id)->update([
            'var_det_title'     => $detail_tittle,
            'var_det_value'     => $detil_value
        ]);
    }
}
