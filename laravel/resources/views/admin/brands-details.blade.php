@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Brands Details
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Brands Details  </li>
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

                <form class="form-horizontal" action="{{ url('admin/brands/view/') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="brandsid" value="{{ $brands->brandsid }}">
                <div class="box-body">
                    <div class="col-md-6">
                      <div class="row">


                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Name" name="brandsname" value="{{ $brands->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Logo</label>
                            <!-- <div class="col-sm-9">
                                <input type="file" class="form-control" name="brand" required>
                            </div> -->
                            <div class="col-sm-9">
                                <div class="row" style="margin-bottom:20px;">
                                    <div class="col-md-12 text-center">
                                        <img id="preview" class="img-responsive" src="{{ url('img/brand/'.$brands->logo) }}"  max-width="100%" height="auto">
                                    </div>
                                </div>
                                <div class="btn btn-primary btn-file btn-sm">
                                    <input type="file" id="image" name="image" class="form-control"> Change Image
                                </div>
                                <div id="cancel-change" class="btn btn-danger btn-file btn-sm" onclick="cancelChange()" disabled>Cancel</div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Enable</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="enable" <?php if($brands->enable == 1){echo "checked";} ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Featured</label>
                            <div class="col-sm-9">
                                <input type="checkbox" id="featured" name="featured" <?php if($brands->featured_status == 1){echo "checked";} ?>>
                            </div>
                            <!-- <script>
                                $('#featured').change(function(){
                                    alert("ahahahahah");
                                });
                            </script> -->
                        </div>
                      </div><!--./row-->

                    </div><!--./Col-->



                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <!-- <a href="{{ url('admin/brands') }}"class="btn btn-default">Back</a> -->
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
  var temp = "{{ url('img/brand/'.$brands->logo) }}";
  $('#preview').attr('src', temp);
  $('#image').val('');
  $('#cancel-change').attr("disabled", "disabled");
}
//
</script>
@endsection
