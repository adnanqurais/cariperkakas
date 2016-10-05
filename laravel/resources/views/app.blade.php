<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Cari Perkakas</title>


	<!--CSS-->
	<link href="{{ asset('template/frontend/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('template/frontend/css/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('template/frontend/css/menu-vertical.css') }}" rel="stylesheet">
	<link href="{{ asset('template/frontend/css/category-top-hover.css') }}" rel="stylesheet">
	<link href="{{ asset('template/frontend/css/media-screen.css') }}" rel="stylesheet">
	<link href="{{ asset('template/frontend/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('template/frontend/css/sidebar.css') }}" rel="stylesheet">
	<link href="{{ asset('template/frontend/css/box-category.css') }}" rel="stylesheet">
	<link href="{{ asset('template/frontend/css/menu-footer.css') }}" rel="stylesheet">
	<link href="{{ asset('template/frontend/css/checkout-tab-style.css') }}" rel="stylesheet">
	<link href="{{ asset('template/frontend/css/font-awesome-4.6.3/css/font-awesome.css') }}" rel="stylesheet">
	<link href="{{ asset('template/frontend/css/nav-wizard.bootstrap.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('template/admin/dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/admin/dist/css/skins/_all-skins.css') }}">
	<!--<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>-->
	<!-- Owl Carousel -->
	<link href="{{ url('template/frontend/css/owl.carousel.css') }}" rel="stylesheet">
	<link href="{{ url('template/frontend/css/owl.theme.css') }}" rel="stylesheet">
	<!--Product grid  -->
	<link href="{{ asset('template/frontend/css/product-grid.css') }}" rel="stylesheet">
	<!--icon-->
	<link href="{{ url('http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}" rel="stylesheet">
	<!--Grid-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/gridlex/2.0.8/gridlex.min.css" rel="stylesheet">

	<!--Pagination -->

	<link rel="stylesheet" href="{{ url('template/frontend/css/pagination/style.css') }}">
	<link rel="stylesheet" href="{{ url('template/frontend/css/pagination/jPages.css') }}">
	<link rel="stylesheet" href="{{ url('template/frontend/css/pagination/animate.css') }}">
	<link rel="stylesheet" href="{{ url('template/frontend/css/pagination/github.css') }}">
	<link rel="stylesheet" href="{{ url('template/frontend/css/perfect-scrollbar.min.css') }}">

	<!-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
	<!-- jQuery 2.1.4 -->
	<script src="{{ asset('template/admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

	<style>
	/*.toppromo > .owl-carousel {
			display: none;
			position: none !important;
			width: auto;
	}*/
	#toppromo .owl-example > .owl-wrapper-outer {
	    overflow: hidden !important;
	    position: relative !important;
	    width: auto !important;
	}
	.navbar-form{
		margin-top: 0px;
	}
	.affix {
		top: 0;
		width: 100%;
		z-index: 8;
		-webkit-transition: all .5s ease-in-out;
		transition: all .5s ease-in-out;
		max-height: 60px;
		padding: 0px;
		z-index: 999;
	}
	.affix .logo{
		width: 120px;
	}
	.affix .navbar-left {
		padding-top: 5px;
	}
	.affix .navbar-nav{
		padding-top: 5px;
	}
	.affix-top {
		position: static;
		top: -35px;
	}
	.affix + .container {
		padding-top: 100px;
	}

	.category-banner-slider .item img{
		display: block;
		width: 100%;
	}

     .appCategory {
         max-height: 200px;
         list-style: none;
         overflow-y: scroll;
         position: relative;
     }
	</style>

	<style>
	@media screen and (max-width: 900px) {
		.table-rotation {
			border: 0;
		}
		.table-rotation thead,tfoot {
			display: none;
		}
		.table-rotation tr {
			margin-bottom: 10px;
			display: block;
			border-bottom: 2px solid #ddd;
		}
		.table-rotation td {
			display: block;
			text-align: right;
			font-size: 13px;
			border-bottom: 1px dotted #ccc;
		}
		.table-rotation td:last-child {
			border-bottom: 0;
		}
		.table-rotation td:before {
			content: attr(data-label);
			float: left;
			text-transform: uppercase;
			font-weight: bold;
		}
	}
	</style>

	<!--<link href="{{ url('template/frontend/js/google-code-prettify/prettify.css') }}" rel="stylesheet">-->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Le fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
	<!--<link rel="shortcut icon" href="../assets/ico/favicon.png">-->

	<style>
	#owl-brands{
		margin-bottom: 3%;
	}
	#owl-brands .item{
		display: block;
		padding: 10px 0;
		/*margin: 15px;*/
		color: #FFF;

		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		text-align: center;
	}
	.owl-theme .owl-controls .owl-buttons div {
		padding: 5px 9px;
	}

	.owl-theme .owl-buttons i{
		margin-top: 2px;
	}

	/*To move navigation buttons outside use these settings:*/

	.owl-theme .owl-controls .owl-buttons div {
		position: absolute;
		background: none;
	}

     .loadingGif {
         position: fixed;
         left: 0px;
         right: 0px;
         width: 100%;
         height: 100%;
         z-index: 1000000;
         background:50% 50% no-repeat rgba(255,255,255,0.4);
     }
     .loadingGif i {
         position: fixed;
         top: 50%;
         left: 50%;
         margin-top: -21px;
         margin-left: -21px;
         color: #1DB7EB;
     }
	</style>
