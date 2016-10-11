@extends('app')

@section('content')  

<style>
    
    @media screen and (max-width: 900px) {
        .tableresponsive {
            border: 0;
        }

        .tableresponsive thead,tfoot {
            display: none;
        }

        .tableresponsive tr {
            margin-bottom: 10px;
            display: block;
            border-bottom: 2px solid #ddd;
        }

        .tableresponsive td {
            display: block;
            text-align: right;
            font-size: 13px;
            border-bottom: 1px dotted #ccc;
        }

        .tableresponsive td:last-child {
            border-bottom: 0;
        }

        .tableresponsive td:before {
            content: attr(data-label);
            float: left;
            text-transform: uppercase;
            font-weight: bold;
        }

    }
    
</style>
<div class="main-area container">
    <!--row-->
    <div class="row">
        <?php if(Session::get('sessionmember')){?>
        <!--col-->
        <div class="col-md-3">
            <ul class="mobile-menu-account nav nav-pills nav-stacked">
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                          <li class=""><a href="{{ url('account/profile' ) }}">Profil</a></li>
                          <li><a href="{{ url('account/invoice')}}">Tagihan</a></li>            
                          <li><a href="{{ url('logout') }}">Keluar</a></li>     
                    </ul>
                </li>
            </ul>

            <ul class="dekstop-menu-account menu-vertical">
              <li class=""><a href="{{ url('account/profile') }}">Profil</a></li>
              <li><a href="{{ url('account/invoice') }}">Tagihan</a></li>        
              <li><a href="{{ url('logout') }}">Keluar</a></li>
            </ul>


        </div>
        <?php }else{?>
        <!--./Col-->
        <!--col-->
        <div class="col-md-6 col-centered">
            <form id="trackOrder" class="form-horizontal" role="form">
                <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email: </label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="col-md-2" style="padding: 0;">
                    <button type="submit" class="btn btn-default" style=" background-color: #ff9900; color: #fff;">Check Order</button>
                </div>
                </div>
            </form>
        </div>
        <?php }?>
        <!--col-->
        <div class="col-md-9">
            @if(Session::has('success-add'))
            <div class="alert alert-success">{{ Session::get('success-add') }}</div>
            @endif
            <!-- Content-->
                <h3>Tagihan</h3>
            <table class="table tableresponsive">
            <thead>
                <tr>
                <th>Tagihan</th>                            
                <th>Waktu Pesan</th>
                <th>Status</th>
                <th>Tanggal Pengiriman</th>
                <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($newinvoice as $new)
                <tr>
                <td data-label="Tagihan">#{{ $new->invoiceid }}</td>
                <td data-label="Waktu Pesan">{{ $new->orderdate }}</td>                            
                <td data-label="Status" ><span class="text-danger">
                    <?php 
                    if($new->status==0){?>
                        <div class="label label-warning">Pending</div>
                    <?php }elseif($new->status==1){  ?>
                        <div class="label label-success">Processing</div>
                    <?php }elseif($new->status==4){  ?>
                        <div class="label label-danger">Cancelled</div>         
                    <?php } ?>

                    </span></td>
                <td data-label="Pengiriman" ><span class="text-success">
                    <?php
                    if($new->status==2){?>
                        <div class="label label-danger">Cancelled</div>
                   <?php }else{ ?>
                        <?php if(empty($new->delivery_date)){?>
                            <div class="label label-warning">Menunggu</div>
                        <?php }else{  ?>
                                {{ $new->delivery_date }}
                        <?php } ?>
                    <?php } ?>
                    

                    </span></td>
                <td data-label="Tindakan">
                    <a href="{{ url('account/invoice/details/'.$new->invoiceid) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ url('payment-confirmation/'.$new->invoiceid) }}" class="btn btn-warning btn-sm">Konfirmasi</a>
                </td>
                </tr>
                          
                @endforeach
                @if(empty($newinvoice))
                <tr>
                <td colspan="5">Belum ada tagihan</td>                     
                </tr>
                @endif
            </tbody>                        
            </table>
            <!--./Tab Content-->    
        </div>
        <!--./Col-->
    </div><!--./row-->
</div><!--./container-->

<div class="main-area container" style="border: none;">  
    <div class="col-md-8 col-centered clearfix">
        @foreach($banks as $bank)
        <div style="width: 45%; display: block; float: left; margin: 10px; background-color: #f9f9f9; padding: 10px;">
            <div class="col-md-12" style="text-align: center; margin: auto;">
                <?php if(!empty($bank->banklogo)){ ?>
                    <img src="{{ url('img/bank-logo/'.$bank->banklogo) }}" style="width: 60%; padding: 10px;"/>
                    <?php }else{?>
                    <img src="{{ url('img/no-image.png') }}" width="67" height="67"/>
                <?php } ?>
                &nbsp;
                <h2 style="font-size: 16pt; text-align: center; margin: auto;">{{ $bank->bankname }}</h2>
            </div>
            <div class="col-centered" style="width: 80%; display: block;">
                
                <table style="padding: 5px; margin: 0 auto;">
                    <tr  style="padding: 2px;">
                        <td style="padding: 0 5px;">No. Rekening</td>
                        <td> : </td>
                        <td style="padding: 0 5px;"><h2 style="font-size: 10pt; margin: 0;"> {{ $bank->banknumber }}</h2></td>
                    </tr>
                    <tr  style="padding: 2px;">
                        <td style="padding: 0 5px;">a.n. </td>
                        <td> : </td>
                        <td style="padding: 0 5px;"><h2 style="font-size: 10pt; margin: 0;"> {{ $bank->bankholder }}</h2></td>
                    </tr>
                    <tr  style="padding: 2px; ">
                        <td style="padding: 0 5px;">Bank Cabang</td>
                        <td> : </td>
                        <td style="padding: 0 5px;"><h2 style="font-size: 10pt; margin: 0;"> {{ $bank->location }}</h2></td>
                    </tr>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection