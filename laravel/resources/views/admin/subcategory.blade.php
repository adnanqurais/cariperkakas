@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Sub Category
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Sub Category</li>
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
                      <a href="{{ url('admin/subcategory/add') }}" class="btn btn-primary"><i class="icon ion-android-add"></i> Add Subcategory</a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped table-rotation">
                    <thead>
                      <tr>                                               
                        <th>ID</th>
                        <th>Enable</th>
                        <th>Category</th>
                        <th>Sub Category name</th>
                        <th>Sub Category title</th>                       
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($subcategory as $scate)
                      <tr>
                        <td data-label="ID">{{ $scate->subcategoryid }} &nbsp;</td>
                        <td data-label="Enable">
                          <?php
                          if($scate->enable==1){ ?>
                            <a href="#" class="btn btn-success btn-xs"><i class="icon ion-checkmark"></i></a> 
                          <?php }else{ ?>
                            <a href="#" class="btn btn-danger btn-xs"><i class="ion-android-close"></i></a> 
                          <?php } ?>
                          &nbsp;</td>
                        <td data-label="Category title">{{ $scate->categorytitle }} &nbsp;</td>
                        <td data-label="Sub Category name">{{ $scate->subcategoryname }} &nbsp;</td>
                        <td data-label="Sub Category title">{{ $scate->subcategorytitle }} &nbsp;</td>                          
                                                 
                        <td data-label="Action">
                            <div class="btn-group">
                               <a href="{{ url('admin/subcategory/view/'.$scate->subcategoryid.'') }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="View"><i class="icon ion-eye"></i></a>                            
                               <a href="#" title="Delete" class="btn btn-danger btn-sm" data-toggle="tooltip" onclick="if(confirm('Are you sure?')) location.href='{{ URL::to('admin/subcategory/delete/' . $scate->subcategoryid) }}'"><i class="icon ion-android-close"></i></a>&nbsp;
                            </div>
                        </td>
                      </tr>    
                    @endforeach                      
                    </tbody>
                    <tfoot>
                      <tr>                                                     
                        <th>ID</th>
                        <th>Enable</th>                        
                        <th>Category</th>
                        <th>Sub Category name</th>
                        <th>Sub Category title</th>                             
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