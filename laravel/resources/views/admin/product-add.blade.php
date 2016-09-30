@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Product 
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Product </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <!--<h3 class="box-title">Data Table With Full Features</h3>-->
                </div><!-- /.box-header -->
                 
                @if(Session::has('alert'))                    
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>	<i class="icon fa fa-close"></i> Alert!</h4>
                        {{ Session::get('alert') }}
                    </div>
                @endif
                <form class="productInfo form-horizontal" action="{{ url('admin/product/add') }}" method="post" enctype="multipart/form-data">               
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" id="code" value="">
                <div class="box-body">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Category</label>
                            <div class="col-sm-9">
                                <div class="col-sm-9" id="category" style="width: 100%; max-height: 400px;overflow: auto; display: block">
                                    <!--NESTED FOREACH-->
                                    @foreach($category as $categ)
                                        @if ($categ->parent == '0')
                                        <div class="checkbox" >
                                            <label><input type="checkbox" value="{{ $categ->categoryid }}" name="category[]"><strong>{{ $categ->categorytitle }}</strong></label>
                                        </div>
                                            @foreach($category as $cate)
                                                @if ($cate->parent == $categ->categoryid)
                                                <div class="checkbox" style="padding-left: 10%;">
                                                    <label><input type="checkbox" value="{{ $cate->categoryid }}" name="category[]">{{ $cate->categorytitle }}</label>
                                                </div>
                                                    @foreach($category as $subcate)
                                                        @if ($subcate->parent == $cate->categoryid)
                                                        <div class="checkbox" style="padding-left: 20%;">
                                                            <label><input type="checkbox" value="{{ $subcate->categoryid }}" name="category[]">{{ $subcate->categorytitle }}</label>
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Product Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Product Code" name="code" required>
                            </div>
                        </div>      
                        <div class="form-group">
                            <label for="" class="col-sm-3 text-left">Product Title</label>
                            <div class="col-sm-9">
                                <input id="addtitle" type="text" class="form-control" placeholder="Product Title" name="title" required>
                            </div>
                        </div>                      
                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Product Name</label>
                            <div class="col-sm-9">
                                <input id="addname" type="text" class="form-control" placeholder="Product Name" name="name" readonly required>
                            </div>
                        </div>              
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Brands</label>
                            <div class="col-sm-9">
                                <select name="brands" class="form-control">
                                    <option value="0">-- Choose Brands --</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->brandsid }}">{{ $brand->name }}</option>    
                                    @endforeach    
                                </select>
                            </div>
                        </div>                                  
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Stock</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" min="0" placeholder="Stock" name="stock" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Weight</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Weight" name="weight" required><span class="input-group-addon">gram</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Dimension</label>
                            <div class="col-sm-9">
                                <table id="dimensionTable" class="table table-hover table-bordered" style="margin-bottom: 0;">
                                    <tbody>
                                        <tr style="background-color: #eee">
                                            <th>Length</th>
                                            <th>Width</th>
                                            <th>Height</th>
                                        </tr>
                                    </tbody>
                                    <tbody id="dimensionVal">
                                        <tr>
                                            <td>
                                                <input id="lengthVal" type="text" class="form-control" placeholder="Length" name="length">
                                            </td>
                                            <td>
                                                <input id="widthVal" type="text" class="form-control" placeholder="Width" name="width">
                                            </td>
                                            <td>
                                                <input id="heightVal" type="text" class="form-control" placeholder="Height" name="height">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 text-left">Volume</label>
                            <div class="col-sm-9">
                                <input id="volumeVal" type="text" class="form-control" placeholder=Volume name="volume" readonly>
                            </div>
                        </div>                                                      
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Price (Rp)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Price" name="price" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Image</label>
                            <div  class="col-sm-9">
                                <span id="file">
                                    <input type='file' name='image[]' class='form-control'>
                                </span>
                                   <p class="help-block"> <button id="uploadadd" type="button" class="btn btn-default btn-sm"><i class="icon ion-ios-plus-empty"></i> Add Image</button></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Public</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="enable" checked="1"> Enable
                            </div>
                        </div>

                      </div><!--./row-->
                             
                      <div class="checkbox">
                        <label>
                        </label>
                      </div>
                    </div><!--./Col-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 text-left">Add Variation *</label>
                            <div class="col-sm-8">
                                 <span class="col-sm-3 text-left"><input type="radio" class="var-status" name="var-status" value="1"> <strong>Yes</strong></span>
                                 <span class="col-sm-3 text-left"><input type="radio" class="var-status" name="var-status" value="0"> <strong>No</strong></span>
                                <label id="var-warning" style="color: #f00; font-size: 8pt" hidden>
                                    **PLEASE FILL THIS FORM**
                                </label>
                            </div>
                        </div>
                        <a onclick="additem()" class="btn btn-success" style="text-decoration: none; cursor: pointer; float:right; margin-bottom:2%"> + add detail</a>
                        <div class="form-group">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <label for="inputEmail3" class="col-sm-3 text-left">Product Details</label>
                            <div class="col-sm-12">
                                <table id="myTable" class="table table-hover table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Title</th>
                                            <th>Value</th>
                                            <th style="text-align: center;">Remove</th>
                                        </tr>
                                    </tbody>
                                    <tbody id="items">
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Title" name="detail_title[]">
                                            </td>
                                            <!--<td style="width: 13%;">
                                                <select id="variant_option" name="variant_option[]" class="form-control" >
                                                    <option>Option</option>
                                                    <option value="size">Size</option>
                                                    <option value="color">Color</option>
                                                </select>
                                            </td>-->
                                            <td>
                                                <input type="text" class="form-control" placeholder="Value" name="detail_value[]">
                                            </td>
                                            <!--<td class="col-sm-2">
                                                <div class="input-group colorpicker">
                                                    <input id="colorPicker" type="text" class="form-control" name="colorCode[]" disabled>
                                                    <div class="input-group-addon"><i></i></div>
                                                </div>
                                            </td>-->
                                            <!--<td>
                                                <input type="text" class="form-control" placeholder="Price" name="price[]">
                                            </td>-->
                                            <!--<td class="col-sm-4">
                                                <input type="color" class="form-control" name="price[]">
                                            </td>-->
                                            <!--<td>
                                                <input type="text" class="form-control" name="sale[]">
                                            </td>                                           
                                            <td>
                                                <input type="text" class="form-control" name="stock[]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="weight[]">
                                            </td>-->
                                            <!--<td>
                                                <form id="form1" runat="server"
                                                    <input type='file' name='image2[]' class='form-control' id="inputFile" />
                                                    <img id="image_upload_preview" src="http://placehold.it/100x100" alt="your image" />
                                                </form>
                                            </td>-->
                                            <td style="text-align: center;">
                                                <a onclick="deleteItem(this)" id="deleteRow" class="btn btn-danger">X</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#menu1">Product Information</a></li>
                            <li><a data-toggle="tab" href="#menu2">Product Description</a></li>
                            <li><a data-toggle="tab" href="#menu3">Product Specification</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="menu1" class="tab-pane fade active in">
                                <div class="form-group" style="margin-top: 20px; padding: 2px 15px;">
                                    <textarea class="form-group texteditor" name="productinformation" style="width: 20px;"></textarea>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div class="form-group" style="margin-top: 20px; padding: 2px 15px;">
                                    <textarea class="form-group texteditor" name="productdescription"></textarea>
                                </div>
                            </div>
                            <div id="menu3" class="tab-pane fade">
                                <div class="form-group" style="margin-top: 20px; padding: 2px 15px;">
                                    <textarea class="form-group texteditor" name="productspecification"></textarea>
                                </div>
                            </div>
                        </div>
                    </div><!--./Col--> 
                   

                </div><!-- /.box-body -->
               
                </form>
                   <div class="box-footer">
                    <div class="col-md-12">
                        <button id="submit-product" class="btn btn-primary" onclick="productSubmit()" >Submit</button>
                        <a href="{{ url('admin/product') }}"class="btn btn-default">Back</a>
                    </div>
                </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!--DELETE ROW FUNCTION-->
<script type="text/javascript">

    function productSubmit() {
        var varStatus = $('input[name="var-status"]:checked').val();
        if (varStatus == null || varStatus == undefined) {
            $('#var-warning').show();
        } else {
            //$.post("admin/product/add", function (data) {
            //    $(this).html(data);
            //});

            $('.productInfo').submit();
            //$.ajax({
            //type: "POST",
            //url: "admin/product/add"
            //});
        }
    };

    function deleteItem(r) {

        //deleting item
        var b = r.parentNode.parentNode.rowIndex;
        if (document.getElementById("myTable") != "#items") {
            document.getElementById("myTable").deleteRow(b);
            //alert(document.getElementById("myTable"));
        } else {
            alert("This is last column");
        }
    }
</script>

<!--APPEND ROW FUNCTION-->
<script type="text/javascript">
    function additem() {
        $('#items').append('<tr><td><input type="text" class="form-control" placeholder="Title" name="detail_title[]"></td><td><input type="text" class="form-control" placeholder="Value" name="detail_value[]"></td><td style="text-align: center;"><a onclick="deleteItem(this)" class="btn btn-danger">X</a></td></tr>');
        }
</script>


@endsection
