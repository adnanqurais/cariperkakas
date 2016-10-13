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
    .title-menu:hover{
        padding-left: 20px;
        -webkit-transition: all 1000ms ease;
        -moz-transition: all 1000ms ease;
        -ms-transition: all 1000ms ease;
        -o-transition: all 1000ms ease;
        transition: all 1000ms ease;
    }
    .owl-theme .owl-controls {
        margin-top: 0px;
        text-align: center;
    }
</style>




<div id="dekstop-slide" class="owl-carousel owl-theme">
    @foreach($homeslider as $slide)
        <div class="item">
            <img src="{{ url('/img/slide/'.$slide->image) }}" alt="Slide 1" class="img-responsive" />
            <div class="container text-right"><a href="{{ url($slide->link) }}" class="slide-button  btn btn-warning">Find Out More</a></div>
        </div>
    @endforeach
</div>

<!--Mobile Category-->
<div class="mobile-category container text-center">
    <div class="">
        <h5 class="featured-brand" style="">FEATURED BRANDS</h5>
        <div class="col-md-12" style="padding:0px;" >
            <div class="col-lg-12 col-sm-12 no-padding">
                <div id="productBrandsSliderMobile" >
                    @foreach($slider_featured_brands as $featBrand)
                    <div class="item"><img class="img-responsive" src="img/slide/<?php echo $featBrand->image; ?>" alt="{{ $featBrand->image }}"></div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-12" style="padding:0px;" >
            <div class="col-lg-12 col-sm-12 no-padding">
                <div id="productBrandsSlider1" >
                    @foreach($featuredBrands as $key)
                        @foreach($productFeatBrands[$key->brandsid] as $prodFeatBrand)
                        <div class="item">
                            <a href="{{ url('product-details/'.$prodFeatBrand->productname.'') }}" style="text-decoration: none;">

                                <?php if(!empty($products_img_brand['image_small'][$prodFeatBrand->productid])){ ?>
                                <!-- <div id="productView" class="col-md-12" style="background-image:url('{{ asset('img/product/small/'.$products_img_brand['image_small'][$prodFeatBrand->productid]) }}');background-repeat: no-repeat; background-position: center; background-size: contain;"></div> -->
                                <img class="lazy grid-img" src="{{ url('img/no-image.jpg') }}" data-original="{{ url('img/product/small/'.$products_img_brand['image_small'][$prodFeatBrand->productid].' ') }}" max-width="100%" max-height="100%" style="border:5; margin-top: 10px;"/>
                                <?php } else{ ?>
                                <img class="lazy grid-img" data-original="{{ url('img/no-image.jpg') }}"/>
                                <?php } ?>
                                <p style="text-transform:capitalize; line-height: 20px;"><?php echo strtolower($prodFeatBrand->producttitle); ?></p>
                            </a>
                        </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <h5 class="featured-brand" style="">FEATURED PRODUCTS</h5>
        <div class="col-md-12" style="padding:0px;" >
            <div class="col-lg-12 col-sm-12 no-padding">
                <div id="productSliderMobile" >
                    @foreach($slider_featured_product as $featProduct)
                        <div class="item"><img class="img-responsive" src="img/slide/<?php if(!empty($featProduct->image)){ echo $featProduct->image;}else{echo "no-image.jpg";} ?>" alt="{{ $featProduct->image }}"></div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-12">
            
            <div id="productSlider1" >
                @foreach($homeProducts as $prod_img)
                    <div class="item">
                        <a href="{{ url('product-details/'.$prod_img->productname.'') }}" style="text-decoration: none;">
                            <?php if(!empty($products_img['image_small'][$prod_img->productid])){ ?>
                            <!-- <div id="productView" class="col-md-12" style="background-image:url('{{ asset('img/product/small/'.$products_img['image_small'][$prod_img->productid]) }}');background-repeat: no-repeat; background-position: center; background-size: contain;"></div> -->
                            <img class="lazy grid-img" src="{{ url('img/no-image.jpg') }}" data-original="{{ url('img/product/small/'.$products_img['image_small'][$prod_img->productid].' ') }}" width="100%" height="100%" style="border:5; margin-top: 10px;"/>
                            <?php } else{ ?>
                            <img class="lazy grid-img" data-original="{{ url('img/no-image.jpg') }}"/>
                            <?php } ?>
                            <p style="text-transform:capitalize; line-height: 20px;"><?php echo strtolower($prod_img->producttitle); ?></p>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

