<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cari Perkakas</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('template/admin/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/admin/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('template/admin/dist/css/skins/_all-skins.css') }}">

    <link rel="stylesheet" href="{{ asset('template/admin/plugins/colorpicker/bootstrap-colorpicker.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables/dataTables.bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datepicker/datepicker3.css') }}">

      <!-- MultiSelect -->
    <link rel="stylesheet" href="{{ asset('template/admin/dist/css/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/dist/css/select2.css') }}">

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('template/admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
.loadingGif {
    position: fixed;
    left: 0px;
    right: 0px;
    width: 100%;
    height: 100%;
    z-index: 1000000;
    background:50% 50% no-repeat rgba(255,255,255,0.4);
}
.loadingGif img {
    position: fixed;
    top: 50%;
    left: 50%;
    margin-top: -21px;
    margin-left: -21px;
    color: #1DB7EB;
}
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


@media screen and (min-width: 900px) {
        .table-rotation td {
            vertical-align: middle !Important;
        }
}
</style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('admin/') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>ADM</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">Cari Perkakas</span>

        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle hidden-md hidden-lg hidden-sm" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -
                    <ul class="menu">
                      <li><!-- start message
                        <a href="#">
                          <div class="pull-left">
                            <!--<img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!--<img src="<i ../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                    <i class="icon ion-ios-person-outline" style="font-size: 21px;"></i>
                  <span class="hidden-xs">&nbsp;</span>
                </a>
                <!--<ul class="dropdown-menu">
                  <!-- User image
                  <li class="user-header">
                    <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                      Alexander Pierce - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>-
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="{{ url('admin/logout') }}">Logout <i class="icon ion-log-in"></i></a>
                <!--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header ">MAIN NAVIGATION</li>

            <li class=""><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-smile-o"></i> <span>Order</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('admin/order/new') }}"><i class="fa fa-circle-o"></i> New Order</a></li>
                <!--<li><a href="{{ url('admin/order/add') }}"><i class="fa fa-circle-o"></i> Add Order</a></li> -->
                <li><a href="{{ url('admin/order/history') }}"><i class="fa fa-circle-o"></i>  History Order</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-check-square-o"></i> <span>Payment Confirmation</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('admin/payment/new') }}"><i class="fa fa-circle-o"></i> New Payment</a></li>
                <li><a href="{{ url('admin/payment/history') }}"><i class="fa fa-circle-o"></i>  History Payment</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-envelope"></i> <span>Messages</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('admin/inbox') }}"><i class="fa fa-circle-o"></i> Inbox</a></li>
                <!--<li><a href="{{ url('admin/inbox/compose') }}"><i class="fa fa-circle-o"></i> Compose Mail</a></li>   -->
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bullhorn"></i><span>Promotion</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('admin/voucher') }}"><i class="fa fa-circle-o"></i> Voucher</a></li>
                <li><a href="{{ url('admin/promo') }}"><i class="fa fa-circle-o"></i> Promo</a></li>
                <li><a href="{{ url('admin/discount') }}"><i class="fa fa-circle-o"></i> Discount</a></li>
                <li><a href="{{ url('admin/others') }}"><i class="fa fa-circle-o"></i> Top Promo</a></li>
              </ul>
            </li>
            <li><a href="{{ url('admin/category') }}"><i class="fa fa-circle-o"></i>Product Category</a></li>
            <!--<li><a href="{{ url('admin/subcategory') }}"><i class="fa fa-circle-o"></i> Sub Category</a></li>-->
            <li class=""><a href="{{ url('admin/product') }}"><i class="fa fa-gavel"></i> <span>Product</span></i></a></li>
            <li class=""><a href="{{ url('admin/brands') }}"><i class="fa fa-heartbeat"></i> <span>Brands</span></i></a></li>
            <li class=""><a href="{{ url('admin/users') }}"><i class="fa fa-users"></i> <span>Users</span></i></a></li>
            <li class=""><a href="{{ url('admin/pages') }}"><i class="fa fa-clone"></i> <span>Pages</span></i></a></li>
            <li class=""><a href="{{ url('admin/menu') }}"><i class="fa fa-list-ol"></i> <span>Menu</span></i></a></li>
            <li><a href="{{ url('admin/slider') }}"><i class="fa fa-circle-o"></i> Slider</a></li>
            <li class=""><a href="{{ url('admin/bank') }}"><i class="fa fa-university"></i> <span>Bank</span></i></a></li>
            <li class=""><a href="{{ url('admin/configuration') }}"><i class="fa fa-gear"></i> <span>Web Configuration</span></i></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      @yield('content')

      <footer class="main-footer">
        <strong>Copyright &copy; 2016 <a href="http://cariperkakas.com">cariperkakas.com</a>.</strong> All rights reserved.
      </footer>

    </div><!-- ./wrapper -->


    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('template/admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('template/admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('template/admin/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/admin/dist/js/app.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('template/admin/dist/js/demo.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('template/admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <!-- bootstrap date picker -->
    <script src="{{ asset('template/admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- Multiselect -->
    <script src="{{ asset('template/admin/dist/js/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('template/admin/dist/js/select2.full.js') }}"></script>
    <script src="{{ asset('template/admin/dist/js/select2.js') }}"></script>

    <!--Text Editor-->
    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    <!--Price format-->
    <script src="{{ asset('template/admin/plugins/priceformat/jquery.price_format.2.0.js') }}"></script>
    <script>
    tinymce.init({
    selector: '.texteditor',
    height:300
    });
    </script>
    <!-- page script -->
    <script>
        $(window).load(function() {
            $('.loadingGif').fadeOut("normal");
        });


        $(document).ready(function() {
            $('#category').change();
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
        });

        $(function() {
            $("#example1").DataTable();
            $("#example3").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>


      <script>
        //Price Format
      $('.price_format').priceFormat();
      </script>


        <script>

            $('#category').on('change','input', function () {
                if (this.checked) {
                    //alert("You have elected to show your checkout history."); //checked
                    //alert($(this).val());
                    ////Fungsi untuk Subcategory
                    //var token = "{{ csrf_token() }}";
                    //var code = $('#code').val();
                    //var category = $(this).val();
                    //var dataString = '_token=' + token
                    //                + '&code=' + code
                    //                + '&category=' + category;
                    //$.ajax({
                    //    type: "POST",
                    //    url: "{{ url('ajax/selectsubcategory') }}",
                    //    data: dataString,
                    //    success: function (data) {

                    //        $('#subcate').append(data);
                    //    }
                    //});
                }
                else {
                    //alert("Pilih Kategori Product"); //not checked
                }

                ////Fungsi untuk Subcategory
                //var token = "{{ csrf_token() }}";
                //var code = $('#code').val();
                //var category = $('#category').val();
                //var dataString = '_token=' + token
                //                + '&code=' + code
                //                + '&category=' + category;
                //$.ajax({
                //    type: "POST",
                //    url: "{{ url('ajax/selectsubcategory') }}",
                //    data: dataString,
                //    success: function (data) {
                //
                //        $('#subcate').html(data);
                //    }
                //});
            });

            //Product Add Upload
            $("#uploadadd").click(function () {
                $("#file").append("<input type='file' name='image[]' class='form-control'>");
            });

            //Colorpicker
            $(".colorpicker").colorpicker();
        </script>



    <script>
        $("#addtitle").on('change', function() {
            var repl = $('#addtitle').val().replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '').toLowerCase();
            var rep2 = repl.replace(/\s+/gi, '-').toLowerCase();
            $('#addname').val(rep2);
        });
    </script>

<!--HITUNG DIMENSI-->
<script type="text/javascript">
    $("#dimensionTable").on('change', function() {
        var length = $('#lengthVal').val();
        var width = $('#widthVal').val();
        var height = $('#heightVal').val();
        //alert(length,width,height);
        var volume = length * width * height;
        //alert(volume);
        $('#volumeVal').val(volume);
    });

    function test(id) {
        //var token = "{{ csrf_token() }}";
        var dataString = '_token=' + token + '&id=' + id;
        $.ajax({
            type: "GET",
            url: "{{ url('admin/product/delete/variation/ajax') }}",
            data: dataString,
            success: function(data) {
                location.reload();
            }
        });
    }
</script>
  </body>
</html>
