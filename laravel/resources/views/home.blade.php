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
        @if ($category_view[0]->parent == '' || $category_view[0]->parent == '0' || $category_view[0]->parent == ' ')
        <a href="{{ url('product/category/'.$category_view[0]->categoryname) }}">
            <div class="col-xs-6" style="text-align: center; margin-bottom: 20px;">
                <?php if(!empty($category_view[0]->icon)){ ?>
                <div id="product-image" class="img-circle" style="background-image:url('{{ asset('img/icon-category/'.$category_view[0]->icon.'') }}'); background-repeat: no-repeat; background-position: center; background-size: contain; height:100px; width:100px; border: 2px solid {{ $category_view[0]->color }}; margin: 0px auto;"></div>
                 <?php } else { ?>
                <div class="img-circle" href="{{ url('product/category/'.$category_view[0]->categoryname.'') }}" style="height:100px; width:100px; border: 2px solid {{ $category_view[0]->color }}; margin: 0px auto; color: <?php echo $category_view[0]->color;?>; font-size:40px; display:table;" ><p style="display: table-cell; vertical-align: middle;"><?php echo substr($category_view[0]->categorytitle,0,1); ?></p></div>
    <?php } ?>
                <p style="font-size: 11pt">{{ $category_view[0]->categorytitle }}</p>
            </div>
        </a>
        @endif


</div>

<!--./Mobile Category-->
<!--Dekstop Category-->
<!--<div class="jscroll" style="height:600px; overflow:hidden;">-->

    @if ($category_view[0]->parent == '' || $category_view[0]->parent == '0' || $category_view[0]->parent == ' ')

    <div class="dekstop-category container no-padding desktop-category-border" style="border-top: 2px solid <?php echo $category_view[0]->color?>;">
        <div class="col-md-12" style="padding:0px;">
            <div class="col-lg-12 col-sm-12 no-padding">
                <div id="productSlider" style="float: left; width: 49%;">
                    <div id="" class="owl-carousel owl-theme category-banner-slider">
                        <?php if(!empty($category_view[0]->slider1)){?>
                        <div class="item"><img class="img-responsive" src="img/product/banner/product-category/slider/<?php if(!empty($category_view[0]->slider1)){ echo $category_view[0]->slider1;}else{echo "no-image.jpg";} ?>" alt="{{ $category_view[0]->slider1 }}"></div>
                        <?php } ?>
                        <?php if(!empty($category_view[0]->slider2)){?>
                        <div class="item"><img class="img-responsive" src="img/product/banner/product-category/slider/<?php if(!empty($category_view[0]->slider2)){ echo $category_view[0]->slider2;}else{echo "no-image.jpg";} ?>" alt="{{ $category_view[0]->slider2 }}"></div>
                        <?php } ?>
                        <?php if(!empty($category_view[0]->slider3)){?>
                        <div class="item"><img class="img-responsive" src="img/product/banner/product-category/slider/<?php if(!empty($category_view[0]->slider3)){ echo $category_view[0]->slider3;}else{echo "no-image.jpg";} ?>" alt="{{ $category_view[0]->slider3 }}"></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="product-grid" style="float: left; width: 49%; text-align: center; max-height: 100px; padding-left: 2%;">
                    @foreach($homeProducts[$category_view[0]->categoryid] as $prod_img)
                            <div class="col-md-6" >
                                <a href="{{ url('product-details/'.$prod_img->productname.'') }}" style="text-decoration: none;">

                                <?php if(!empty($products_img['image_small'][$prod_img->productid])){ ?>
                                    <!-- <div id="productView" class="col-md-12" style="background-image:url('{{ asset('img/product/small/'.$products_img['image_small'][$prod_img->productid]) }}');background-repeat: no-repeat; background-position: center; background-size: contain;"></div> -->
                                    <img class="lazy grid-img hover" src="{{ url('img/no-image.jpg') }}" data-original="{{ url('img/product/small/'.$products_img['image_small'][$prod_img->productid].' ') }}" max-width="100%" max-height="100%"/>
                                <?php } else{ ?>
                                    <img class="lazy grid-img hover" data-original="{{ url('img/no-image.jpg') }}"/>
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
    @if ($category_view[0]->parent == '' || $category_view[0]->parent == '0' || $category_view[0]->parent == ' ')
    <div class="dekstop-category container no-padding desktop-category-border" style="border-top: 2px solid <?php echo $category_view[0]->color?>;">
        <div class="col-md-12" style="padding:0px;">
            <div class="col-lg-12 col-sm-12 no-padding">
                <div id="productSlider" style="float: left; width: 49%;">
                    <div id="" class="owl-carousel owl-theme category-banner-slider">
                        <?php if(!empty($category_view[0]->slider1)){?>
                        <div class="item"><img class="img-responsive" src="img/product/banner/product-category/slider/<?php if(!empty($category_view[0]->slider1)){ echo $category_view[0]->slider1;}else{echo "no-image.jpg";} ?>" alt="{{ $category_view[0]->slider1 }}"></div>
                        <?php } ?>
                        <?php if(!empty($category_view[0]->slider2)){?>
                        <div class="item"><img class="img-responsive" src="img/product/banner/product-category/slider/<?php if(!empty($category_view[0]->slider2)){ echo $category_view[0]->slider2;}else{echo "no-image.jpg";} ?>" alt="{{ $category_view[0]->slider2 }}"></div>
                        <?php } ?>
                        <?php if(!empty($category_view[0]->slider3)){?>
                        <div class="item"><img class="img-responsive" src="img/product/banner/product-category/slider/<?php if(!empty($category_view[0]->slider3)){ echo $category_view[0]->slider3;}else{echo "no-image.jpg";} ?>" alt="{{ $category_view[0]->slider3 }}"></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="product-grid" style="float: left; width: 49%; text-align: center; max-height: 100px; padding-left: 2%;">
                    @foreach($homeProducts[$category_view[0]->categoryid] as $prod_img)
                            <div class="col-md-6" >
                                <a href="{{ url('product-details/'.$prod_img->productname.'') }}" style="text-decoration: none;">

                                <?php if(!empty($products_img['image_small'][$prod_img->productid])){ ?>
                                    <!-- <div id="productView" class="col-md-12" style="background-image:url('{{ asset('img/product/small/'.$products_img['image_small'][$prod_img->productid]) }}');background-repeat: no-repeat; background-position: center; background-size: contain;"></div> -->
                                    <img class="lazy grid-img hover" src="{{ url('img/no-image.jpg') }}" data-original="{{ url('img/product/small/'.$products_img['image_small'][$prod_img->productid].' ') }}" max-width="100%" max-height="100%"/>
                                <?php } else{ ?>
                                    <img class="lazy grid-img hover" data-original="{{ url('img/no-image.jpg') }}"/>
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
<!--</div>-->
<script>
    //$(document).ready(function() {
    //  $('#lazied').unveil(20);
    //});
</script>
@endsection
