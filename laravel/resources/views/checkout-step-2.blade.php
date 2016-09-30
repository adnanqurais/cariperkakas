@extends('app')

@section('content')  
<div class="main-area container">
    
    <ul class="breadcrumb">
        <li><a href="#"><i class="icon ion-ios-home"></i></a></li>
        <li class="active">Checkout</li>
    </ul>    

	<div class="row form-group">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                <li class="active"><a href="{{ url('checkout/step-1')}}">
                    <h4 class="list-group-item-heading">Pengiriman</h4>
                    <p class="list-group-item-text">Lorem ipsum dolor sit amet,</p>
                </a>
                </li>
                <li class="active"><a href="{{ url('checkout/step-2')}}">
                    <h4 class="list-group-item-heading">Selesai</h4>
                    <p class="list-group-item-text">Lorem ipsum dolor sit amet,</p>
                </a>
                </li>
                <!--<li class="disabled"><a href="{{ url('checkout/step-3')}}">
                    <h4 class="list-group-item-heading">Selesai</h4>
                    <p class="list-group-item-text">Lorem ipsum dolor sit amet,</p>
                </a></li>-->
            </ul>
        </div>
	</div>
    <div class="row setup-content text-center">
                <h3>Selesai</h3>
                <a href="{{ url('checkout/done') }}" class="btn btn-primary">Selesai</a>
           
    </div>
</div>
@endsection
