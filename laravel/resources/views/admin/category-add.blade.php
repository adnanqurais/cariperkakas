@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Category 
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Category </li>
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
                  
                <form class="form-horizontal" action="{{ url('admin/category/add') }}" method="post" enctype="multipart/form-data">               
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="box-body">
                    <div class="col-md-6">
                      <div class="row">
                         <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Category Title</label>
                            <div class="col-sm-9">
                                <input id="addtitle" type="text" class="form-control" placeholder="Category Title" name="title" required>
                            </div>
                        </div>                            
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Category Name</label>
                            <div class="col-sm-9">
                                <input id="addname"  type="text" class="form-control" placeholder="Category Name" name="name" readonly required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Parent</label>
                            <div class="col-sm-9">
                                <select id="selcate" name="parent" class="form-control">
                                    <option value="0">No Parent</option>    
                                    @foreach($parent as $parent)
                                    <option value="{{ $parent->categoryid }}">{{ $parent->categorytitle }}</option>    
                                    @endforeach    
                                </select>
                            </div>
                        </div>              
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Color</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control colorpicker" placeholder="#" name="color" required>
                            </div>
                        </div>                                                         
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Icon</label>
                            <div  class="col-sm-9">
                                <input type="file" name="imageicon" class="form-control" accept="image/*" required>                                      
                                <p class="help-block">Will be resize 70x70 Pixel.</p>
                            </div>
                        </div>              

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Banner</label>
                            <div  class="col-sm-9">
                                <input type="file" name="imagesbanner" class="form-control" accept="image/*" onchange="$('#file_name0').html(this.value);" required>
                                <p class="help-block">Will be resize 243x398 Pixel.</p>
                            </div>
                        </div>         
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Slider 1</label>
                            <div  class="col-sm-9">
                                <input type="file" name="imageslide1" class="form-control" accept="image/*" onchange="$('#file_name1').html(this.value);" required>
                                <p class="help-block">Will be resize 560x400 Pixel.</p>
                            </div>
                        </div>         

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Slider 2</label>
                            <div  class="col-sm-9">
                                <input type="file" name="imageslide2" class="form-control" accept="image/*" onchange="$('#file_name2').html(this.value);" required>
                                <p class="help-block">Will be resize 560x400 Pixel.</p>
                            </div>
                        </div>                                                                  
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Slider 3</label>
                            <div  class="col-sm-9">
                                <input type="file" name="imageslide3" class="form-control" accept="image/*" onchange="$('#file_name3').html(this.value);" required>
                                <p class="help-block">Will be resize 560x400 Pixel.</p>
                            </div>
                        </div>                                                                                       
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Public</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="enable" checked="1"> Enable
                            </div>
                        </div>

                      </div><!--./row-->
                             
                      <div class="checkbox">
                        <label>
                        </label>
                      </div>
                    </div><!--./Col--> 
                   
                   

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('admin/product') }}"class="btn btn-default">Back</a>
                    </div>
                </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->



    
@endsection
