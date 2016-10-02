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
class AjaxController extends Controller {

	public function __construct()
	{
		$this->middleware('guest');
	}

    public function selectsubcategory(){
        $code=Input::get('code');
        $get=Input::get('category');
        if(!empty($code)){
            $product =DB::table('product')->where('code','=',$code)->first();


            $subcategory =DB::table('product_subcategory')->where('categoryid','=',$get)->get();

            $html='';
            $html .='';

                foreach($subcategory as $scate){

                    $explode=explode( ',', $product->subcategory );
                        $html .="<div class='checkbox' style='max-height: 200px;overflow: auto;'><label>";
                        $html .='<input type="checkbox" value="'.$scate->subcategoryid.'" name="subcate[]"';
                        if(in_array($scate->subcategoryid , $explode)){
                            $html .='checked';
                        }
                        $html .='>';
                        $html .= $scate->subcategorytitle;
                        $html .='</label></div>';


                }
                if(count($subcategory)==0){

                    $html .='<div id="please-select-category">&mdash; Please select category &mdash;</div>';
                }

            return $html;

        }else{

            $subcategory =DB::table('product_subcategory')->where('categoryid','=',$get)->get();

            $html='';
            $html .='';
                foreach($subcategory as $scate){
                    //$html .="<div id='"$get"' class='col-sm-6' style='max-height: 200px; overflow: auto;'>";
                    $html .="<div class='checkbox' style='max-height: 200px; overflow: auto;'><label>";
                    $html .='<input type="checkbox" value="'.$scate->subcategoryid.'" name="subcate[]">';
                    $html .= $scate->subcategorytitle;
                    $html .='</label></div>';
                }
                if(count($subcategory)==0){

                    $html .='<div id="please-select-category">&mdash; Please select category &mdash;</div>';
                }

            return $html;

        }
    }

