@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Variant Details Management
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
                <div class="box-header">
                  <!--<h3 class="box-title">Data Table With Full Features</h3>-->
                </div><!-- /.box-header -->
                  
                <form class="form-horizontal" action="{{ url('admin/product/edit/variation/'.$product_var_info->var_id) }}" method="post" enctype="multipart/form-data">               
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <!--<input type="hidden" id="code" value="">-->
                <div class="box-body">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Product Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Product Name" name="producttitle" value="{{ $product_info->producttitle }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Variation Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Product Code" value="{{ $product_var_info->var_code }}" name="var_code" >
                            </div>
                        </div>      
                        <!--<div class="form-group">
                            <label for="" class="col-sm-3 text-left">Variation Title</label>
                            <div class="col-sm-9">
                                <input id="addtitle" type="text" class="form-control" placeholder="Product Title" name="var_title" >
                            </div>
                        </div>-->                      
                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Variation Name</label>
                            <div class="col-sm-9">
                                <input id="addname" type="text" class="form-control" placeholder="Product Name" value="{{ $product_var_info->var_name }}"name="var_name">
                            </div>
                        </div>                                             
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Stock</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="Stock" value="{{ $product_var_info->var_stock }}" name="var_stock" >
                            </div>
                        </div>                                                    
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Price (Rp)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Price" value="{{ $product_var_info->var_price }}" name="var_price" >
                            </div>
                        </div>
                      </div><!--./row-->
                    </div><!--./Col-->
                    
                        <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <label for="inputEmail3" class="col-sm-6 text-left">Variation Details</label>
                            <div class="col-sm-12">
                                <table class="table table-hover table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Title</th>
                                            <th>Value</th>
                                            <th style="width:60px; text-align: center;">Action</th>
                                        </tr>
                                    </tbody>
                                    <tbody>
                                        @foreach($product_var_details as $pvd)
                                        <tr>
                                            <td>
                                                <p>{{$pvd->var_det_title}}</p>
                                            </td>
                                            <td>
                                                <p>{{$pvd->var_det_value}}</p>
                                            </td>
                                            <td style="text-align: center;">
                                                <a title="Edit" data-toggle="modal" data-target="#editVariationDetails" style="cursor: pointer; margin-right: 5px;" onclick="editVariantDetails(<?php echo $pvd->var_det_id; ?>)"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                                                <a title="Remove Data" href="#" onclick="if(confirm('Are you sure?'))location.href='{{ URL::to('admin/product/variation/details/delete/' . $pvd->var_det_id) }}'"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <a onclick="additem()" class="btn btn-sm btn-success" style="text-decoration: none; cursor: pointer; float:right; margin-bottom:2%"> + add detail</a>
                                <div class="form-group">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <label for="inputEmail3" class="col-sm-3 text-left">Add Variation Details</label>
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
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-sm btn-primary" style="float: right;">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                </form>
                <div class="box-footer" style="text-align: right;">
<!--                    <a href="{{ url('admin/product') }}"class="btn btn-default">Back</a>-->
                    <a  href="{{url('admin/product/add/variation/'.$product_info->productid.'') }}" class="btn btn-success">Done</a>
                </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->



<!-- Modal -->
  <div class="modal fade" id="editVariationDetails" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Variation Details</h4>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
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
</script>

<script>
    function editVariantDetails(id) {
        var token = $('#token').val();
        var dataString = '_token=' + token + '&id=' + id;
        $.ajax({
            type: "GET",
            url: "{{ url('admin/product/variation/details/edit') }}",
            data: dataString,
            success: function(data) {
                //alert(data);
                $('.modal-body').html(data);
            }
        });
    }


    function postEditVariant() {
        var token = $('#token').val();
        var variantDetailId = $('#variantDetailId').val();
        var detail_tittle = $('#detail_tittle').val();
        var detil_value = $('#detil_value').val();
        var dataString = '_token=' + token + '&variantDetailId=' + variantDetailId + '&detail_tittle=' + detail_tittle + '&detil_value=' + detil_value;

        $.ajax({
            type: "GET",
            url: "{{ url('admin/product/variation/details/edit/post') }}",
            data: dataString,
            success: function(data) {
                location.reload();
            }
        });
    }
</script>

@endsection

