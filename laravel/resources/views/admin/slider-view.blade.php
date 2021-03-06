@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            View Slider
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">View Slider </li>
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

                <form class="form-horizontal" action="{{ url('admin/slider/view') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="id" value="{{ $slider->sliderid }}">
                <div class="box-body">
                    <div class="col-md-6">
                      <div class="row">

                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Position</label>
                            <div class="col-sm-9">
                                <select id="position" name="position" class="form-control">
                                    <option value="main"<?php if($slider->position == "main"){ echo "selected"; } ?>>Main</option>
                                    <option value="featuredProducts" <?php if($slider->position == "featuredProducts"){ echo "selected"; } ?>>Featured Products</option>
                                    <option value="featuredBrands" <?php if($slider->position == "featuredBrands"){ echo "selected"; } ?>>Featured Brands</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 text-left">Link</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Link" name="link" value="{{ $slider->link }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Image</label>
                            <div  class="col-sm-9">
                                <span id="file">
                                    <div class="row" style="margin-bottom:20px;">
                                        <div class="col-md-12 text-center">
                                            <img id="preview" class="img-responsive" src="{{ url('img/slide/'.$slider->image) }}"  max-width="100%" height="auto">
                                        </div>
                                    </div>
                                    <div class="btn btn-primary btn-file btn-sm">
                                        <input type="file" id="image" name="image" class="form-control"> Change Image
                                    </div>
                                    <div id="cancel-change" class="btn btn-danger btn-file btn-sm" onclick="cancelChange()" disabled>Cancel</div>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Public</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="enable" value="1" <?php if($slider->enable == 1 ){ echo "checked";}?>> Enable
                            </div>
                        </div>

                      </div><!--./row-->
                    </div><!--./Col-->


                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('admin/slider') }}"class="btn btn-default">Back</a>
                    </div>
                </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <script>
        $("#image").change(function(){
            readURL(this);
            // alert(this.value);
            $('#cancel-change').removeAttr("disabled");
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function cancelChange(){
          var temp = "{{ url('img/slide/'.$slider->image) }}";
          $('#preview').attr('src', temp);
          $('#image').val('');
          $('#cancel-change').attr("disabled", "disabled");
        }
        // $("#cancel-change").click(function(){
        //     var canChange = {{ $slider->image }};
        //     alert(canChange);
        //     // readURL(this);
        //     // $('#cancel-change').attr("disabled", "disabled");
        // });
      </script>
@endsection
