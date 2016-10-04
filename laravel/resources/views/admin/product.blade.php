@extends('admin/app')
@section('content')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Product
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Product</li>
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
                  <div class="text-right" style="margin-bottom:20px;">
                      <a href="{{ url('admin/product/add') }}" class="btn btn-primary"><i class="icon ion-android-add"></i> Add product</a>
                  </div>
                  <table id="example1" class="table table-bordered table-rotation">
                    <thead>
                      <tr>
                        <th style="width: 8%;">Code</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th style="width:90px;">Brands</th>
                        <!--<th>Product Name</th>-->
                        <th style="width: 250px;">Product Title</th>
                        <th style="width: 5%;">Stock</th>
                        <th style="width:50px;">Price</th>
                        <th style="width:20px;">Featured</th>
                        <th style="width:80px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($product as $prod)
                      <tr>
                        <td data-label="Code">{{ $prod->code }} &nbsp;</td>
                        <td data-label="Image" style="width:15px;">

                        <?php if(!empty($product_img['image_thumb'][$prod->productid])){ ?>
                        <img src="{{ url('img/product/thumb/'.$product_img['image_thumb'][$prod->productid].' ') }}" width="80" height="auto"/>
                        <?php }else{?>
                          <img src="{{ url('img/no-image_1.jpg') }}" width="80" height="60"/>
                        <?php } ?>
                        </td>
                        <!--<td data-label="Enable" class="text-center">
                          <?php
                          if($prod->enable==1){ ?>
                            <a href="#" class="btn btn-success btn-xs"><i class="icon ion-checkmark"></i></a>
                          <?php }else{ ?>
                            <a href="#" class="btn btn-danger btn-xs"><i class="ion-android-close"></i></a>
                          <?php } ?>
                            &nbsp;</td>-->

                        <td data-label="Category" width="5%">{{ $prod->category }}&nbsp;</td>
                        <td data-label="Product Brands">{{ $prod->name }} &nbsp;</td>
                        <!--<td data-label="Product Name">{{ $prod->productname }} &nbsp;</td>-->
                        <td class="" data-label="Product Title" style="">{{ $prod->producttitle }} &nbsp;</td>
                        <td data-label="Stock" style="text-align:center;">{{ $prod->stock }} &nbsp;</td>
                        <td data-label="Price" class="text-right"><span class="price_format">{{ $prod->price }}</span> &nbsp;</td>
                        <td data-label="Featured" style="text-align:center;">
                          <div class="form-group">
                            <label>
                              <input type="checkbox" class="featured-switch" <?php if($prod->featured_status == 1){echo "checked";} ?> onchange="switchStatus({{ $prod->productid }})">
                            </label>
                          </div>
                        </td>
                        <td data-label="Action">
                            <div class="btn-group">
                               <a href="{{ url('admin/product/view/'.$prod->productid.'') }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                               <!--<a href="{{ url('admin/product/view/'.$prod->code.'') }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit Product Variation"><i class="icon ion-android-create"></i></a>-->
                               <a href="#" title="Delete" class="btn btn-danger btn-sm" data-toggle="tooltip" onclick="if(confirm('Are you sure?'))location.href='{{ URL::to('admin/product/delete/' . $prod->productid) }}'"><i class="icon ion-android-close"></i></a>
                            </div>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <script>
          // $(window).load(function() {
          //     //Flat red color scheme for iCheck
          //     $('input[type="checkbox"].flat-red').iCheck({
          //       checkboxClass: 'icheckbox_flat-green'
          //     });
          // });

          function switchStatus(id) {
              $('.featured-switch').load('{{ url('admin/product/featured/status/productid=')}}' + id);
          }
      </script>
@endsection
