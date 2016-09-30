@extends('app')

@section('content')  
<div class="main-area container">
    @if(Session::has('error_must_login'))
    <div class="alert alert-warning">{!! session('error_must_login') !!}</div>
    @endif
    
    <div class="col-md-6">
        <h3>Masuk</h3>
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
        
          <!--<div class="checkbox">
            <label>
              <input type="checkbox"> Ingatkan Saya
            </label>
          </div>-->
          <button type="submit" class="btn btn-warning">Masuk</button>
             &nbsp; atau
           <a href="{{ url('/register') }}" class="btn btn-link">Mendaftar</a>
        </form>
    </div>
</div>


@endsection
