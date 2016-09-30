@extends('app')

@section('content')

<div class="main-area container ">
    <div class="col-md-6">
         <h3>Pendaftaran</h3>

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
          <button type="submit" class="btn btn-warning">Daftar</button>
        </form>
          <hr>
        <!-- <center> -->
           Sudah mendaftar ? Silahkan <a href="{{ url('/login') }}" class="link"><b>Masuk</b></a>
        <!-- </center> -->
  </div>
</div>
@endsection
