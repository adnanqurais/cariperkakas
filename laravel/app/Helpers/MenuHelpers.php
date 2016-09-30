<?php

	function AllMenuCategory(){
		$prod_category = DB::table('product_category')->where('enable', '=', 1)->get();
        $html = '';

        $html .= '<ul class="level-2">';
        foreach ($prod_category as $category){
            if ($category->parent == '' || $category->parent == '0'){
        	    $html .= '<li onmouseover="this.style.backgroundColor=\''. $category->color .'\'" onmouseout="this.style.backgroundColor=\'\'">';
        	    $html .= '<a href="'. url('product/category/'. $category->categoryname) .'">'. $category->categorytitle .'</a>';
        	    $html .= '<ul class="level-3">';

        	    $html .= '<li style="border-top: 2px solid '. $category->color .';" style="color:#ddd;">'.'<a href="'. url('product/category/'.$category->categoryname) .'" style="margin-left: 10px; font-weight: bold;">'. $category->categorytitle.'</a>';

        	    $html .= '<div class="nopadding" style="border-top: 1px solid #e5e5e5;">';
        	    $html .= '<div class="col-md-8">';
        	    // $prod_subcategory = DB::table('product_subcategory')->where('enable', '=', 1)->where('categoryid','=', $category->categoryid)->get();

                $html .= '<div class="col-xs-12">';
                $html .= '<ul class="level-4 list" >';
        	    foreach ($prod_category as $subcategory){
										$flag = " ";
                    if($subcategory->parent == $category->categoryid){
											foreach ($prod_category as $key) {
												if($key->parent == $subcategory->categoryid){
													$flag = "hasSub";
												}
											}
											// if($flag == "hasSub"){
											// 	$html .= '<li class="treeview" onmouseover="this.style.backgroundColor=\' '.$category->color.' \'" onmouseout="this.style.backgroundColor=\'\'"><a href="#">'.$subcategory->categorytitle.' <i class="fa fa-angle-left pull-right">';
											// 	// $html .= '<ul class="treeview-menu">';
											// 	// foreach ($prod_category as $sub1) {
											// 	// 	if($sub1->parent == $subcategory->categoryid){
											// 	// 			$html .= '<li onmouseover="this.style.backgroundColor=\' '.$sub1->color.' \'" onmouseout="this.style.backgroundColor=\'\'"><a href="'. url('product/category/'.$sub1->categoryname) .'">'.$sub1->categorytitle.'</a></li>';
											// 	// 	}
											// 	// }
											// 	// $html .= '</ul>';
											// 	$html.='</i></a>';
											// }else{
												$html .= '<li onmouseover="this.style.backgroundColor=\' '.$category->color.' \'" onmouseout="this.style.backgroundColor=\'\'"><a href="'. url('product/category/'.$subcategory->categoryname) .'">'.$subcategory->categorytitle.'</a>';
											// }

													// $html .= '<ul class="treeview-menu">';
													// foreach ($prod_category as $key) {
													// 	if($key->parent == $subcategory->categoryid){
													// 			$html .= '<li onmouseover="this.style.backgroundColor=\' '.$key->color.' \'" onmouseout="this.style.backgroundColor=\'\'"><a href="'. url('product/category/'.$key->categoryname) .'">'.$key->categorytitle.'</a></li>';
													// 	}
													// }
													// $html .= '</ul>';
												$html .= '</li>';
                    }
        	    }

                $html .= '</ul>';

                $html .= '</div>';
        	    $html .= '</div>';

                    $html .= '<div class="col-md-4 text-right" style=" min-height: 368px; ">';

                    if(!empty($category->banner)){
        	    					$html .= '<img src="'. url('img/product/banner/product-category/'.$category->banner.'') .'">';
                    }
                    $html .= '</div>';

                		// $html .= '<div class="col-md-12" onmouseover="this.style.backgroundColor=\' '.$category->color.' \'" onmouseout="this.style.backgroundColor=\'\'" style="width:100% !important; height:auto !important;"><button>Toggle</button></div>';
                    $html .= '</div>';

        	    $html .= '</li>';
        	    $html .= '</ul>';
        	    $html .= '</li>';
            }
        }
        $html .= '</ul>';

        return $html;
	}

	function toppromo(){
				$i = 0;
       	$toppromo = DB::table('promotion')->get();
				//  $toppromo2 = DB::table('promotion')->orderBy('promotionid', 'desc')->first();

        $html = '';
        if($toppromo[0]->enable == 1){

        $html .= '<div id="toppromo" class="toppromo top-promo collapse in" style="box-shadow: 0px 0px 10px rgba(0,0,0,0.6);">';
        }else{

        $html .= '<div id="toppromo" class="toppromo top-promo collapse in" style="display:none;">';

        }

        $html .= '<div style="padding:5px 25px;">';


        $html .= '<button id="topPromoBtn" type="button" class="btn btn-primary pull-right" style="margin-right: -15px;z-index: 999;position: relative;" data-toggle="collapse" data-target="#toppromo"><i class="fa fa-times"></i></button>';


				$html .= '<div id="owl-example" class="owl-example owl-carousel" style="width:auto;">';
							foreach ($toppromo as $key) {
								if($i == 0 ){
									$html .= '<div>';
									$i = 1;
								}else{
									$html .= '<div>';
								}
											$html .= '<a href="'.$key->link.'"><div class="text-promo-dekstop">';
											$html .= '<p>'.$key->dekstopcaption.'</p>';
											$html .= '</div></a>';
									$html .= '</div>';

							}
				$html .= '</div>';

				// $html .= '<div id="myCarousel" class="carousel slide" data-ride="carousel">';
				// 	  $html .= '<div class="carousel-inner" role="listbox" style="width:100%;">';
				//
				//
				// 			foreach ($toppromo as $key) {
				// 				if($i == 0 ){
				// 					$html .= '<div class="item" active>';
				// 					$i = 1;
				// 				}else{
				// 					$html .= '<div class="item">';
				// 				}
				// 							$html .= '<a href="'.$key->link.'"><div class="text-promo-dekstop">';
				// 							$html .= '<p>'.$key->dekstopcaption.'</p>';
				// 							$html .= '</div></a>';
				// 					$html .= '</div>';
				//
				// 			}
				//
				//
				// 	    // $html .='<div class="item">';
				// 			// 		$html .= '<a href="'.$toppromo->link.'"><div class="text-promo-dekstop">';
				// 			// 		$html .= '<p>'.$toppromo->dekstopcaption.'</p>';
				// 			// 		$html .= '</div></a>';
				// 	    // $html .= '</div>';
				//
				// 	  $html .='</div>';
				// $html .= '</div>';

				$html .= '<div id="owl-example1" class="owl-example owl-carousel" style="width:auto;">';
							foreach ($toppromo as $key1) {
								$html .= '<div class="text-promo-mobile" >';
				      	$html .= '<p class="" style="margin-left: -15px;">'.$key1->dekstopcaption.' &nbsp;<a href="'.$key1->link.'">disini</a></p>';
				        $html .= '</div>';

							}
				$html .= '</div>';
        // $html .= '<div class="text-promo-mobile" >';
      	// $html .= '<p class="text-left" style="margin-left: -15px;">'.$toppromo->dekstopcaption.' &nbsp;<a href="'.$toppromo->link.'">disini</a></p>';
        // $html .= '</div>';

        $html .= '</div>';
        $html .= '</div>';


        return $html;
	}

    function bottom1(){
        $bottom2 = DB::table('menu')->where('position', '=', 'bottom1')->take(5)->get();
        $html = '';
        $html .= '<ul class="menu-footer">';
        foreach($bottom2 as $b1){
        $html .= '<li><a href="'. url($b1->url) .'">'.$b1->title.'</a></li>';
        }
        $html .= '</ul>';
        return $html;
    }
    function bottom2(){
        $bottom2 = DB::table('menu')->where('position', '=', 'bottom2')->take(5)->get();
        $html = '';
        $html .= '<ul class="menu-footer">';
        foreach($bottom2 as $b2){
        $html .= '<li><a href="'. url($b2->url) .'">'.$b2->title.'</a></li>';
        }
        $html .= '</ul>';
        return $html;
    }

    function CategoryMobileView(){
        $mobile_category_view = DB::table('product_category')
        ->where('enable', '=', 1)
        ->where('parent', '=', 0)
        ->get();
        $html = '';
        $html .= '<ul id="appCategory" class="hidden-lg hidden-md appCategory navbar-collapse collapse">';
        foreach ($mobile_category_view as $category){
            $html .= '<li><a href="'. url('product/category/'.$category->categoryname).'">'.$category->categorytitle.'</a></li>';
        }
        $html .= '</ul>';
        return $html;
    }

?>
