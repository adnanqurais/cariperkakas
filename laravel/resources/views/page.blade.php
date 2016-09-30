@extends('app')

@section('content')
<div class="main-area container">
         
    <!--row-->
    <div>
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="#"><i class="icon ion-ios-home"></i></a></li>
                <li class="active">Halaman</li>
            </ul>   
            <!--col-->
        </div>

        <div class="col-lg-3">

            <ul class="categorymenumobile mobile-menu-page nav nav-pills nav-stacked" style="background-color:#f5f5f5; margin: auto 0px;">
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach($allpages as $all)
                          <li><a href="{{ url('page/'.$all->name) }}">{{ $all->title }}</a></li>  
                        @endforeach
                    </ul>
                </li>
            </ul>
                
            <ul class="dekstop-menu-page nav nav-pills nav-stacked">
                        @foreach($allpages as $all)
                          <li><a href="{{ url('page/'.$all->name) }}">{{ $all->title }}</a></li>  
                        @endforeach
             
            </ul>
        </div>
        <!--./Col-->
     
        <!--col-->
        <div class="col-lg-9">
            
            @foreach($pages as $pagetitle)

            <div id="{{ $pagetitle->name }}" draggable>
                <?php
                    echo nl2br($pagetitle->content, false);
                ?>
            </div>
             @endforeach
        </div>
        <!--./Col-->
    </div><!--./row-->
</div><!--./container-->
@endsection

