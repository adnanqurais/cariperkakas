@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Product Variation Management
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Product Variation</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header" style="padding: 2px 15px;">
                      <input type="hidden" class="form-control" placeholder="Product Name" name="producttitle" value="{{ $product_info->producttitle }}" readonly>
                      <h3><strong>{{ $product_info->producttitle }}</strong><span><button type="button" class="btn" data-toggle="modal" data-target="#myModal" style="float:right;outline:none; background-color:#000;border-color:#000; color:#fff;">Add Variant +</button></span></h3>
                </div><!-- /.box-header -->


                <!-- Main content -->
                <section id="productContent" class="content">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-body">
                          @if(Session::has('success-create'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                                {{ Session::get('success-create') }}
                            </div>
                          @endif
                         @if(Session::has('success-update'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                                {{ Session::get('success-update') }}
                            </div>
                          @endif

                          @if(Session::has('success-delete'))
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                                {{ Session::get('success-delete') }}
                            </div>
                          @endif
                          @if($product_variation_info == NULL)
                              <h1 style="text-align:center;text-transform:bold; color:#5D7282;"><strong>THERE IS NO VARIANT YET!!</br> YOU ARE FREE TO ADD OR REMOVE YOU VARIANT!!!</strong></h1>
                          @else

                          @foreach($product_variation_info as $pv)
                          <div class="col-sm-3" style="border: 1px solid #D2D6DE;box-shadow: 1px 1px 10px #888888; margin: 10px 5px; border-radius: 5px;">
                              <input id="token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                              <div class="col-xs-12 col-sm-12" style="padding-right: 20px; text-align: right; cursor: pointer;position: absolute; z-index: 99;">
                                    <a title="Edit" style="cursor: pointer; margin-right: 5px;" href="{{ url('admin/product/edit/variation/'.$pv->var_id) }}"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="{{ url('admin/product/delete/variation/'.$pv->var_id) }}" title="Delete"  style="cursor: pointer;margin-right:5px;"><i class="fa fa-trash-o"></i></a>
                              </div>
                              <div class="col-sm-12">
                                  <label class="col-sm-2" style="margin: 0px; padding: 0px;">Code</label>
                                  <p class="col-sm-10" style="margin: 0px; padding: 0px;">{{$pv->var_code}}</p>
                                  <label class="col-sm-2" style="margin: 0px; padding: 0px;">Name</label>
                                  <p class="col-sm-10" style="margin: 0px; padding: 0px;">{{$pv->var_name}}</p>
                                  <label class="col-sm-2" style="margin: 0px; padding: 0px;">Stock</label>
                                  <p class="col-sm-10" style="margin: 0px; padding: 0px;">{{$pv->var_stock}}</p>
                                  <label class="col-sm-2" style="margin: 0px; padding: 0px;">Price</label>
                                  <p class="col-sm-10" style="margin: 0px; padding: 0px;">{{$pv->var_price}}</p>
                              </div>
                              <div class="col-sm-12">

                              </div>
                          </div>
                          @endforeach
                          @endif
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ url('admin/product') }}" class="btn btn-success" style="text-decoration: none; cursor: pointer; float:right;">Done</a>
                        </div>
                      </div><!-- /.box -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </section><!-- /.content -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


<!-- Modal ADD VARIATION-->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Variation</h4>
            </div>
            <div id="modalBody" class="modal-body">
                <form id="variationForm" class="form-horizontal" enctype="multipart/form-data">
                <input id="token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="producttitle" value="{{ $product_info->producttitle }}">
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="row">
                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Variation Code</label>
                            <div class="col-sm-9">
                                <input id="var_code" type="text" class="form-control" placeholder="Product Code" name="var_code" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Variation Name</label>
                            <div class="col-sm-9">
                                <input id="var_name" type="text" class="form-control" placeholder="Product Name" name="var_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Stock</label>
                            <div class="col-sm-9">
                                <input id="var_stock" type="number" class="form-control" placeholder="Stock" name="var_stock" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Price (Rp)</label>
                            <div class="col-sm-9">
                                <input id="var_price" type="text" class="form-control" placeholder="Price" name="var_price" >
                            </div>
                        </div>
                        </div><!--./row-->
                    </div><!--./Col-->

                    <div class="col-md-12">
                        <a onclick="additem()" class="btn btn-success" style="text-decoration: none; cursor: pointer; float:right; margin-bottom:2%"> + add detail</a>
                        <div class="form-group">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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
                                    <tbody id="items">
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Title" name="var_det_title[]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Value" name="var_det_value[]">
                                            </td>
                                            <!--<td>
                                                <form id="form1" runat="server"
                                                    <input type='file' name='image2[]' class='form-control' id="inputFile" />
                                                    <img id="image_upload_preview" src="http://placehold.it/100x100" alt="your image" />
                                                </form>
                                            </td>-->
                                            <td style="text-align: center;">
                                                <a type="button" onclick="deleteItem(this)" id="deleteRow" class="btn btn-sm btn-danger"><i class="icon ion-android-close"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                    <div class="box-footer">
                    <div class="col-md-12" style="text-align: right">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">


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
</script>

<!--APPEND ROW FUNCTION-->
<script type="text/javascript">
    function additem() {
        $('#items').append('<tr><td><input type="text" class="form-control" placeholder="Title" name="var_det_title[]"></td><td><input type="text" class="form-control" placeholder="Value" name="var_det_value[]"></td><td style="text-align: center;"><a onclick="deleteItem(this)" class="btn btn-sm btn-danger"><i class="icon ion-android-close"></i></a></td></tr>');
    }
    $('#variationForm').submit(function(ev) {
        $.ajax({
            type: "post",
            url: "{{ url('admin/product/add/variation') }}",
            data: $(this).serialize(),
            success: function(data) {
                $('#productContent').load(location.href + ' #productContent ' , function() {
                    $('#myModal').modal('toggle');
                    $('#variationForm')[0].reset();
                });
                //$('#productContent').load();

            }
        });
        ev.preventDefault();
        //$('.modal-body').load('{{ url('admin/product/add/variation')}}');
    });

    //$('#editVariationForm').submit(function (ev) {
    //    $.ajax({
    //        type: "post",
    //        url: "{{ url('admin/product/edit/variation/post') }}",
    //        data: $(this).serialize(),
    //        success: function (data) {
    //            location.reload();
    //        }
    //    });
    //    ev.preventDefault();
    //});
    function editVariant(id) {
        var token = $('#token').val();
        var dataString = '_token=' + token + '&id=' + id;
        $.ajax({
            type: "GET",
            url: "{{ url('admin/product/edit/variation') }}",
            data: dataString,
            success: function(data) {
                //alert(data);
                $('#modalBody').html(data);
            }
        });
    }
    //function postEditVariant() {
    //    var token = $('#token').val();
    //    var var_code = $('input[name="var_code"]').val();
    //    var var_name = $('input[name="var_name"]').val();
    //    var var_stock = $('input[name="var_stock"]').val();
    //    var var_price = $('input[name="var_price"]').val();
    //    var var_det_title = $('input[name="var_det_title"]').each();
    //    var var_det_value = $('input[name="var_det_value"]').each();
    //    console.log(var_det_value);
    //    //var dataString = '_token=' + token
    //    //                + '&var_code=' + var_code
    //    //                + '&var_name=' + var_name
    //    //                + '&var_stock=' + var_stock
    //    //                + '&var_price=' + var_price
    //    //                + '&var_det_title=' + var_det_title
    //    //                + '&var_det_value=' + var_det_value;
    //    //$.ajax({
    //    //    type: "post",
    //    //    url: "{{ url('admin/product/edit/variation') }}",
    //    //    data: $(this).serialize(),
    //    //    success: function (data) {
    //    //        location.reload();
    //    //    }
    //    //});
    //}

</script>


@endsection
