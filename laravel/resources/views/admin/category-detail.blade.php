@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Category Detail 
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Category Detail</li>
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
                   @if(Session::has('error-update'))                    
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('error-update') }}
                    </div>
                  @endif
                  
                <form class="form-horizontal" action="{{ url('admin/category/view') }}" method="post" enctype="multipart/form-data">               
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                              
                <input type="hidden" name="id" value="{{ $category->categoryid }}">
                <div class="box-body">
                    <div class="col-md-6">
                      <div class="row">
                         <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Category Title</label>
                            <div class="col-sm-9">
                                <input id="addtitle" type="text" class="form-control" placeholder="Category Title" name="title" value="{{ $category->categorytitle }}" required>
                            </div>
                        </div>                            
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Category Name</label>
                            <div class="col-sm-9">
                                <input id="addname"  type="text" class="form-control" placeholder="Category Name" name="name" value="{{ $category->categoryname }}" readonly required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Parent</label>
                            <div class="col-sm-9">
                                <select id="selcate" name="parent" class="form-control">
                                    <option value="0">No Parent</option>   
                                    @foreach($parent as $parent)
                                    <option value="{{ $parent->categoryid }}" <?php if($parent->categoryid == $category->parent){ echo 'selected="selected"';} ?>>{{ $parent->categorytitle }}</option>    
                                    @endforeach    
                                </select>
                            </div>
                        </div>              
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Color</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control colorpicker" placeholder="#" name="color" value="{{ $category->color }}" required>
                            </div>
                        </div>                                                         
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Icon</label>
                            <div  class="col-sm-9">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <?php if(!empty($category->icon)){ ?>
                                        <img src="{{ asset('img/icon-category/'.$category->icon) }}" width="65" height="65" class="img-circle" style="border:2px solid {{ $category->color }}; margin-bottom:5px;">
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input type="file" name="imageicon" class="form-control" accept="image/*" <?php if(empty($category->icon)){ echo "required"; }?> >                                      
                                        <p class="help-block">Will be resize 70x70 Pixel.</p>
                                    </div>
                                </div>
                            </div>
                        </div>              

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Banner</label>
                            <div  class="col-sm-9">
                                <div class="row">
                                    <div class="col-xs-12">
                                        
                                        <?php if(!empty($category->banner)){ ?>
                                        <img src="{{ asset('img/product/banner/product-category/'.$category->banner) }}" width="65" height="65" style=" margin-bottom:5px;">
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-12">

                                        <input type="file" name="imagesbanner" class="form-control" accept="image/*" onchange="$('#file_name0').html(this.value);"  <?php if(empty($category->banner)){ echo "required"; }?> >
                                        <p class="help-block">Will be resize 243x398 Pixel.</p>
                                    </div>
                                </div>
                            </div>
                        </div>         
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Slider 1</label>
                            <div  class="col-sm-9">
                                 <div class="row">
                                    <div class="col-xs-12">
                                        
                                        <?php if(!empty($category->slider1)){ ?>
                                        <img src="{{ asset('img/product/banner/product-category/slider/'.$category->slider1) }}" width="65" height="65" style=" margin-bottom:5px;">
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                 <div class="row">
                                    <div class="col-xs-12">
                                        <input type="file" name="imageslide1" class="form-control" accept="image/*" onchange="$('#file_name1').html(this.value);" <?php if(empty($category->slider1)){ echo "required"; }?>>
                                        <p class="help-block">Will be resize 560x400 Pixel.</p>
                                    </div>
                                </div>
                            </div>
                        </div>         

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Slider 2</label>
                            <div  class="col-sm-9">
                                 <div class="row">
                                    <div class="col-xs-12">
                                        
                                        <?php if(!empty($category->slider2)){ ?>
                                        <img src="{{ asset('img/product/banner/product-category/slider/'.$category->slider2) }}" width="65" height="65" style=" margin-bottom:5px;">
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                 <div class="row">
                                    <div class="col-xs-12">
                                        <input type="file" name="imageslide2" class="form-control" accept="image/*" onchange="$('#file_name2').html(this.value);" <?php if(empty($category->slider2)){ echo "required"; }?>>
                                        <p class="help-block">Will be resize 560x400 Pixel.</p>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                  
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Slider 3</label>
                            <div  class="col-sm-9">
                                 <div class="row">
                                    <div class="col-xs-12">
                                        
                                        <?php if(!empty($category->slider3)){ ?>
                                        <img src="{{ asset('img/product/banner/product-category/slider/'.$category->slider3) }}" width="65" height="65" style=" margin-bottom:5px;">
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                 <div class="row">
                                    <div class="col-xs-12">
                                        <input type="file" name="imageslide3" class="form-control" accept="image/*" onchange="$('#file_name3').html(this.value);" <?php if(empty($category->slider3)){ echo "required"; }?>>
                                        <p class="help-block">Will be resize 560x400 Pixel.</p>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                                       
                        <!--<div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Public</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="enable" checked="1"> Enable
                            </div>
                        </div>-->

                      </div><!--./row-->
                             
                     
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
