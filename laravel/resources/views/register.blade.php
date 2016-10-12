@extends('app')

@section('content')

<div class="main-area container ">
    <div class="col-md-6 col-md-push-3 col-sm-12">
         <h3 class="text-center">PENDAFTARAN</h3>
         <!-- NOTIFICATION LIST START -->
          @if(Session::has('emailalready'))
              <div class="alert alert-warning">{{ Session::get('emailalready') }}</div>
          @endif

          @if(Session::has('notmatch'))
              <div class="alert alert-danger">{{ Session::get('notmatch') }}</div>
          @endif
          <!-- NOTIFICATION LIST END -->
         <form action="{{ url('register') }}" method="post">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
           <div class="form-group">
            <label for="exampleInputEmail1">Nama Pengguna</label>
            <input type="text" class="form-control input-flat" placeholder="Nama Pengguna" name="username" value="{{ old('username') }}" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Lengkap</label>
            <input type="text" class="form-control input-flat" placeholder="Nama Lengkap" name="fullname" value="{{ old('fullname') }}" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control input-flat"  placeholder="Email" name="email" value="{{ old('email') }}"  required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Kata Sandi</label>
            <input type="password" class="form-control  input-flat"  placeholder="Kata Sandi" name="password" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Ulangi Kata Sandi</label>
            <input type="password" class="form-control  input-flat"  placeholder="Konfirmasi Kata Sandi" name="passwordconfirm" required>
          </div>
          <div class="form-group">
            <input type="checkbox"> <b>Saya setuju dengan <a href="#" data-toggle="modal" data-target="#t_and_c_m" id="btn-t-c">terms & condition</a> Cariperkakas.com</b>
          </div>
          <button type="submit" class="btn btn-primary btn-block btn-flat" pull-right>Daftar</button>
        </form>
          <hr>
        <!-- <center> -->
           Sudah mendaftar ? Silahkan <a href="{{ url('/login') }}" class="link"><b>Masuk</b></a>
        <!-- </center> -->
  </div>
</div>
<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-md" style="margin:10% auto;">
        <div class="modal-content">
            <div class="modal-header">
                <a type="button" class="close hide-t-c" aria-hidden="false" data-dismiss="modal">×</a>
                <h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
            </div>
            <div class="modal-body">
                <p>Bootstrap is a free and open-source collection of tools for creating websites and web
                   applications. It contains HTML- and CSS-based design templates for typography, forms, buttons,
                   navigation and other interface components, as well as optional JavaScript extensions. As of March
                   2015, it was the most-starred project on GitHub.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary hide-t-c" aria-hidden="false" data-dismiss="modal">I Agree</button>
            </div>
        </div>
    </div>
</div>

@endsection
