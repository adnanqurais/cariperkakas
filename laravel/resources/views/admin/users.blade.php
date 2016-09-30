@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Users
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Users</li>
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
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-delete') }}
                    </div>
                  @endif
                    @if(Session::has('success-create'))                    
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-create') }}
                    </div>
                  @endif
                  @if(Session::has('success-update'))                    
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-update') }}
                    </div>
                  @endif
                  <div class="text-right" style="margin-bottom:20px;">
                      <a href="{{ url('admin/users/add') }}" class="btn btn-primary"><i class="icon ion-android-add"></i> Add Users</a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped table-rotation">
                    <thead>
                      <tr>                   
                                                                                
                        <th>ID</th>
                        <th>Level</th>
                        <th>Full Name</th>
                        <th>User Name</th>                                                    
                        <th>Email</th>                                                                            
                        <th>Register</th>                                                                            
                        <th>Last Update</th>                                                                            
                        <th>Action</th>         
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                      <tr>                          
                        <td data-label="ID">{{ $user->id }} &nbsp;</td>
                        <td data-label="Level">{{ $user->levelname }} &nbsp;</td>
                        <td data-label="Full Name">{{ $user->fullname }} &nbsp;</td>                          
                        <td data-label="User Name">{{ $user->username }} &nbsp;</td>                                          
                        <td data-label="Email">{{ $user->email }} &nbsp;</td>                          
                        <td data-label="Register">{{ $user->created_at }} &nbsp;</td>                          
                        <td data-label="Last Update">{{ $user->updated_at }} &nbsp;</td>                          
                        <td data-label="Action">
                            <div class="btn-group">
                               <a href="{{ url('admin/users/view/'.$user->id) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="View"><i class="icon ion-eye"></i></a>
                               <a href="#" title="Delete" class="btn btn-danger btn-sm" data-toggle="tooltip" onclick="if(confirm('Are you sure?')) location.href='{{ URL::to('admin/users/delete/' . $user->id) }}'"><i class="icon ion-android-close"></i></a>
                            </div>
                        </td>                          
                      </tr>    
                    @endforeach                      
                    </tbody>
                    <tfoot>
                      <tr>      
                                                                                     
                        <th>ID</th>
                        <th>Level</th>
                        <th>Full Name</th>
                        <th>User Name</th>                                                    
                        <th>Email</th>                                                                            
                        <th>Register</th>                                                                            
                        <th>Last Update</th>                                                                            
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