</head>
<body style="font-family: 'Lato', sans-serif;">

<div class="loadingGif"><i class="fa fa-spinner fa-spin fa-3x"></i></div>
	<!--<div class="loading" id="loading">
	<img src="{{ asset('img/loading.gif') }}" alt="loading">
</div>-->



<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
<div class="web-header">
<!--Top Promo-->
<?php echo toppromo(); ?>
<!--./Top Promo-->


<!--Top Menu-->
<div id="top-menu" class="top-menu" style="">
	<div class="clearfix col-lg-11 col-md-12 col-sm-12 col-centered" style="z-index: 999; padding-bottom: 0px;">


		<div class="col-sm-6 pull-left"  style="padding-bottom: 0px;">
			<ul class="list-inline ">

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">CICILAN 0%
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li>
								<div style ="width: auto; padding: 10px; text-align: center;">
									Cicilan 0% selama 6 dan 12 bulan dari beragam bank pilihan
								</div>
							</li>
						</ul>
					</li>
					
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"> GRATIS PENGIRIMAN
							<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li>
									<div style ="width: auto; padding: 10px; text-align: center;">
										Gratis Pengiriman ke seluruh wilayah Indonesia
									</div>
								</li>
							</ul>
						</li>
						|
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">24/7 PELAYANAN PELANGGGAN
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li>
										<div style ="width: auto; padding: 10px; text-align: center;">
											24/7 Customer Care siap membantu Anda selama 24 jam dari hari Senin sampai Minggu
										</div>
									</li>
								</ul>
							</li>

						</ul>
					</div>
					<div class="col-sm-6" style="text-align:right; padding-bottom: 0px;">
						<ul class="list-inline ">
							<li><a  href="{{ url('page/Panduan-Belanja') }}"> Panduan Cariperkakas.com </a></li>    |
							<li><a  href="{{ url('payment-confirmation') }}"> Pembayaran </a></li>    |
							<li><a  href="{{ url('account/invoice') }}"> Status Pesanan</a></li>    |
							<li><a  href="{{ url('contact-us') }}"> Contact Us</a></li>
						</ul>
					</div>
				</div>
			</div>

			<nav id="navbar" class="navbar navbar-default">
				<div class="container"  >
					<!-- Brand and toggle get grouped for better mobile display  -->
					<div class="navbar-header">
						<a href="#menu-toggle" id="mobile-toggle-btn" class="menu-toggle mobile-toggle btn btn-default pull-left  hidden-lg hidden-md" ><i class="icon ion-android-menu"></i></a>

						<a class="navbar-brand" href="{{ url('/') }}" style="padding-top:10px; padding-bottom:10px;"><img class="logo" src="{{ asset('/img/logo.png') }}" alt="logo"></a>

						<a href="{{ url('cart') }}" class="mobile-bag navbar-brand pull-right"><i style="font-size: 32;" class="icon ion-bag"></i><span class="mobile-bag-badge badge"><small><?php echo Cart::count(false);  ?></small></span></a>
						<a href="#" class="mobile-search navbar-brand pull-right" data-toggle="collapse" data-target="#searchcollapse"><i style="font-size: 20px; color: #999;" class="icon ion-search"></i></a>
						<!--<a class="mobile-search navbar-brand navbar-right" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><i class="icon ion-search"></i></a>
					-->
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="searchcollapse">
					<form class="form-inline navbar-form navbar-left" role="search" action="{{ url('product/search') }}" method="post" style="padding-top:25px !important;">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<input id="search-keyword" type="text" class="form-control input-md" placeholder="Cari Produk" name="keyword" required>
						</div>
                        <button type="submit" class="button-search btn btn-md flat"><i class="icon ion-search"></i></button>
					</form>
				</ul>

				<ul class="dekstop-top-right nav navbar-nav navbar-right" style="padding-top:15px;">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon ion-bag" style="font-size:20px; margin-top: -30px;"></i><span id="cart_count" class="badge" style="margin-top: -30px; margin-left:-15px; #fff; background-color: #17B7EB;"><?php echo Cart::count(false);  ?></span>
						</a>
						<ul class="dropdown-menu" style="width: auto;">
							  <div class="shopping-cart" >
							    <ul class="shopping-cart-items" id="Demo">
							    <?php foreach($cart as $row) :?>
							      <li class="clearfix">
							        <img src="{{asset('img/product/thumb/'.$row->options->image)}}" alt="item1" />
							        <span class="item-name"><?php echo $row->name;?></span>
							        <span class="item-price price_format"><?php echo $row->subtotal;?></span>
							        <span class="item-quantity">Quantity: <?php echo $row->qty;?></span>
							      </li>
							  <?php endforeach;?>
							    </ul>

							    <a href="{{ url('cart') }}" class="btn btn-flat btn-primary btn-block">Lihat Semua</a>
							  </div> <!--end shopping-cart -->
							</ul>
						</li>
						<?php if(Session::get('sessionmember')){?>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo Session::get('membername');?>
									<span class="caret"></span></a>
									<ul class="dropdown-menu">

										<li><a href="{{ url('account/profile') }}">Profile</a></a></li>
										<li><a href="{{ url('account/invoice') }}">Pesanan</a></a></li>
										<li><a href="{{ url('logout') }}">Keluar</a></li>
									</ul>
								</li>
								<?php }else{?>
									<li><a href="{{ url('login') }}" ><i class="icon ion-ios-contact-outline"></i> Masuk </a> </li>
									<li><a href="{{ url('register') }}"><i class="icon ion-ios-contact-outline sr-only"></i>Daftar</a></li>
									<?php } ?>
								</ul>
							</div><!-- /.navbar-collapse-->
						</div><!-- /.container -->
					</nav>

				</div>


					<div id="wrapper">
						<!-- Sidebar -->
						<div id="sidebar-wrapper">

							<ul class="sidebar-nav">
								<li>
									<a class="menu-toggle mobile-toggle" style="width:100%; margin-left:0;font-size:11pt; text-align:right; padding-right:9%;"><i class="fa fa-angle-left fa-lg" aria-hidden="true" style="padding-top:5%; float:left;"></i>Tutup</a>
								</li>
								<li>
									<?php if(!Session::get('sessionmember')){?>
										<a href="{{ url('login') }}">
											<i class="fa fa-user" aria-hidden="true" style="display: inline"></i> &nbsp;Masuk / Daftar
										</a>
										<?php }else{ ?>
											<a href="{{ url('account/profile') }}">
												<i class="icon ion-ios-person-outline"></i>Hi,<?php echo Session::get('membername');?>
											</a>
											<?php } ?>
										</li>
										<li>
											<a href="{{ url('/') }}">Halaman Awal</a></a>
										</li>
										<li>
											<a class="collapsed" data-toggle="collapse" data-target="#appCategory" href="#">Kategori</a>
                                            <?php echo CategoryMobileView(); ?>
										</li>
										<li>
											<a href="{{ url('account/invoice') }}">Cek Status Pesanan</a>
										</li>
										<li>
											<a href="#ComingSoon">Contact Us</a>
										</li>
									</hr>
									<li>
										<a href="{{ url('page/Panduan-Belanja') }}">Panduan</a>
									</li>

									<?php if(Session::get('sessionmember')){?>
										<li>
											<a href="{{ url('#sendmessage') }}">Keluar</a>
										</li>
										<?php } ?>

									</ul>
								</div>
								<!-- /#sidebar-wrapper -->

								<!-- Page Content -->
								<div id="page-content-wrapper">
									<div class="overlay-back"></div>

									<!-- <input type="text" id="scroll"> -->

									<div class="web-content">
										<!-- Category top Hover-->

										<div class="categorytophover container">
											<div class="row" style="margin-top: -40px;">
												<ul class="level-1">
													<li><a id="catMobileHead" href="#">KATEGORI BELANJA  <span class="caret"></span></a>
														<?php echo AllMenuCategory();?>
													</li>
												</ul>
											</div>
										</div>
										<!--./Category top hover-->
										@yield('content')
									</div>
									<!--Brand-->
									<div class="container">
										<h3 class="featured-brand text-center">FEATURED BRAND & STORES</h3>
										<div id="owl-brands" class="owl-theme-brands" <?php if($brands[0]->logo == NULL){ echo "style='visibility:hidden;'";}?>>
											@foreach ($brands as $brand)
											<div class="item"><img src="{{ url('img/brand/'.$brand->logo.'')}}" width="180" alt="{{ $brand->logo}}" data-toggle="tooltip" title="{{ $brand->name }}"/></div>
											@endforeach
										</div>
									</div>
									<!--./Brand-->



									<!--Bootom-->
									<div class="bottom">
										<div class="container">
											<!--bottom rows 1-->
											<div class="row">
												<!--Address-->
												<div class="adrss col-md-3" >
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

													<!--ICONIC-->
													<div class="col-md-2 col-sm-6">
														<h5><strong>MENU</strong></h5>
														<?php echo bottom1(); ?>

													</div>
													<div class="col-md-2 col-sm-6">
														<h5><strong>COSTUMER SERVICE</strong></h5>
														<?php echo bottom2(); ?>
													</div>
													<!--./ICONIC-->

													<!--Quick Message-->
													<div class="col-md-5 col-sm-12"  id="sendmessage">
														<h5><strong>QUICK MESSAGE</strong></h5>

														<form id="form-message" method="GET" action="{{ url('sendmessage') }}">
															<input type="hidden" name="_token" value="{{ csrf_token() }}">

															<div id="send-contact-success" style="display: none;" class="alert alert-success">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Pesan Berhasil dikirim
															</div>

															<div class="form-group col-sm-6 col-xs-6">
																<input id="msg_name" type="text" class="form-control input-flat text-message" placeholder="Name" name="msg_name" required>
															</div>
															<div class="form-group col-sm-6 col-xs-6">
																<input id="msg_email" class="form-control input-flat text-message" placeholder="Email Address" name="msg_email" required>
															</div>
															<div class="form-group col-sm-12 ">
																<textarea id="msg_message" class="textarea-quick-message form-control input-flat text-message" placeholder="Message" name="msg_message" required></textarea>
															</div>
															<button id="sub" type="submit" class="btn pull-right btn-send">Send Message</button>
														</form>
													</div>

													<!--./Quick Message-->
												</div>
												<!--bottom rows 2-->



												<div class="row">
													<!--bottom Link-->

													<!--Facebook | Whatsapp | Line -->
													<div class="col-md-2"><h5>FOLLOW US</h5></div>
													<div class="col-md-2">
														<table>
															<tr>
																<td><a href="http://www.facebook.com/{{ $config->facebook}}" target="_blank"><img src="{{ asset('/img/bottom/logo-facebook.png') }}" alt="logo-facebook" width="40"></a></td>
																<td>&nbsp;  <a href="http://www.twitter.com/{{ $config->twitter}}" target="_blank"><img src="{{ asset('/img/bottom/logo-whatsapp.png') }}" alt="logo-whatsapp" width="30"></a> </td>
																<td>&nbsp;  <a data-toggle="popover" data-content="{{ $config->line}}" ><img src="{{ asset('/img/bottom/logo-line.png') }}" alt="logo-line" width="30"></a>  </td>
															</tr>
														</table>
													</div>
													<!--./Facebook | Whatsapp | Line -->


													<!--Master Card | Visa| BCA -->
													<div class="col-md-2"><h5>PAY METHODS</h5></div>
													<div class="col-md-2">
														<table>
															<tr>
																<td> <img src="{{ asset('/img/bottom/logo-mastercard.png') }}" alt="logo-mastercard" width="50"></td>
																<td> <img src="{{ asset('/img/bottom/logo-visa.png') }}" alt="logo-visa" width="50"></td>
																<td> <img src="{{ asset('/img/bottom/logo-bca.png') }}" alt="logo-bca" width="50">  </td>
															</tr>
														</table>
													</div>
													<!--./Master Card | Visa| BCA -->


													<!--JNE -->
													<div class="col-md-3"><h5>DELIVERY SERVICE</h5></div>
													<div class="col-md-1">
														<table>
															<tr>
																<td><img src="{{ asset('/img/bottom/logo-jne.png') }}" alt="logo-jne" width="50"></td>
															</tr>
														</table>
													</div>
													<!--./JNE-->
													<!--./bottom Link-->
												</div>
											</div>
										</div>
										<!--./Bootom-->

										<!--Footer-->
										<div class="footer">
											<p class="text-center">Copyright &copy; 2016 {{ $config->url}}</p>
											<p class="text-center">All Right Reserved.</p>
										</div><!--./Footer-->

									</div><!-- /#page-content-wrapper -->
								</div><!-- /#wrapper -->

		<!--Jquery-->
		<script type="text/javascript" src="{{ asset('template/frontend/js/jquery.elevatezoom.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template/frontend/js/jquery.hoverIntent.minified.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template/frontend/js/jquery.dcverticalmegamenu.1.3.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template/frontend/js/jquery.price_format.2.0.js') }}"></script>
        <script type="text/javascript" src="{{ asset('template/frontend/js/jquery.unveil.js') }}"></script>
		<!-- App Java Scripts -->
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{{ asset('template/frontend/js/owl.carousel.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template/frontend/js/bs_leftnavi.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template/frontend/js/slider.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template/frontend/js/app.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template/frontend/js/bootstrap-datepicker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('template/frontend/jquery-lazyload/jquery.lazyload.js') }}"></script>
        <script type="text/javascript" src="{{ asset('template/frontend/jquery-lazyload/jquery.scrollstop.js') }}"></script>
        <script type="text/javascript" src="{{ asset('template/frontend/js/perfect-scrollbar.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('template/frontend/js/perfect-scrollbar.jquery.min.js') }}"></script>

		<script src="http://maps.googleapis.com/maps/api/js"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('template/admin/dist/js/app.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('template/admin/dist/js/app.min.js') }}"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="{{ asset('template/admin/dist/js/demo.js') }}"></script>
		   <script>
		   	$(function() {
		    $('#Demo').perfectScrollbar();

			});
		   </script>
		<script>
		    //$(document).ready(function () {
		    $.ajaxSetup({
			    headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
		    });


		    function carttotal() {
			    //var token = $('#token').val();
			    //var dataString = '_token=' + token;

			    //$.get("{{ url('ajax/carttotal') }}", function(data){

			    //    $('#carttotal').html(data);

			    //});

			    //$('#carttotal').load(location.href+ '#carttotal');
			    settimeout();
		    }
		</script>

		<script>
      $(document).ready(function() {
          $('.lazy').lazyload({
              effect: "fadeIn"
          });
          $('[data-toggle="popover"]').popover();
          //Contact Us
          $("#form-message").submit(function(e) {
              e.preventDefault();
              //var username = $("input#username").val();
              //var token =  $("input[name=_token]").val();
              //var dataString = 'username='+username+'&token='+token;
              $.ajax({
                  type: "POST",
                  url: $(this).attr('action'),
                  data: $(this).serializeArray(),
                  start: function(data) { $('.loadingGif').show(200); },
                  success: function(data) {
                      $('#send-contact-success').fadeIn();
                      document.getElementById("form-message").reset();
                      $('#send-contact-success').fadeOut(8000);
                      $('.loadingGif').hide(200);
                  }
              }, "json");
          });

          //Category View Slider
          $(".category-banner-slider").owlCarousel({

              navigation: true, // Show next and prev buttons
              slideSpeed: 300,
              paginationSpeed: 400,
              autoPlay: 3000, //Set AutoPlay to 3 seconds
              stopOnHover: true,
              navigationText: [
                    "<i class='icon ion-ios-arrow-left' style=\"font-size:30px;\"></i>",
                    "<i class='icon ion-ios-arrow-right' style=\"font-size:30px;\"></i>",
                ],
              singleItem: true,
              pagination: false,
              // "singleItem:true" is a shortcut for:
              // items : 1,
              // itemsDesktop : false,
              // itemsDesktopSmall : false,
              // itemsTablet: false,
              // itemsMobile : false
      });
              //Price Format
              $('.price_format').priceFormat();


          }); //end of document ready function
       </script>



        <script>
            $(window).load(function() {
                $('.loadingGif').fadeOut("normal");
            });
            $(document).ready(function() {

                $(document).ajaxStart(function() {
                    $('.loadingGif').show();
                })
                .ajaxStop(function() {
                    $('.loadingGif').fadeOut("normal");
                })
                .ajaxComplete(function() {
                    $('.loadingGif').fadeOut("normal");
                })
                .ajaxError(function() {
                    $('.loadingGif').fadeOut("normal");
                })
                .ajaxSuccess(function() {
                    $('.loadingGif').fadeOut("normal");
                });

                resizeHomeCatePad();

                // $('#province').load(base_url + 'ajax/shippingprovince');
                // $('#city').load(base_url + 'ajax/shippingcity');
                // $('#subdistrict').load(base_url + 'ajax/shippingsubdistrict');

                // $('#cost').load(base_url + 'ongkir/get_cost', function () {
                //     $('.money').priceFormat({
                //         prefix: '',
                //         thousandsSeparator: '.',
                //         centsLimit: 0
                //     });
                // });
            });
		</script>


		<script type="text/javascript">
		$('#paymentOption').on('change', function () {
			//var value = $("input[name=payment]:checked").val();
			if ($("input[name=payment]:checked").val() == "transfer") {
				$("div#bankList").show("slow");
				$("div#creditcard").fadeOut("medium");
				$("#paymentMethod").val($("input[name=payment]:checked").val());
				//alert($("#paymentMethod").val());
				//alert("transfer");
			} else if ($("input[name=payment]:checked").val() == "creditcard") {
				$("div#creditcard").show("slow");
				$("div#bankList").fadeOut("fast");
				$("#paymentMethod").val($("input[name=payment]:checked").val());
				//alert("creditcard");
			}
		});

		</script>


		<script type="text/javascript">
		// // UNTUK TOP NAVBAR MOBILE START
		// 			var nav = $('.navigation-wrapper');
		//       var nav2 = $('nav');
		//       var nav3 = $('.menutop');
		//       var logo = $('.navbar-brand img');
		//       var content = $('.all-content');
		//       $(window).scroll(function () {
		//           var w = $(window).width();
		//           if (w > 992) {
		//               if ($(this).scrollTop() > 100) {
		//
		// 								  // // nav.css("top", "-50px");
		//                   // nav2.css("padding-top", "5px");
		//                   // nav2.css("padding-bottom", "5px");
		//                   // nav3.css("display", "none");
		//                   // logo.css("width", "95");
		//                   // content.css("padding-top", "133px");
		//               } else {
		//                   // // nav.css("top", "0px");
		//                   // nav2.css("padding-top", "25px");
		//                   // nav2.css("padding-bottom", "25px");
		//                   // nav3.css("display", "block");
		//                   // logo.css("width", "170");
		//               }
		//           }
		//       });
		//UNTUK TOP NAVBAR MOBILE START
		//var _gaq = _gaq || [];
		//_gaq.push(['_setAccount', 'UA-28718218-1']);
		//_gaq.push(['_trackPageview']);
		//(function() {
		//  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		//  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		//  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		//})();
		</script>
        <script>
            var nav = $('.navbar');
            var nav1 = $('#navbar > .container');
            var imgWidth = $('.navbar-brand img').width();
            var content = $('.all-content');
            var topMenu = $('#top-menu');
            $(window).scroll(function () {
                var w = $(window).width();

                $('#scroll').val($(this).scrollTop());
                if (w > 992) {
                    if ($(this).scrollTop() > 99) {
                        nav1.css("padding-bottom", 0);
                        nav1.css("padding-top", 0);
                        $('.navbar-brand img').css("width", imgWidth * (90 / 100));
                        topMenu.slideUp("slow");
                    } else {
                        $('.navbar-brand > img').css("width", 250);
                        topMenu.slideDown("slow");
                    }
                }
            });
            function changePadTop() {
                var content = $('.web-content');
                var sideBar = $('.sidebar-nav');
                var pad = content.css("padding-top");
                var sideBarPad = sideBar.css("padding-top");

                var pad_f = parseInt(pad) - parseInt(44);
                var pad_f2 = parseInt(sideBarPad) - parseInt(40);
                content.css("padding-top", pad_f);
                sideBar.css("padding-top", pad_f2);
            }
            $(window).load(function () {
              var promo = $('#toppromo');
                // alert($('#top-menu').height());
                if (!promo.hasClass('in')) {
                    changePadTop();
                }
            });
            $('#topPromoBtn').click(function () {
                changePadTop();
            });
	    </script>
    <script>
        $('#catMobileHead').click(function() {
            var check1 = $(window).width();
            if( check1 <= 1200) {
                $('.level-2').toggle();
            }
        });
        $(window).resize(function() {
            resizeHomeCatePad();
        });

        function resizeHomeCatePad() {
            var winWid = $(window).width();
            var contentA = $('.dekstop-category');
            var menuContent = $('.level-1 li ul.level-2');
            if(winWid <= 1450 && winWid > 1400) {
                contentA.css("margin-top", 60);
            } else if(winWid <= 1400 && winWid > 1350) {
                contentA.css("margin-top", 90);
            } else if(winWid <= 1350 && winWid > 1300) {
                contentA.css("margin-top", 105);
            } else if(winWid <= 1300 && winWid > 1250) {
                contentA.css("margin-top", 125);
            } else if(winWid <= 1250 && winWid > 1200) {
                contentA.css("margin-top", 138);
            } else if(winWid > 1450) {
                contentA.css("margin-top", 50);
            } else if(winWid <= 1200) {
                contentA.css("margin-top", 20);
                menuContent.css("display", "none");
            }
        }
   </script>
    </body>
</html>
