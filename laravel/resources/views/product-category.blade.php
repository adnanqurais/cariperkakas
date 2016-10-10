@extends('app')

@section('content')
<style>
/*./------------------------------------------------------Category top Hover-------------------------------------------------*/
.categorymenudekstop{
    list-style: none;/* Remove list bullets */
    padding: 0;
    margin: 0;
}
.categorymenudekstop li {
    padding: 2px 2px;
    letter-spacing: 1px;

}

.categorymenudekstop li a {
    color: #666;
    font-weight: 600;
    font-family: 'Lato';
    text-decoration: none;

}
.categorymenudekstop li a:hover {
    color: #1DB7EB;
}
.categorymenudekstop li ul{
    list-style: none;/* Remove list bullets */
    padding-left: 15px;
}

.categorymenudekstop li ul li a{
        font-weight: 400;
}


.gridcategory ul{
    list-style: none;
    padding: 0;
    margin: 0;
    }
.gridcategory ul li a{
    width: 300px;
    }
.gridcategory ul li a:hover{
    border: 1px solid #999;
    }
    .productname {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .level-1 li ul.level-2 {
    display: block;
    list-style: none;
        padding: 0;
        -webkit-transition: all 300ms ease;
        -webkit-transition:all 300ms ease-in-out;
        -moz-transition:all 300ms ease-in-out;
        -o-transition:all 300ms ease-in-out;    
        transition:all 300ms ease-in-out;
    }
</style>






<div class="main-area container">

    <input type='hidden' id='current_page' />
    <input type='hidden' id='show_per_page' />
<div class="row">
    <!--Category Dekstop-->
    <div class="col-md-3" style="padding-left:10px; padding-right:10px;">

        <ul class="categorymenumobile nav nav-pills nav-stacked" style="background-color:#f5f5f5">
                <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Kategori Belanja
                <span class="caret"></span></a>
                <ul class="dropdown-menu" style="max-height: 300px; overflow: scroll;">

                @foreach ($categorymenu as $category)
                    @if($category->parent == '0')
                    <li style="margin-bottom: 10px;"><a href="{{ url('product/category/'.$category->categoryname) }}">{{ $category->categorytitle }}</a>
                       <ul style="padding-left: 50px; padding-top: 0px; margin-top: 0px">
                            @foreach($categorymenu as $sub)
                                @if($sub->parent == $category->categoryid)
                                <li><a href="{{ url('product/category/'.$sub->categoryname) }}">{{ $sub->categorytitle }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    @endif
                @endforeach
                </ul>
            </li>
        </ul>

        <ul class="categorymenudekstop">
            @foreach ($categorymenu as $category)
                @if($category->parent == '')
                <li><a href="{{ url('product/category/'.$category->categoryname) }}">{{ $category->categorytitle }}</a>
                   <ul>
                        @foreach($categorymenu as $sub)
                            @if($sub->parent == $category->categoryid)
                            <li><a href="{{ url('product/category/'.$sub->categoryname) }}">{{ $sub->categorytitle }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                @endif
            @endforeach
        </ul>
    </div>

    <div class="testing col-md-9">
        <div class="col-xs-12">
        <!--Breadcumb-->
        {{-- <ul class="breadcrumb">
            <li><a href="#"><i class="icon ion-ios-home"></i></a></li>
            <li class="active">Produk Kategori</li>
        </ul> --}}
        {{-- <div class="text-center"?> 
        {!! $products->render() !!}
        </div> --}}

        <!--./Breadcumb-->
        @if(Session::has('category-notfound'))
          <div class="alert alert-warning text-center">{{ Session::get('category-notfound') }}</div>
        @endif
        <div class="col-sm-12">

          <ul class="product-grid">

              @foreach ($products as $product)
              <li class="col-md-4 col-sm-4 col-xs-6">
                  <a class=" product-frame" href="{{ url('product-details/'.$product->productname.'') }}" title="getdetails">
                      <?php if(!empty($products_img['image_small'][$product->productid])){?><div class="lazy" id="product-image" style="background-image:url('{{ asset('img/product/small/'.$products_img['image_small'][$product->productid]) }}'); background-repeat: no-repeat; background-position: center; background-size: contain; height:200px;"></div> <?php } else {?> <div id="product-image" class="clearfix col-md-12 lazy" style="background-image:url('{{ asset('img/no-image_1.jpg')}}'); background-repeat: no-repeat; background-position: center; background-size: contain; height:200px;"></div> <?php } ?>

                      <div class="col-md-12 product-general-detail"><p class="productname"><strong> {{ $product->producttitle }}</strong></p>
                          <p>{{ $product->categorytitle }}</p>
                          <p class="price_format text-warning">
                          @if($product->price == NULL || $product->price == 0)
                            {{ $product->var_price }}
                          @else
                            {{ $product->price }}
                          @endif
                        </p>
                      </div>
                  </a>
              </li>
              @endforeach
          </ul>
        </div>
        <hr>
    </div>

    <hr>
    <!-- Pagination -->
    <div class="text-center"?> 
        {!! $products->render() !!}
        </div>
    

    </div>

    <!--./Category dekstop-->
</div>
</div>
<script>

</script>
@endsection
