@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
                  @if(Session::has('success-login'))                    
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-login') }}
                    </div>
                  @endif
     @if(Session::has('success-email'))                    
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-email') }}
                    </div>
                  @endif
                 <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $corders;?></h3>
                  <p>New Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{ url('admin/order/new') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $cpayment;?></h3>
                  <p>Payment</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-checkbox-outline"></i>
                </div>
                <a href="{{ url('admin/payment/new') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $cmess;?></h3>
                  <p>New Messages</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-mail"></i>
                </div>
                <a href="{{ url('admin/inbox') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $cusers;?></h3>
                  <p>All Users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-people"></i>
                </div>
                <a href="{{ url('admin/users') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->

                </div><!-- /.box-body -->
              </div><!-- /.box -->
          <div class="row">
              <div class="col-lg-6">
            <!-- quick email widget -->
              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-envelope"></i>
                  <h3 class="box-title">Quick Email</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div>

                  <form action="{{ url('admin/dashboard/email') }}" method="post">
                <div class="box-body">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                      <input type="email" class="form-control"  placeholder="Email to:" name="email">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Subject" name="subject">
                    </div>
                    <div>
                      <textarea name="message" class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                </div>
                <div class="box-footer clearfix">
                  <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                </div>

                  </form>
              </div>
            </div>

              <div class="col-lg-6">

                      <!-- Chat box -->
                      <div class="box box-warning">
                        <div class="box-header">
                          <i class="fa fa-comments-o"></i>
                          <h3 class="box-title">Messages</h3>
                          <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                            <!--<div class="btn-group" data-toggle="btn-toggle" >
                              <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>
                              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                            </div>-->
                          </div>
                        </div>
                        <div class="box-body chat" id="chat-box">
                          <!-- chat item
                          <div class="item">
                            <img src="dist/img/user4-128x128.jpg" alt="user image" class="online">
                            <p class="message">
                              <a href="#" class="name">
                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                                Mike Doe
                              </a>
                              I would like to meet you to discuss the latest news about
                              the arrival of the new theme. They say it is going to be one the
                              best themes on the market
                            </p>
                            <div class="attachment">
                              <h4>Attachments:</h4>
                              <p class="filename">
                                Theme-thumbnail-image.jpg
                              </p>
                              <div class="pull-right">
                                <button class="btn btn-primary btn-sm btn-flat">Open</button>
                              </div>
                            </div><!-- /.attachment 
                          </div><!-- /.item -->
                          <!-- chat item -->
                          @foreach($messages as $mess)                          
                          <div class="item">
                                <img src="{{ asset('img/default-user.png')}}" alt="user image" class="offline">
                                <p class="message">
                                  <a href="{{ url('admin/inbox/replay/'.$mess->messagesid ) }}" class="name">
                                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ $mess->datetime }}</small>
                                    {{ $mess->name }} - {{ $mess->email }}
                                  </a>
                                  <?php echo nl2br($mess->message, false); ?> &nbsp;
                             
                                </p>
                          </div><!-- /.item -->
                          @endforeach
                         
                            <!-- Pagination -->
                           <div class="row text-left">
                                <div class="col-lg-12">
                                    <ul class="pagination">
                                       <?php echo $messages->render(); ?>
                                    </ul>
                                </div>
                            </div>

                            


                        </div><!-- /.chat -->
                          
                        <!--<div class="box-footer">
                          <div class="input-group">
                            <input class="form-control" placeholder="Type message...">
                            <div class="input-group-btn">
                              <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                            </div>
                          </div>
                        </div>-->
                      </div><!-- /.box (chat box) -->


              </div><!-- /.col -->
            </div><!--/.row-->
                  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection