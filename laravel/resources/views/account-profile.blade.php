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
        <ul class="breadcrumb">
            <li><a href="#"><i class="icon ion-ios-home"></i></a></li>
            <li class="active">Akun</li>
        </ul>    
    <!--row-->
        <!--col-->
        <div class="col-md-3">
            
            <ul class="mobile-menu-account nav nav-pills nav-stacked">
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                          <li class="active"><a href="{{ url('account/profile') }}">Profil</a></li>
                          <li><a href="{{ url('account/invoice') }}">Tagihan</a></li>            
                          <li><a href="{{ url('logout') }}">Keluar</a></li>     
                    </ul>
                </li>
            </ul>
            <ul class="dekstop-menu-account menu-vertical">
              <li class="active"><a href="{{ url('account/profile') }}">Profil</a></li>
              <li><a href="{{ url('account/invoice') }}">Tagihan</a></li>         
              <li><a href="{{ url('logout') }}">Keluar</a></li>
            </ul>


        </div>
        <!--./Col-->
     
        <!--col-->
        <div class="col-md-9" style="padding-left: 5%;">
          
                @if(Session::has('successregister'))
                <div class="alert alert-success">{{ Session::get('successregister') }}</div>
                @endif
                @if(Session::has('success-checkout'))
                <div class="alert alert-success">{{ Session::get('success-checkout') }}</div>
                @endif
                <div class=" col-lg-7">  
                @if(Session::has('success-update-profile'))
                    <div class="alert alert-success">{{ Session::get('success-update-profile') }}</div>
                @endif
                @if(Session::has('emailready'))
                    <div class="alert alert-danger">{{ Session::get('emailready') }}</div>
                @endif
                 @if(Session::has('successlogin'))
                    <div class="alert alert-success">{{ Session::get('successlogin') }}</div>
                @endif
                <div class="row">
                    <h3>Profil</h3>  
                </div>               
                  <form class="form-horizontal" action="{{ url('account/profile') }}" method="post" >
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                
                  <div class="form-group">
                    <label class="col-sm-3">Email</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control  input-flat" placeholder="Email" value="{{ $user->email }}" name="email">
                      </div>
                  </div>
                 

                <div class="row">
                    <h3>Informasi Pengiriman</h3>  
                </div>      
                  <div class="form-group">
                    <label class="col-sm-3">Nama Lengkap</label>
                      <div class="col-sm-9">   
                         <input type="text" class="form-control  input-flat" placeholder="Nama Lengkap"  value="{{ $user->fullname }}"  name="fullname" >     
                      </div>
                  </div>
                    
                  <div class="form-group">
                    <label class="col-sm-3">Alamat</label>
                     <div class="col-sm-9">   
                      <textarea name="address" class="form-control input-flat"  placeholder="Alamat" style="resize: vertical;">{{ $user->address }}</textarea>
                      </div>
                  </div>
                   <div class="form-group">
                    <label class="col-sm-3">Kode Pos</label>
                     <div class="col-sm-9">   
                         <input type="text" class="form-control  input-flat" placeholder="Pos Kode"  value="{{ $user->poscode }}"  name="poscode" maxlength="5"> 
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">No. Telepon / Handphone</label>
                     <div class="col-sm-9">   
                         <input type="text" class="form-control  input-flat" placeholder="No. Telepon / Handphone"  value="{{ $user->handphone }}"  name="phonenumber"> 
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Kota</label>
                     <div class="col-sm-9">   
                      <select name="city" class="form-control  input-flat">
                        @foreach($city as $cit)
                        <option value="{{ $cit->name }}" <?php if($user->city==$cit->name){ echo 'selected';} ?>>{{ $cit->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Provinsi</label>
                     <div class="col-sm-9">   
                      <select name="province" class="form-control  input-flat">  
                        @foreach($province as $prov)
                        <option value="{{ $prov->name }}" <?php if($user->province==$prov->name){ echo 'selected';} ?>>{{ $prov->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Handphone</label>
                      <div class="col-sm-9">   
                        <input type="text" class="form-control input-flat" placeholder="Nomor Handphone" value="{{ $user->handphone }}" name="handphone"  >                      
                        <p class="help-block">Contoh: 08571234567</p>
                      </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                </form>
              </div>
            <!--./Tab Content-->    
        </div>
        <!--./Col-->


</div><!--./container-->
@endsection
