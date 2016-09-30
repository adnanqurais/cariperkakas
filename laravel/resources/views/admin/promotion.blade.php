@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Promotion
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Promotion</li>
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
                  @if(Session::has('success-delete'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-delete') }}
                    </div>
                  @endif
                  @if(Session::has('success-update'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-update') }}
                    </div>
                  @endif
                    <div class="text-right" style="margin-bottom:20px;">
                      <a href="{{ url('admin/promo/add') }}" class="btn btn-primary"><i class="icon ion-android-add"></i> Add Promo</a>
                  </div>
                  <table id="example2" data-order='[[ 1, "desc" ]]' class="table table-bordered table-striped table-rotation">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Req Type</th>
                        <th>Min Req</th>
                        <th>Max Req</th>
                        <th>Promo Type</th>
                        <th>Promo Reward</th>
                        <th>Promo Message</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($promoList as $promoList)
                       <tr>
                        <td data-label="Name" >{{ $promoList->promo_title }} &nbsp;</td>
                        <td data-label="Requirements Type">{{ $promoList->promo_requirements }} &nbsp;</td>
                        <td data-label="Min Req"><?php echo $promoList->promo_min_req ?>  &nbsp;</td>
                        <td data-label="Max Req"> <?php echo $promoList->promo_min_req ?> &nbsp;</td>
                        <td data-label="Promo Type"> <?php echo $promoList->promo_reward_type ?> &nbsp;</td>
                        <td data-label="Promo Reward"> <?php echo $promoList->promo_reward_value ?> &nbsp;</td>
                        <td data-label="Promo Message"> <?php echo $promoList->promo_message ?> &nbsp;</td>
                        <td data-label="Start Date"> <?php echo $promoList->promo_start_date ?> &nbsp;</td>
                        <td data-label="End Date"> <?php echo $promoList->promo_end_date ?> &nbsp;</td>
                        <td data-label="Action">
                            <a href="{{ url('admin/promo/view/' . $promoList->promo_id . '') }}" class="btn btn-sm btn-primary">View</a>
                            <a href="#" title="delete" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure?')) location.href='{{ URL::to('admin/promotion/delete/' . $promoList->promo_id) }}'">Delete</a>
                           &nbsp;
                        </td>
                      </tr> 
                    @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Req Type</th>
                        <th>Min Req</th>
                        <th>Max Req</th>
                        <th>Promo Type</th>
                        <th>Promo Reward</th>
                        <th>Promo Message</th>
                        <th>Start Date</th>
                        <th>End Date</th>
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
