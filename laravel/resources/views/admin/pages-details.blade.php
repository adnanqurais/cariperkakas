@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Pages Details
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Pages Details</li>
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
                
                  
                <form action="{{ url('admin/pages/view') }}" method="post">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="box-body">
                 <div class="col-md-4">
                     <input type="hidden" name="pagesid" value="{{ $pages->pagesid }}">
                      <div class="form-group">
                        <label>Title</label>
                        <input id="addtitle" type="text" class="form-control" placeholder="Title" name="title" value="{{ $pages->title }}" required>
                      </div>  
                      <div class="form-group">
                        <label for="">Name</label>
                        <input id="addname" type="text" class="form-control" placeholder="Name" name="name" value="{{ $pages->name }}" readonly required>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="enable" value="" checked> Enable
                        </label>
                      </div>
                </div>
                <div class="col-md-12">
                    <textarea class="form-group texteditor" name="content">{{ $pages->content }}</textarea>
                </div>
                </div><!-- /.box-body -->
                <div class="box-footer text-right">   
                    <div class="col-md-12">                        
                      <a href="{{ url('admin/pages') }}" class="btn btn-default">Back</a>  
                      <button type="submit" class="btn btn-primary">Create</button>  
                    </div>   
                </div>
                  
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
