@extends('app')

@section('content')  
<div class="main-area container">
        {{-- <ul class="breadcrumb">
            <li><a href="#"><i class="icon ion-ios-home"></i></a></li>
            <li class="active">Konfirmasi Pembayaran</li>
        </ul>   --}}
    
<div class="col-md-6 col-md-push-3">
    <h3 class="text-center">KONFIRMASI PEMBAYARAN</h3>
    <img src="{{ asset('/img/logo.png') }}" alt="logo" style="height: 52px; width: 250px; display: block; margin: 0 auto;" align="center"><br>
      @if(Session::has('idnotfound'))
            <div class="alert alert-danger">{{ Session::get('idnotfound') }}</div>
       @endif
      @if(Session::has('success-submit-payment'))
            <div class="alert alert-success">{{ Session::get('success-submit-payment') }}</div>
       @endif
    <form action="{{ url('payment-confirmation') }}" method="post" enctype="multipart/form-data">
        
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-group">
        <label>Kode Tagihan</label>
        <input type="text" class="form-control"  placeholder="ID Tagihan" name="orderid" value="<?php if(isset($orderid)){ echo $orderid; } ?>" required>
        </div>
        
        <div class="form-group">
        <label>Nama Akun Bank</label>
        <input type="text" class="form-control"  placeholder="Nama Akun Bank" name="bankaccount" value="{{ old('bankaccount') }}" required>
        </div>
        <div class="form-group">
        <labeL>Bank</label>
            <select name="bank" class="form-control">
                <option value="bca">BCA</option>
            </select>
        </div>
        
        <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control"  placeholder="Email" name="email" value="{{ old('email') }}" required>
        </div>
        
        <div class="form-group">
        <label>Tanggal Transfer</label>
        <input type="text" class="form-control"  placeholder="dd-mm-yyyy" name="transferdate" data-provide="datepicker" value="{{ old('transferdate') }}" required>

        </div>
        
        <div class="form-group">
        <label>Jumlah Transfer</label>
        <input type="text" class="form-control"  placeholder="Jumlah Transfer" name="transferammount"  value="{{ old('transferammount') }}" required>
        </div>

        
        <div class="form-group">
        <label>Catatan</label>
            <textarea class="form-control" style="resize: vertical;" name="notes">{{ old('notes') }}</textarea>
        </div>
        <div class="form-group">
        <label for="">Bukti Transfer</label>
        <input type="file" name="image" required>
        <p class="help-block">Lampirkan bukti pembayaran.</p>
        </div>
      
        <button type="submit" class="btn btn-primary pull-right btn-flat">Kirim</button>
    </form>
    </div>  
</div><!--./container-->
@endsection
