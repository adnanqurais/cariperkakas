@extends('app')

@section('content')  
<div class="main-area container">
    @if(Session::has('error_must_login'))
    <div class="alert alert-warning">{!! session('error_must_login') !!}</div>
    @endif
    
    <div class="col-md-6 col-md-push-3 col-sm-12">
<<<<<<< HEAD
        <h3 class="text-center">Masuk Cariperkakas</h3>
=======
        <h3 class="text-center">MASUK</h3>
        <img src="{{ asset('/img/logo.png') }}" alt="logo" style="height: 52px; width: 250px; display: block; margin: 0 auto;" align="center">
>>>>>>> 6e1fafa366c27e6e6394b28a02ffa266b761c99c
        {{ Session::get('KeyLogin')}}
         <form action="{{ url('login') }}" method="post">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control  input-flat" id="exampleInputEmail1" placeholder="Email" name="email" >
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Kata Sandi</label>
            <input type="password" class="form-control input-flat" id="exampleInputPassword1" placeholder="Kata Sandi" name="password">
          </div>
<<<<<<< HEAD
          <button type="submit" class="btn btn-primary  ">Masuk</button>
=======
          <button type="submit" class="btn btn-primary">Masuk</button>
>>>>>>> 6e1fafa366c27e6e6394b28a02ffa266b761c99c
             &nbsp; atau
           <a href="{{ url('/register') }}" class="btn btn-link">Mendaftar</a>
        </form>

    </div>
</div>


@endsection
