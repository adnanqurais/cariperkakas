@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Bank
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Bank</li>
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
                        <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
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
                        <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-delete') }}
                    </div>
                  @endif
                  <div class="text-right" style="margin-bottom:20px;">
                      <a href="{{ url('admin/bank/add') }}" class="btn btn-primary"><i class="icon ion-android-add"></i> Add Bank</a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped table-rotation">
                    <thead>
                      <tr>              
                        <th style="width: 20px;">BankId</th>
                        <th style="width: 80px;">Bank Name</th>
                        <th>Account Number</th>
                        <th>Account Holder</th>
                        <th>Bank Location</th>                                                 
                        <th>Logo</th>
                        <th>Action</th> 
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($banks as $bank)
                      <tr>
                        <td data-label="Code">{{ $bank->bank_id }} &nbsp;</td> 
                        <td data-label="Name">{{ $bank->bankname }} &nbsp;</td>
                        <td data-label="Name">{{ $bank->banknumber }} &nbsp;</td>
                        <td data-label="Name">{{ $bank->bankholder }} &nbsp;</td>
                        <td data-label="Name">{{ $bank->location }} &nbsp;</td>
                        <td data-label="Image">
                            <?php if(!empty($bank->banklogo)){ ?>
                              <img src="{{ url('img/bank-logo/thumbnails/'.$bank->banklogo) }}"/>
                              <?php }else{?>
                                <img src="{{ url('img/no-image.png') }}" width="67" height="67"/>
                            <?php } ?>
                          &nbsp;
                        </td>   
                        <td data-label="Action">
                            <a href="{{ url('admin/bank/view/'.$bank->bank_id.'') }}" class="btn btn-sm btn-primary">View</a>                            
                            <a href="#" title="delete" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure?'))location.href='{{ URL::to('admin/bank/delete/'.$bank->bank_id.'') }}'">Delete</a>
                        </td>                          
                      </tr>    
                    @endforeach                      
                    </tbody>
                    <tfoot>
                      <tr>                    
                        <th style="width: 20px;">BankId</th> 
                        <th style="width: 40px;">Bank Name</th>
                        <th>Account Number</th>
                        <th>Account Holder</th>
                        <th>Bank Location</th>
                        <th>Logo</th>
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