@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Menu
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Menu </li>
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

                <form class="form-horizontal" action="{{ url('admin/menu/edit') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="menuid" value="{{ $menu->menuid }}">

                <div class="box-body">
                    <div class="col-md-6">
                      <div class="row">

                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Position</label>
                            <div class="col-sm-9">
                                <select id="position" name="position" class="form-control">
                                    <option value="bottom1" <?php if($menu->position == "bottom1"){echo "selected";}?>>Bottom1</option>
                                    <option value="bottom2" <?php if($menu->position == "bottom2"){echo "selected";}?>>Bottom2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 text-left">Url</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Url" name="url" value="{{ $menu->url }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 text-left">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Title" name="title" value="{{ $menu->title }}" required>
                            </div>
                        </div>
                      </div><!--./row-->
                    </div><!--./Col-->


                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('admin/menu') }}"class="btn btn-default">Back</a>
                    </div>
                </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->




@endsection