<!--./Mobile Category-->
<!--Dekstop Category-->
<!--<div class="jscroll" style="height:600px; overflow:hidden;">-->

    @if ($productFeatBrands != '')
    <div class="dekstop-category container no-padding desktop-category-border" >
    <h3 class="featured-brand">FEATURED BRANDS</h3>
        <div class="col-md-12" style="padding:0px;" >
            <div class="col-lg-12 col-sm-12 no-padding" style="border-top: 2px solid <?php echo $category_view[0]->color;?>;">
                <div id="brandSlider" style="float: left; width: 49%;">
                  @foreach($slider_featured_brands as $featBrand)
                        <div class="item"><img class="img-responsive" width="100%" height="auto" src="img/slide/<?php if(!empty($featBrand->image)){ echo $featBrand->image;}else{echo "no-image.jpg";} ?>" alt="{{ $featBrand->image }}"></div>
                  @endforeach
                </div>
                <div class="product-grid" style="float: left; width: 49%; text-align: center; max-height: 100px; padding-left: 2%;">
                    @foreach($featuredBrands as $key)
                        @foreach($productFeatBrands[$key->brandsid] as $prodFeatBrand)
                                <div class="col-md-6" >
                                    <a href="{{ url('product-details/'.$prodFeatBrand->productname.'') }}" style="text-decoration: none;">

                                    <?php if(!empty($products_img_brand['image_small'][$prodFeatBrand->productid])){ ?>
                                        <!-- <div id="productView" class="col-md-12" style="background-image:url('{{ asset('img/product/small/'.$products_img_brand['image_small'][$prodFeatBrand->productid]) }}');background-repeat: no-repeat; background-position: center; background-size: contain;"></div> -->
                                        <img class="lazy grid-img" src="{{ url('img/no-image.jpg') }}" data-original="{{ url('img/product/small/'.$products_img_brand['image_small'][$prodFeatBrand->productid].' ') }}" max-width="100%" max-height="100%" style="border:5;"/>
                                    <?php } else{ ?>
                                        <img class="lazy grid-img" data-original="{{ url('img/no-image.jpg') }}"/>
                                    <?php } ?>
                                    <p style="text-transform:capitalize;"><?php echo strtolower($prodFeatBrand->producttitle); ?></p>
                                    </a>
                                </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
     </div>
    @endif
    @if ($homeProducts != '')
    <div class="dekstop-category container no-padding desktop-category-border" >
    <h3 class="featured-brand">FEATURED PRODUCTS</h3>
        <div class="col-md-12" style="padding:0px;" >
            <div class="col-lg-12 col-sm-12 no-padding" style="border-top: 2px solid <?php echo $category_view[0]->color;?>;">
                <div id="productSlider" style="float: left; width: 49%;">
                  @foreach($slider_featured_product as $featProduct)
                        <div class="item"><img class="img-responsive" src="img/slide/<?php if(!empty($featProduct->image)){ echo $featProduct->image;}else{echo "no-image.jpg";} ?>" alt="{{ $featProduct->image }}"></div>
                  @endforeach
                </div>
                <div class="product-grid" style="float: left; width: 49%; text-align: center; max-height: 100px; padding-left: 2%;">
                    @foreach($homeProducts as $prod_img)
                            <div class="col-md-6" >
                                <a href="{{ url('product-details/'.$prod_img->productname.'') }}" style="text-decoration: none;">

                                <?php if(!empty($products_img['image_small'][$prod_img->productid])){ ?>
                                    <!-- <div id="productView" class="col-md-12" style="background-image:url('{{ asset('img/product/small/'.$products_img['image_small'][$prod_img->productid]) }}');background-repeat: no-repeat; background-position: center; background-size: contain;"></div> -->
                                    <img class="lazy grid-img" src="{{ url('img/no-image.jpg') }}" data-original="{{ url('img/product/small/'.$products_img['image_small'][$prod_img->productid].' ') }}" max-width="100%" max-height="100%" style="border:5;"/>
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
<!--</div>-->
<script>
    $(document).ready(function() {
     // $('#lazied').unveil(20);
    });
    //   // Product Slide
      
</script>
@endsection
