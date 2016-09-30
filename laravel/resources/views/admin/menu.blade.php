@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Menu
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Menu</li>
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
                        <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-create') }}
                    </div>
                  @endif

                  @if(Session::has('success-delete'))                    
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-delete') }}
                    </div>
                  @endif
                  <div class="text-right" style="margin-bottom:20px;">
                      <a href="{{ url('admin/menu/add') }}" class="btn btn-primary"><i class="icon ion-android-add"></i> Add Menu</a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped table-rotation">
                    <thead>
                      <tr>                                                       
                        <th>ID</th>
                        <th>Position</th>
                        <th>Url</th>                      
                        <th>Title</th>                                    
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($menu as $m)
                      <tr>
                        <td data-label="ID">{{ $m->menuid }} &nbsp;</td>                      
                        <td data-label="Position">{{ $m->position }} &nbsp;</td>    
                        <td data-label="Link">{{ $m->url }} &nbsp;</td>      
                        <td data-label="Created at">{{ $m->title }} &nbsp;</td>                                    
                        <td data-label="Action">
                            <!--<a href="{{ url('admin/slider/view/'.$m->menuid.'') }}" class="btn btn-sm btn-primary">View</a>-->                            
                            <a href="#" title="Delete" class="btn btn-danger btn-sm" data-toggle="tooltip" onclick="if(confirm('Are you sure?')) location.href='{{ URL::to('admin/menu/delete/' . $m->menuid) }}'"><i class="icon ion-android-close"></i></a>&nbsp;
                        </td>
                      </tr>    
                    @endforeach                      
                    </tbody>
                    <tfoot>
                      <tr>                                                             
                        <th>ID</th>
                        <th>Position</th>
                        <th>Url</th>                      
                        <th>Title</th>                                    
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection