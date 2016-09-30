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
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($promo as $p): ?>
                                    <tr>
                                      <td data-label="Code">{{ $p->dekstopcaption }} &nbsp;</td>
                                      <td data-label="Name">{{ $p->mobilecaption }} &nbsp;</td>
                                      <td data-label="Name">{{ $p->link }} &nbsp;</td>
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
                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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




@endsection
