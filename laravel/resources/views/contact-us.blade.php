@extends('app')

@section('content')

<div class="main-area container">

{{--   <ul class="breadcrumb">
    <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
    <li class="active">Contact Us</li>
<<<<<<< HEAD
  </ul>
  <iframe height="300px" width="100%" src="{{$config->map_url}}" name="iframe_a"></iframe>
=======
  </ul> --}}
  <!-- <iframe height="300px" width="100%" src="{{$config->map_url}}" name="iframe_a"></iframe> -->
>>>>>>> master
  <div style="padding: 20px 0px;">
    <!--Address-->
    <div class="adrss col-md-6" >
      <a href="{{ url('/') }}" class="bottom-logo">
        <img src="{{ asset('/img/logo.png') }}" width="160" alt="logo.png"></a>
        <br>
        <address>
          <strong><i class="icon ion-ios-home-outline"></i> <a href="{{ url('/') }}">{{ $config->url}}</a></strong><br>
          {{ $config->companyname}}<br>

          Head Office<br>
          <?php
          echo nl2br($config->address, false);
          ?>
          <br>
          <i class="icon ion-ios-telephone-outline"></i> {{ $config->telephone}}
        </address>

      </div>
      <!--./Address-->

      <!--Quick Message-->
      <div class="col-md-5 col-sm-12"  id="sendmessage">
        <h5><strong>QUICK MESSAGE</strong></h5>

        <form id="form-message" method="GET" action="{{ url('sendmessage') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div id="send-contact-success" style="display: none;" class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Pesan Berhasil dikirim
          </div>

          <div class="form-group">
            <input id="msg_name" type="text" class="form-control input-flat" placeholder="Name" name="msg_name" required>
          </div>
          <div class="form-group">
            <input id="msg_email" class="form-control input-flat" placeholder="Email Address / Phone Number" name="msg_email" required>
          </div>
          <div class="form-group">
            <textarea id="msg_message" class="textarea-quick-message form-control input-flat" placeholder="Message" name="msg_message" required></textarea>
          </div>
          <button id="sub" type="submit" class="btn btn-default pull-right">Send Message</button>
        </form>
      </div>
      <!--./Quick Message-->
    </div>
  </div>
</div>
<!-- <script>
function initialize() {
  var mapProp = {
    center:new google.maps.LatLng(51.508742,-0.120850),
    zoom:5,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script> -->
@endsection
