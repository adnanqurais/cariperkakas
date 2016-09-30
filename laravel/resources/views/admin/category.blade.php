@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Category
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Category</li>
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
                        <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-delete') }}
                    </div>
                  @endif
                  <div class="text-right" style="margin-bottom:20px;">
                      <a href="{{ url('admin/category/add') }}" class="btn btn-primary"><i class="icon ion-android-add"></i> Add Category</a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped table-rotation">
                    <thead>
                      <tr>                                                       
                        <th>ID</th>
                        <!--<th>Enable</th>-->
                        <th>Category name</th>
                        <th>Category title</th>
                        <th>Parent</th>
                        <th>Color</th>                
                        <th>Icon</th>     
                        <th>Banner</th>    
                        <th>Slider 1</th>        
                        <th>Slider 2</th>        
                        <th>Slider 3</th>                                  
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($category as $cate)
                      <tr>
                        <td data-label="ID">{{ $cate->categoryid }} &nbsp;</td>
                        <!--<td data-label="Enable">
                          <?php
                          if($cate->enable==1){ ?>
                            <a href="#" class="btn btn-success btn-xs"><i class="icon ion-checkmark"></i></a> 
                          <?php }else{ ?>
                            <a href="#" class="btn btn-danger btn-xs"><i class="ion-android-close"></i></a> 
                          <?php } ?>
                          &nbsp;</td>-->
                        <td data-label="Category name">{{ $cate->categoryname }} &nbsp;</td>
                        <td data-label="Category title">{{ $cate->categorytitle }} &nbsp;</td>                                                       
                        <td data-label="Parent">{{ $cate->parent }} &nbsp;</td>                                                       
                        <td data-label="Color"><span style="background:{{ $cate->color }}; ">&nbsp;</span> {{ $cate->color }} &nbsp;</td>                                                    
                        <td data-label="Icon">
                          <?php if(!empty($cate->icon)){?>
                          <img src="{{ url('img/icon-category/'.$cate->icon)  }}" style="width:60px; height:60px;"> 
                          <?php } else{?>
                          <img src="{{ url('img/no-image.jpg') }}" width="60" height="60"/>
                          <?php } ?>

                          &nbsp;</td>    

                        <td data-label="Banner">

                          <?php if(!empty($cate->banner)){?>
                          <img src="{{ url('img/product/banner/product-category/'.$cate->banner.'')  }}" style="width:60px; height:60px;"> 
                          <?php } else{?>
                          <img src="{{ url('img/no-image.jpg') }}" width="60" height="60"/>
                          <?php } ?>

                          &nbsp;</td>
                        <td data-label="Slider 1">

                          <?php if(!empty($cate->slider1)){?>
                          <img src="{{ url('img/product/banner/product-category/slider/'.$cate->slider1.'')  }}" style="width:60px; height:60px;"> 
                          <?php } else{?>
                          <img src="{{ url('img/no-image.jpg') }}" width="60" height="60"/>
                          <?php } ?>

                          &nbsp;</td>
                        <td data-label="Slider 2">
                          <?php if(!empty($cate->slider2)){?>
                          <img src="{{ url('img/product/banner/product-category/slider/'.$cate->slider2.'')  }}" style="width:60px; height:60px;"> 
                          <?php } else{?>
                          <img src="{{ url(
                          'img/no-image.jpg') }}" width="60" height="60"/>
                          <?php } ?>

                          &nbsp;</td>
                        <td data-label="Slider 3">

                          <?php if(!empty($cate->slider3)){?>
                          <img src="{{ url('img/product/banner/product-category/slider/'.$cate->slider3.'')  }}" style="width:60px; height:60px;"> 
                          <?php } else{?>
                          <img src="{{ url(
                          'img/no-image.jpg') }}" width="60" height="60"/>
                          <?php } ?>
                          &nbsp;</td>                                 
                        <td data-label="Action">
                            <div class="btn-group">
                                <a href="{{ url('admin/category/view/'.$cate->categoryid.'') }}" data-toggle="tooltip" title="View" class="btn btn-sm btn-primary"><i class="icon ion-eye"></i></a>                            
                                <a href="#" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure?')) location.href='{{ URL::to('admin/category/delete/' . $cate->categoryid) }}'"><i class="icon ion-android-close"></i></a>&nbsp;
                            </div>
                        </td>
                      </tr>    
                    @endforeach                      
                    </tbody>
                    <tfoot>
                      <tr>                                                     
                        <th>ID</th>
                        <!--<th>Enable</th>-->
                        <th>Category name</th>
                        <th>Category title</th>
                        <th>Parent</th>
                        <th>Color</th>        
                        <th>Icon</th>           
                        <th>Banner</th>      
                        <th>Slider 1</th>        
                        <th>Slider 2</th>        
                        <th>Slider 3</th>                                 
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