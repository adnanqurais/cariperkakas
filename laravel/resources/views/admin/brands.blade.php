@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Brands
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Brands</li>
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
                  @if(Session::has('success-delete'))
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-delete') }}
                    </div>
                  @endif
                  @if(Session::has('success-create'))
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-create') }}
                    </div>
                  @endif
                  <div class="text-right" style="margin-bottom:20px;">
                      <a href="{{ url('admin/brands/add') }}" class="btn btn-primary"><i class="icon ion-android-add"></i> Add Brands</a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped table-rotation">
                    <thead>
                      <tr>
                        <th class="col-md-2">ID</th>
                        <th class="col-md-5">Name</th>
                        <th class="col-md-3">Logo</th>
                        <th class="col-md-1">Featured</th>
                        <th class="col-md-1">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $brand)
                      <tr>
                        <td data-label="ID">{{ $brand->brandsid }} &nbsp;</td>
                        <td data-label="Name">{{ $brand->name }} &nbsp;</td>
                        <td data-label="Logo"><img src="{{ url('img/brand/'.$brand->logo) }}" width="100"> &nbsp;</td>
                        <td data-label="Featured" style="text-align:center;">
                          <div class="form-group">
                            <label>
                              <input type="checkbox" class="brands-switch" <?php if($brand->featured_status == 1){echo "checked";} ?> onchange="switchStatus({{ $brand->brandsid }})">
                            </label>
                          </div>
                        </td>
                        <td data-label="Action">
                            <a href="{{ url('admin/brands/view/'.$brand->brandsid) }}" class="btn btn-sm btn-primary"><i class="icon ion-eye"></i></a>
                            <a href="#" title="Delete" class="btn btn-danger btn-sm" data-toggle="tooltip" onclick="if(confirm('Are you sure?')) location.href='{{ URL::to('admin/brands/delete/' . $brand->brandsid) }}'"><i class="icon ion-android-close"></i></a>
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
          function switchStatus(id) {
            // alert("it worked");
            $('.brands-switch').load('{{ url('admin/brands/featured-status/brandsid=')}}' + id);
          }
      </script>
@endsection
