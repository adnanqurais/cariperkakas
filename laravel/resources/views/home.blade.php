@extends('app')
@section('content')

<style>

    #cate-home-img .item img{
    display: block;
    width: 100%;
    height: auto;
    }

    .level-1 li ul.level-2 {
        <!--/*display: block;*/-->
        list-style: none;
        padding: 0;
        -webkit-transition: all 300ms ease;
        -webkit-transition:all 300ms ease-in-out;
        -moz-transition:all 300ms ease-in-out;
        -o-transition:all 300ms ease-in-out;
        transition:all 300ms ease-in-out;
    }
    .owl-theme .owl-controls {
         margin-top: 0px;
        text-align: center;
    }
</style>


<div id="dekstop-slide" class="owl-carousel owl-theme">
    @foreach($homeslider as $slide)
        <div class="item">
            <img src="{{ url('/img/slide/'.$slide->image) }}" alt="Slide 1"/>
            <div class="container  text-right"><a href="{{ url($slide->link) }}" class="slide-button  btn btn-warning">Find Out More</a></div>
        </div>
    @endforeach
</div>

<!--Mobile Category-->
<div class="mobile-category container text-center">

    <h3 class="featured-brand text-center" style="margin-bottom: 20px; letter-spacing:5px; font-weight:600;">SHOP CATEGORY</h3>

    @foreach ($category_view as $categoryview)
        @if ($categoryview->parent == '' || $categoryview->parent == '0' || $categoryview->parent == ' ')
        <a href="{{ url('product/category/'.$categoryview->categoryname) }}">
            <div class="col-xs-6" style="text-align: center; margin-bottom: 20px;">
                <?php if(!empty($categoryview->icon)){ ?>
                <div id="product-image" class="img-circle" style="background-image:url('{{ asset('img/icon-category/'.$categoryview->icon.'') }}'); background-repeat: no-repeat; background-position: center; background-size: contain; height:100px; width:100px; border: 2px solid {{ $categoryview->color }}; margin: 0px auto;"></div>
                 <?php } else { ?>
                <div class="img-circle" href="{{ url('product/category/'.$categoryview->categoryname.'') }}" style="height:100px; width:100px; border: 2px solid {{ $categoryview->color }}; margin: 0px auto; color: <?php echo $categoryview->color;?>; font-size:40px; display:table;" ><p style="display: table-cell; vertical-align: middle;"><?php echo substr($categoryview->categorytitle,0,1); ?></p></div>
    <?php } ?>
                <p style="font-size: 11pt">{{ $categoryview->categorytitle }}</p>
            </div>
        </a>
        @endif
    @endforeach

</div>

<!--./Mobile Category-->
<!--Dekstop Category-->
<!--<div class="jscroll" style="height:600px; overflow:hidden;">-->
@foreach ($category_view as $categoryview)
    @if ($categoryview->parent == '' || $categoryview->parent == '0' || $categoryview->parent == ' ')
    <div class="dekstop-category container no-padding desktop-category-border" style="border-top: 2px solid <?php echo $categoryview->color?>;">
    <?php if(!empty($categoryview->icon)){ ?>
        <a class="img-circle" href="{{ url('product/category/'.$categoryview->categoryname) }}" style="display: block"><img class="img-circle dekstop-category-icon" style="border: 2px solid <?php echo $categoryview->color?>;" src="{{ asset('img/icon-category/'.$categoryview->icon) }}" width="50" height="50"></a>
    <?php } else { ?>
        <a class="img-circle dekstop-category-icon" href="{{ url('product/category/'.$categoryview->categoryname) }}" style="border: 2px solid <?php echo $categoryview->color.";";?> text-align:center;font-size:40px; background-color:#fff; vertical-align:middle; z-index:99; display:table; color: <?php echo $categoryview->color?>;" width="50" height="50"><p><?php echo substr($categoryview->categorytitle,0,1); ?></p></a>
    <?php } ?>
        <div class="col-md-12" style="padding:0px;">
            <div class="col-lg-2 col-sm-2" style="margin-top: 1%;">
                <br>
                <a href="{{ url('product/category/'.$categoryview->categoryname) }}" style="display: block"><h4 style="color: <?php echo $categoryview->color;?>">{{ $categoryview->categorytitle }}</h4></a>
                @foreach($subcate[$categoryview->categoryid] as $subCat)
                    <p class="dekstop-category-view-all" style="text-transform:capitalize;"><a href="{{ url('product/category/'.$subCat->categoryname.'') }}" style="text-decoration:none;">{{ $subCat->categorytitle }}</a></p>
                @endforeach
                <!-- <p class="dekstop-category-view-all" style="text-align:bottom;"><a href="{{ url('product/category/'.$categoryview->categoryname) }}" style="text-decoration:none;">View All</a></p> -->
            </div>
            <div class="col-lg-10 col-sm-10 no-padding">
                <div id="productSlider"style="float: left; width: 49%;">
                    <div id="" class="owl-carousel owl-theme category-banner-slider">
                        <?php if(!empty($categoryview->slider1)){?>
                        <div class="item"><img class="img-responsive" src="img/product/banner/product-category/slider/<?php if(!empty($categoryview->slider1)){ echo $categoryview->slider1;}else{echo "no-image.jpg";} ?>" alt="{{ $categoryview->slider1 }}"></div>
                        <?php } ?>
                        <?php if(!empty($categoryview->slider2)){?>
                        <div class="item"><img class="img-responsive" src="img/product/banner/product-category/slider/<?php if(!empty($categoryview->slider2)){ echo $categoryview->slider2;}else{echo "no-image.jpg";} ?>" alt="{{ $categoryview->slider2 }}"></div>
                        <?php } ?>
                        <?php if(!empty($categoryview->slider3)){?>
                        <div class="item"><img class="img-responsive" src="img/product/banner/product-category/slider/<?php if(!empty($categoryview->slider3)){ echo $categoryview->slider3;}else{echo "no-image.jpg";} ?>" alt="{{ $categoryview->slider3 }}"></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="product-grid" style="float: left; width: 49%; text-align: center; max-height: 100px; padding-left: 2%;">
                    @foreach($homeProducts[$categoryview->categoryid] as $prod_img)
                            <div class="col-md-6" >
                                <a href="{{ url('product-details/'.$prod_img->productname.'') }}" style="text-decoration: none;">

                                <?php if(!empty($products_img['image_small'][$prod_img->productid])){ ?>
                                    <!-- <div id="productView" class="col-md-12" style="background-image:url('{{ asset('img/product/small/'.$products_img['image_small'][$prod_img->productid]) }}');background-repeat: no-repeat; background-position: center; background-size: contain;"></div> -->
                                    <img class="lazy grid-img" src="{{ url('img/no-image.jpg') }}" data-original="{{ url('img/product/small/'.$products_img['image_small'][$prod_img->productid].' ') }}" max-width="100%" max-height="100%"/>
                                <?php } else{ ?>
                                    <img class="lazy grid-img" data-original="{{ url('img/no-image.jpg') }}"/>
                                <?php } ?>
                                <p style="text-transform:capitalize;"><?php echo strtolower($prod_img->producttitle); ?></p>
                                </a>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
     </div>
    @endif
@endforeach
<!--</div>-->
<script>
    //$(document).ready(function() {
    //  $('#lazied').unveil(20);
    //});
</script>
@endsection
