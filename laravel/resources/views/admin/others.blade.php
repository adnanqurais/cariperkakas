@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Others
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Others </li>
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
                  @if(Session::has('success-update'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-update') }}
                    </div>
                  @endif
                  @if(Session::has('success-delete'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-delete') }}
                    </div>
                  @endif
                    <div class="col-md-12">
                      <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#viewTopPromo">Top Promotion</a></li>
                        <li><a data-toggle="tab" href="#addTopPromo"><i class="icon ion-android-add"></i> Add Promo</a></li>
                      </ul>


                      <div class="tab-content">

                        <!-- Start View Top Promo -->
                        <div id="viewTopPromo" class="tab-pane fade in active">
                          <div class="col-sm-7" style="padding-top:30px;">
                            <div class="row">
                              <table class="table table-bordered table-striped table-rotation">
                                <thead>
                                  <tr>
                                    <th>Desktop Caption</th>
                                    <th>Mobile Caption</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($promo as $p): ?>
                                    <tr>
                                      <td data-label="Code">{{ $p->dekstopcaption }} &nbsp;</td>
                                      <td data-label="Name">{{ $p->mobilecaption }} &nbsp;</td>
                                      <td data-label="Name">{{ $p->link }} &nbsp;</td>
                                      <td>
                                        <div class="btn-group">
                                          <a href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModal" title="Edit" onclick="editPromoTop({{$p->promotionid}})"><i class="fa fa-pencil-square-o"></i></a>
                                          <a href="#" title="Delete" class="btn btn-danger btn-sm" data-toggle="tooltip" onclick="if(confirm('Are you sure?')) location.href='{{ URL::to('admin/delete/others/' . $p->promotionid) }}'"><i class="icon ion-android-close"></i></a>
                                        </div>
                                      </td>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <!-- End View Top Promo -->

                        <div id="addTopPromo" class="tab-pane fade">
                          <form class="form-horizontal" action="{{ url('admin/others') }}" method="post" enctype="multipart/form-data">
                          <input type="hidden" id="token" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="col-md-6" style="padding-top:20px;">
                              <div class="row">
                                 <div class="form-group">
                                    <label for="" class="col-sm-3 text-left">Dekstop Caption</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Dekstop Caption" name="dcaption" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 text-left">Mobile Caption</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Mobile Caption" name="mcaption" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 text-left">Link</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Link" name="link" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 text-left">Public</label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" name="enable"> Enable
                                    </div>
                                </div>
                                <div class="col-md-12" style="text-align:right;">
                                    <div class="row">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ url('admin/others') }}"class="btn btn-default">Back</a>
                                    </div>
                                </div>
                              </div><!--./row-->
                            </div><!--./Col-->
                            </form>
                        </div>
                      </div>
                    </div><!--./Col-->



                </div><!-- /.box-body -->
                <div class="box-footer">

                </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div id="modalBody" class="modal-body">

      </div>
      <div class="modal-footer">

      </div>
    </div>

  </div>
</div>

<script>
function editPromoTop(id) {
    var token       = $('#token').val();
    var dataString  = '_token=' + token + '&id=' + id;
    $.ajax({
        type: "GET",
        url: "{{ url('admin/others/edit/') }}",
        data: dataString,
        success: function(data) {
            //alert(data);
            $('#modalBody').html(data);
        }
    });
}
function postTopPromo(id){
  var token = $('#token').val();
  var desktopcaption = $('input[name="desktopcaption"]').val();
  var mobilecaption = $('input[name="mobilecaption"]').val();
  var link = $('input[name="link"]').val();
  if(link == ''){
    var link = "#";
  }
  var dataString  = '_token=' + token + '&desktopcaption=' + desktopcaption + '&mobilecaption=' + mobilecaption + '&link=' + link + '&id=' + id;
  $.ajax({
      type: "POST",
      url: "{{ url('admin/others/edit/post') }}",
      data: dataString,
      success: function(data) {
          //alert(data);
          $('#viewTopPromo').load(location.href + ' #viewTopPromo ');
      }
  });
}
</script>

@endsection
