@extends('admin/app')
@section('content')
<style>
    .box.box-solid.box-default>.box-header{
      color: #fff;
      background: #1DB7EB !important;
      background-color:#1DB7EB !important;
    }

    .box.box-solid.box-default>.box-header a, .box.box-solid.box-default>.box-header .btn {
        color: #fff !important;
    }
</style>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Product View
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Product View</li>
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
                @if(Session::has('success-delete'))
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>    <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-delete') }}
                    </div>
                @endif
                @if(Session::has('success-create'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>	<i class="icon fa fa-close"></i> Alert!</h4>
                        {{ Session::get('success-create') }}
                    </div>
                  @endif
                <form class="form-horizontal" action="{{ url('admin/product/view/') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" id="token" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="productid" id="productid" value="{{ $products->productid }}">
                <div class="box-body">
                    <div class="col-md-6">
                      <div class="row">


                        <div class="form-group" id="categoryMenu">
                            <label for="inputEmail3" class="col-sm-3 text-left">Category</label>
                            <div class="col-sm-9">
                                <!-- <div class="input-group"style="padding: 12px 0px;">
                                    <input type="text" class="form-control searchCategory" placeholder="Search Category" aria-describedby="basic-addon2" onkeyup="startSearch()">
                                    <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
                                </div> -->
                                <div class="col-sm-12" id="categoryList" style="width: 100%; max-height: 400px;overflow: auto;">
                                    @foreach($category as $categ)
                                        @if ($categ->parent == '0')
                                            <label class="col-sm-12 css-label"><input id="category" type="checkbox" value="{{ $categ->categoryid }}" name="category[]" <?php if(in_array($categ->categoryid, $expl_product_category)){ echo "checked";} ?>><strong><span>{{ $categ->categorytitle }}</span></strong></label>


                                            @foreach($category as $cate)
                                                @if ($cate->parent == $categ->categoryid)
                                                    <label class="col-sm-12 css-label" style="padding-left: 10%;"><input id="category" type="checkbox" value="{{ $cate->categoryid }}" name="category[]"<?php if(in_array($cate->categoryid, $expl_product_category)){ echo "checked";} ?>><span>{{ $cate->categorytitle }}</span></label>

                                                    @foreach($category as $subcate)
                                                        @if ($subcate->parent == $cate->categoryid)
                                                            <label class="col-sm-12 css-label"style="padding-left: 20%;"><input id="category" type="checkbox" value="{{ $subcate->categoryid }}" name="category[]" <?php if(in_array($subcate->categoryid, $expl_product_category)){ echo "checked";} ?>><span>{{ $subcate->categorytitle }}</span></label>

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
                                <input type="text" class="form-control" placeholder="Product Code" name="code" value="{{ $products->code }}" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Product Title</label>
                            <div class="col-sm-9">
                                <input id="addtitle" type="text" class="form-control" placeholder="Product Title" name="title" value="{{ $products->producttitle }}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Product Name</label>
                            <div class="col-sm-9">
                                <input type="text" id="addname" class="form-control" placeholder="Product Name" name="name" value="{{ $products->productname }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Brands</label>
                            <div class="col-sm-9">
                                <select name="brands" class="form-control">
                                    <option value="0">-- Select Brands --</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->brandsid }}" <?php if($products->brands==$brand->brandsid){ echo 'selected="selected"';} ?> >{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Stock</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="Stock" name="stock" value="{{ $products->stock }}"  >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Weight</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Weight" name="weight" value="{{ $products->weight }}" ><span class="input-group-addon">gram</span>
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
                                                <input id="lengthVal" type="text" class="form-control" placeholder="Length" name="length" value="{{ $products->length }}">
                                            </td>
                                            <td>
                                                <input id="widthVal" type="text" class="form-control" placeholder="Width" name="width" value="{{ $products->width }}">
                                            </td>
                                            <td>
                                                <input id="heightVal" type="text" class="form-control" placeholder="Height" name="height" value="{{ $products->height }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 text-left">Volume</label>
                            <div class="col-sm-9">
                                <input id="volumeVal" type="text" class="form-control" placeholder=Volume name="volume" value="{{ $products->volume }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Price (Rp)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Price" name="price" value="{{ $products->price }}"  >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Image</label>
                            <div  class="col-sm-9">
                                <span id="file">
                                    <input type="file" name="image[]" class="form-control">
                                </span>
                                    <p class="help-block"> <button id="uploadadd" type="button" class="btn btn-default btn-sm"><i class="icon ion-ios-plus-empty"></i></button> Click this for multiple upload.</p>
                                <div class="row">
                                    @foreach($images as $img)
                                    <div class="col-md-3 col-xs-6 text-center">
                                        <img src="{{ url('img/product/thumb/'.$img->image_thumb) }}"  width="100" height="auto">
                                        <a href="{{ url('admin/product/view/imgdelete/'.$img->productimageid) }}" class="btn btn-danger btn-xs">Delete</a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Public</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="enable" checked="1"> Enable
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Featured</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="featured"> Enable
                            </div>
                        </div>

                      </div><!--./row-->

                    </div><!--./Col-->
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="inputEmail3" class="col-sm-6 text-left" style="font-size:15pt;">Product Details</label>
                            <div id="items1" class="col-md-12">
                                @if($prodDetails == NULL)
                                    <p style="font-size:13pt">There is no details for this prorduct!</p>
                                @else
                                <table class="table table-rotation">
                                    <!-- <thead>
                                        <tr>
                                            <th style="width:auto">Title</th>
                                            <th style="width:auto">Value</th>
                                            <th style="width:120px;">Remove</th>
                                        </tr>
                                    </thead> -->
                                    <tbody>
                                        @foreach($prodDetails as $pd)
                                        <tr>
                                            <td data-label="Title">
                                                <input id="productDetailsId" type="hidden" class="form-control" placeholder="Title" value="{{$pd->id}}">
                                                <strong>{{$pd->title}}</strong>
                                            </td>
                                            <!-- <td>&nbsp;:&nbsp;</td> -->
                                            <td data-label="Value">
                                                {{$pd->value}}<span></span>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-default" onclick="getProductDetailById({{$pd->id}})" data-toggle="modal" data-target="#editProductDetailModal"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
                                                <a id="deleteRow" class="btn btn-sm btn-default" onclick="deleteProductDetails()" ><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-default box-solid collapsed-box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Product Details Add Form</h3>
                              <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body" style="display: none;">
                                <a onclick="additem()" class="btn btn-success" style="text-decoration: none; cursor: pointer; float:right; margin-bottom:2%"> + add detail</a>
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
                                            <td>
                                                <input type="text" class="form-control" placeholder="Value" name="detail_value[]">
                                            </td>
                                            <td style="text-align: center;">
                                                <a onclick="deleteItem(this)" id="deleteRow" class="btn btn-danger"><i class="icon ion-android-close"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                              </div><!-- /.box-body -->
                              <div class="box-footer">
                                  <button type="submit" class="btn btn-primary" style="width: 100%; text-decoration: none; cursor: pointer; float:right; margin-bottom:2%">Save</button>
                              </div>
                            </div><!-- /.box -->
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
                                    <textarea class="form-group texteditor" name="productinformation">{{ $products->productinformation }}</textarea>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div class="form-group" style="margin-top: 20px; padding: 2px 15px;">
                                    <textarea class="form-group texteditor" name="productdescription">{{ $products->productdescription }}</textarea>
                                </div>
                            </div>
                            <div id="menu3" class="tab-pane fade">
                                <div class="form-group" style="margin-top: 20px; padding: 2px 15px;">
                                    <textarea class="form-group texteditor" name="productspecification">{{ $products->productspecification }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div><!--./Col-->


                    <div class="col-xs-12 col-md-6">
                        <div class="box box-default box-solid collapsed-box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Product Variation</h3>
                              <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body" style="display: none;">
                                <table class="table table-hover table-bordered table-rotation">
                                    <thead>
                                        <tr>
                                            <th>Var_Code</th>
                                            <th>Var_Name</th>
                                            <th>Var_Stock</th>
                                            <th style="width: 85px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($prodVariation as $pv)
                                        <tr>
                                            <td data-label="Var_Code">
                                                <p>{{$pv->var_code}}</p>
                                            </td>
                                            <td data-label="Var_Name">
                                                <p>{{$pv->var_name}}</p>
                                            </td>
                                            <td data-label="Var_Stock">
                                                <p>{{$pv->var_stock}}</p>
                                            </td>
                                            <td data-label="Action">
                                                <a href="{{ url('admin/product/edit/variation/'.$pv->var_id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="{{ url('admin/product/delete/variation/'.$pv->var_id) }}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete"><i class="icon ion-android-close"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <a href="{{ url('admin/product/add/variation/'.$products->productid) }}" class="btn btn-primary" style="width: 100%; text-decoration: none; cursor: pointer; float:right; margin-bottom:2%"> + add variation</a>
                            </div>
                          </div><!-- /.box -->
                        </div>
                    </div>

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-md-12">
                        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                        <a href="{{ url('admin/product') }}"class="btn btn-default">Back</a>
                    </div>
                </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Modal -->
      <div id="editProductDetailModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Product Details</h4>
            </div>
            <div id="edit-modal-body" class="modal-body">
            </div>
          </div>

        </div>
      </div>

<!--DELETE ROW FUNCTION-->
<script type="text/javascript">
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

    // delete data from database
    function deleteProductDetails(){
        var token = $('#token').val();
        var id = $('#productDetailsId').val();

        var DataString = '_token=' + token + '&id=' + id;
        var r = confirm("Are You Sure??");
        if (r == true) {
            $.ajax({
                type: "GET",
                url: "{{ url('admin/product/details/delete') }}",
                data: DataString,
                success: function(data) {
                    $('#items1').load(location.href + ' #items1 ');
                    // location.reload();
                }
            });
        }
    }

    function getProductDetailById(id){
        var token = $('#token').val();

        var DataString = '_token=' + token + '&id=' + id;
        $.ajax({
            type: "GET",
            url: "{{ url('admin/product/details/edit') }}",
            data: DataString,
            success: function(data) {
                $('#edit-modal-body').html(data);
            }
        });
    }
    //
    function postEditedProductDetails(id){
        var token = $('#token').val();
        var edited_detail_title = $('input[name="edited_detail_title"]').val();
        var edited_detail_value = $('input[name="edited_detail_value"]').val();
        // alert(edited_detail_value);
        var DataString = '_token=' + token + '&id=' + id + '&edited_detail_title=' + edited_detail_title + '&edited_detail_value=' + edited_detail_value;
        $.ajax({
            type: "POST",
            url: "{{ url('admin/product/details/edit') }}",
            data: DataString,
            success: function(data) {
                // location.reload();
                $('#items1').load(location.href + ' #items1 ');
            }
        });
    }

    // function startSearch(){
    //     var token = $('#token').val();
    //     var searchCategory = $('.searchCategory').val();
    //     var productid = $('#productid').val();
    //
    //     // alert("silit");
    //     var DataStringSearch = '_token=' + token + '&searchCategory=' + searchCategory + '&productid=' + productid;
    //     $.ajax({
    //         type: "GET",
    //         url: "{{ url('admin/product/category/search') }}",
    //         data: DataStringSearch,
    //         success: function(data) {
    //             $('#categoryList').html(data);
    //         }
    //     });
    // }
</script>

<!--APPEND ROW FUNCTION-->
<script>
    function additem() {
        $('#items').append('<tr><td><input type="text" class="form-control" placeholder="Title" name="detail_title[]"></td><td><input type="text" class="form-control" placeholder="Value" name="detail_value[]"></td><td style="text-align: center;"><a onclick="deleteItem(this)" class="btn btn-danger"><i class="icon ion-android-close"></i></a></td></tr>');
        }

        // function listFilter(list, input) {
        //     var $lbs = list.find('.css-label');
        //
        //     function filter(){
        //         var regex = new RegExp('\\b' + this.value);
        //         var $els = $lbs.filter(function(){
        //             return regex.test($(this).text());
        //         });
        //         $lbs.not($els).hide().prev().hide();
        //         $els.show().prev().show();
        //     };
        //
        //     input.keyup(filter).change(filter)
        // }
        //
        // jQuery(function($){
        //     listFilter($('#categoryList'), $('.searchCategory'))
        // })

</script>
@endsection