	public function shippingprovince(){
    session_start();
    $key = '28d8b48767f82fa8b0c7e847ebadb8e4';
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://pro.rajaongkir.com/api/province",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 1000,
      CURLOPT_TIMEOUT => 1000,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: " . $key
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      # echo "cURL Error #:" . $err;
    } else {

        $data = json_decode($response, true);
        $i = 0;
        echo "<div class='row'>";
            echo "<div class='col-md-12'>";
                echo "<select class='form-control input-flat' name='province' id='province' onchange=\"get_city();\">";
                  echo "<option value='0'>Pilih Provinsi</option>";
                  foreach($data['rajaongkir']['results'] as $row){
                    $selected = "";
                    if(isset($_SESSION['data']['province']) && $_SESSION['data']['province'] == $row['province_id']){
                      $selected = "selected";
                    }
                    // if($row['province_id'] == 2){
                    //   $checked = "selected";
                    // }
                    echo "<option class=\"province_option\" data-name='" . $row['province'] . "'  value='" . $row['province_id'] . "'" . $selected . ">" . $row['province'] . "</option>";
                    $i++;
                  }
                echo "</select>";
            echo "</div>";
        echo "</div>";
        }
    }

	public function shippingcity(){
        session_start();
    $province = Input::get('province');
    $provincename = Input::get('provincename');
    //Membuat Sesi province
    Session::set('province',$province);
    Session::set('provincename',$provincename);

    //echo Session::get('province');
        $check = "";
        if(isset($province)){
          $province = $province;
          if(isset($_SESSION['data']['province']) && $_SESSION['data']['province'] != $province){
            $_SESSION['data']['city'] = "0";
            $check = "selected";
            if(isset($_SESSION['data']['ongkir'])){
              $_SESSION['data']['ongkir'] = 0;
            }
          }
          $_SESSION['data']['province'] = $province;
        }
        else if(!isset($_GET['province']) && isset($_SESSION['data']['province'])){
          $province = $_SESSION['data']['province'];
        }

        if(isset($province)){
          $key = '28d8b48767f82fa8b0c7e847ebadb8e4';
          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "http://pro.rajaongkir.com/api/city?province=" . $province,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 1000,
            CURLOPT_TIMEOUT => 1000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "key: " . $key
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
            # echo "cURL Error #:" . $err;
          } else {
            $data = json_decode($response, true);
            // var_dump($data);
            $i = 0;
            echo "<div class='row'>";

                echo "<div class='col-md-12'>";
                    echo "<select class='form-control input-flat' name='city' id='city' onchange=\"getSubDistrict();\">";
                        echo "<option value='0'".$check.">Pilih Kota</option>";
                        foreach($data['rajaongkir']['results'] as $row){
                          $selected = "";
                          if(isset($_SESSION['data']['city']) && $_SESSION['data']['city'] == $row['city_id']){
                            $selected = "selected";
                          }

                          echo "<option data-name='" . $row['type'] . " " . $row['city_name'] .  "' value='". $row['city_id'] .  "' name='province'". $selected .">" . $row['type'] . " " . $row['city_name']  . "</option>";
                        }
                    echo "</select>";
                echo "</div>";
            echo "</div>";
          }
        }
        else{
            echo "<div class='row'>";
                echo "<div class='col-md-12'>";
                  echo "<select class='form-control' name='city' id='city_input'>";
                  echo "<option value='0'>Pilih Kota</option>";
                  echo "</select>";
                echo "</div>";
            echo "</div>";
        }

    }

    public function shippingsubdistrict(){
        session_start();
    $getcity = Input::get('city');
    $cityname = Input::get('cityname');
    //Membuat Sesi province
    Session::set('city',$getcity);
    Session::set('cityname',$cityname);

    //echo $city;
    //exit();
    //echo Session::get('province');
        $check = "";
        if(isset($getcity)){
          $city = $getcity;
          if(isset($_SESSION['data']['city']) && $_SESSION['data']['city'] != $city){
            $_SESSION['data']['subdistrict'] = "0";
            $check = "selected";
            if(isset($_SESSION['data']['ongkir'])){
              $_SESSION['data']['ongkir'] = 0;
            }
          }
          $_SESSION['data']['city'] = $city;
        }
        else if(!isset($_GET['city']) && isset($_SESSION['data']['city'])){
          $province = $_SESSION['data']['city'];
        }

        if(isset($getcity)){
          $key = '28d8b48767f82fa8b0c7e847ebadb8e4';
          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "http://pro.rajaongkir.com/api/subdistrict?city=" . $getcity,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 1000,
            CURLOPT_TIMEOUT => 1000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "key: " . $key
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
            # echo "cURL Error #:" . $err;
          } else {
            $data = json_decode($response, true);
             //var_dump($data);
             //exit();
            $i = 0;
            echo "<div class='row'>";

                echo "<div class='col-md-12'>";
                    echo "<select class='form-control input-flat' name='subdistrict' id='subdistrict' onchange=\"get_cost();\">";
                        echo "<option value='0'".$check.">Pilih Kecamatan</option>";
                        foreach($data['rajaongkir']['results'] as $row){
                          $selected = "";
                          if(Session::get('city') && Session::get('getsubdistrict') == $row['subdistrict_id']){
                            $selected = "selected";
                          }

                          echo "<option data-name='" . $row['subdistrict_name'] .  "' value='". $row['subdistrict_id'] .  "' name='getcity'". $selected .">" . $row['subdistrict_name']  . "</option>";
                        }
                    echo "</select>";
                echo "</div>";
            echo "</div>";
          }
        }else{
            echo "<div class='row'>";
                echo "<div class='col-sm-7 col-sm-offset-5'>";
                  echo "<select class='form-control' name='subdistrict' id='subdistrict_input'>";
                  echo "<option value='0'>Pilih Kecamatan</option>";
                  echo "</select>";
                echo "</div>";
            echo "</div>";
        }

    }

	public function shippingcost(){
        session_start();
        $getsubdistrict= Input::get('subdistrict');
        $subdistrictname= Input::get('subdistrictname');
        $city= Input::get('city');
        $cityname= Input::get('cityname');
        //Membuat Sesi kota
        Session::set('city',$city);
        Session::set('cityname',$cityname);
        Session::set('getsubdistrict',$getsubdistrict);
        Session::set('subdistrictname',$subdistrictname);

        $origin = 54;
        if(isset($getsubdistrict)){
          $destination = $getsubdistrict;
        }
        else if(isset($_SESSION['data']['getsubdistrict'])){
          $destination = $_SESSION['data']['getsubdistrict'];
        }

        // if($destination != $_SESSION['data']['city']){
        //   $_SESSION['data']['ongkir'] = 0;
        // }

        if(isset($destination)){
          // $weight = $_GET['weight'];
          $weight = 0;
          if(!isset($_SESSION['cart']['product_weight'])){
            $weight = Input::get('weight');
          }
          else{
            foreach($_SESSION['cart'] as $row){
              $temp = $row['product_weight'] * $row['qty'];
              $weight = $weight + $temp;
            }
          }

          $_SESSION['data']['getsubdistrict'] = $destination;
          if($destination != 0){
            $key = '28d8b48767f82fa8b0c7e847ebadb8e4';

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://pro.rajaongkir.com/api/cost",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 1000,
              CURLOPT_TIMEOUT => 1000,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "origin=".$city."&originType=city&destination=".$destination."&destinationType=subdistrict&weight=".$weight."&courier=jne",
              CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . $key
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              # echo "cURL Error #:" . $err;
            } else {

              $data = json_decode($response, true);


              #foreach($data['rajaongkir']['results'][0]['costs'] as $row){
		    if(isset($data['rajaongkir']['results'][0]['costs'])){
                $row = $data['rajaongkir']['results'][0]['costs'];

                $i = 0;
                echo "<div class='row'>";
                    echo "<div class='col-sm-5 col-sm-offset-7'>";
                        while ($i < count($row) && $i < 3){
                          $check = "";
                          if(Session::get('ongkir') && Session::get('ongkir') == $row[$i]['cost'][0]['value']){
                            $check = "checked";
                          }
    echo "<label><input id='ongkir' type='radio' class='ongkir' name='ongkir' value='".$row[$i]['cost'][0]['value']."'
    onchange=\"set_ongkir(" . $row[$i]['cost'][0]['value'] . ",'JNE ".$row[$i]['service']."')\" ". $check ."/> JNE " . $row[$i]['service'] . " - Rp <span class=\"money\">"  . $row[$i]['cost'][0]['value'] . "</span></label> <br/>";
                          $i++;
                        }
                        
                    echo "</div>";
                echo "</div>";
                if($i == 0){
                    echo "<div class='row'>";
                        echo "<div class='col-sm-5 col-sm-offset-7'>";
                            echo "<div class=\"text-300 text-right\">Sorry there's no shipping method available.</div>";
                        echo "</div>";
                    echo "</div>";
                }
                echo "<div class='row'>";
                    echo "<div class='col-sm-5 col-sm-offset-7'>";
                        echo "<label><input id='ongkir' type='radio' class='ongkir' name='ongkir' onchange=\"set_ongkir('0,0')\" value='0'/><input id='byReq' type='text' placeholder='Others' style='height:30px; width:auto; margin-left:5px; padding-left:5px;' disabled>" . "</span></label> <br/>";
                    echo "</div>";
                echo "</div>";
					    }
					    else{
                            echo "<div class='row'>";
                                echo "<div class='col-sm-5 col-sm-offset-7'>";
						            echo "<div class=\"text-300 text-right\">Sorry there's no shipping method available.</div>";
                                echo "</div>";
                            echo "</div>";
					    }
                // echo $weight;
              #}
            }
          }
        }else{
            echo "<div class='row'>";
                echo "<div class='col-sm-5 col-sm-offset-7'>";
				    echo "<div class=\"text-300 text-right\">Sorry there's no shipping method available.</div>";
                echo "</div>";
            echo "</div>";
        }
    }



    public function shippingongkir(){

        session_start();
        $carttotal          = Cart::total();
        $province           = Input::get('province');
        $city               = Input::get('city');
        $subdistrict        = Input::get('subdistrict');
        $package            = Input::get('package');
        $paket              = Input::get('paket');
        $kurir              = Input::get('kurir');
        Session::set('kurir',$kurir);
        $ongkir             = Input::get('ongkir');

        //echo $carttotal;

        //Jika sudah ada kode Voucher
        if(Session::get('vouchercode')) {

            if(Session::get('vouchertype')==1){
                $count=Cart::total()/100*Session::get('vouchervalue');
                $hitung=Cart::total()-$count+$ongkir;

            }elseif(Session::get('vouchertype')==2){
                $hitung=Cart::total()-Session::get('vouchervalue')+$ongkir;
            }

            Session::set('ongkir',$ongkir);
            Session::set('shoppingpackage',$paket);
            Session::set('shoptotal',$hitung);
            //SET SESSION
            Session::set('province',$province);
            Session::set('city',$city);
            echo Session::get('shoptotal');

        }else{
        //Jika belum ada kode Voucher

            Session::set('package',$paket);
            Session::set('ongkir',$ongkir);

            $hitung = $carttotal + $ongkir;
            Session::set('shoptotal',$hitung);
            ////SET SESSION
            //Session::set('province',$province);
            //Session::set('city',$city);
            $to = Session::get('shoptotal');
            echo $to;
        }
    }





}
