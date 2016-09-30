@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Users 
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Users </li>
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
                   @if(Session::has('ready'))                    
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('ready') }}
                    </div>
                  @endif
                 
                <form class="form-horizontal" action="{{ url('admin/users/add') }}" method="post" enctype="multipart/form-data">               
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="box-body">
                    <div class="col-md-6">
                      <div class="row">
                                            
                      
                         <div class="form-group">
                            <label  class="col-sm-3 text-left">Level</label>
                            <div class="col-sm-9">
                                <select name="level" class="form-control">
                                    @foreach($access as $acc)
                                    <option value="{{ $acc->usersaccessid }}">{{ $acc->levelname }}</option>    
                                    @endforeach    
                                </select>
                            </div>
                        </div>               
                         <div class="form-group">
                            <label class="col-sm-3 text-left">Full name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Full name" name="fullname" value="{{ old('fullname')}}" required>
                            </div>
                        </div>                            
                        <div class="form-group">
                            <label  class="col-sm-3 text-left">User Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="User Name" name="username" value="{{ old('username')}}" required>
                            </div>
                        </div>              
                                         
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" placeholder="Email" name="email"  value="{{ old('email')}}"  required>
                            </div>
                        </div>             

                        <div class="form-group">
                            <label class="col-sm-3 text-left">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" placeholder="Password" name="password1"  required>
                            </div>
                        </div>        
                      <div class="form-group">
                            <label class="col-sm-3 text-left">Retype Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" placeholder="Retype Password" name="password2" required>
                            </div>
                        </div>                                                                                 
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left"></label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="enable" checked="1"> Enable
                            </div>
                        </div>

                      </div><!--./row-->
                      
                    </div><!--./Col--> 
                  
                   

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('admin/users') }}"class="btn btn-default">Back</a>
                    </div>
                </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->



    
@endsection
