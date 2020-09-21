<?php
$wtstyle = cs_get_option( 'wtitle-style' );

if(!empty($wtstyle)):
	echo "<div class='{$wtstyle}'>";
endif;	
	wp_reset_postdata();
	$post = consultancy_global_variables('post');
	
	if( is_page() ):
		$page_id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
		consultancy_show_sidebar('page',$page_id, 'right');
	elseif( is_single() ):
	
		if( is_singular('post') ) {
	
			$id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
			consultancy_show_sidebar('post',$id, 'right');
		} elseif( is_singular('dt_portfolios') ) {
	
			$id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
			consultancy_show_sidebar('dt_portfolios',$id, 'right');
		} elseif( is_singular('product') ) {
	
			if( is_active_sidebar('product-detail-sidebar-right') ):
				dynamic_sidebar('product-detail-sidebar-right');
			endif;

			$enable = cs_get_option( 'show-shop-standard-right-sidebar-for-product-layout' );
			if( $enable ):
				if( is_active_sidebar('shop-everywhere-sidebar-right') ):
					dynamic_sidebar('shop-everywhere-sidebar-right');
				endif;
			endif;		
		} else {
			consultancy_show_sidebar('',$id, 'right');
		}	
	elseif( class_exists('woocommerce') && is_post_type_archive('product') ):
		consultancy_show_sidebar('page',get_option('woocommerce_shop_page_id'), 'right');

		$page_id = get_option('page_for_posts');
		consultancy_show_sidebar('page',$page_id,'right');
		
	elseif( class_exists('woocommerce') && is_product_category() ):
	
		if( is_active_sidebar('product-category-sidebar-right') ):
			dynamic_sidebar('product-category-sidebar-right');
		endif;
	
		$enable = cs_get_option( 'show-shop-standard-right-sidebar-for-product-category-layout' );
		if( $enable ):
			if( is_active_sidebar('shop-everywhere-sidebar-right') ):
				dynamic_sidebar('shop-everywhere-sidebar-right');
			endif;
		endif;	
	elseif( class_exists('woocommerce') && is_product_tag() ):
	
		if( is_active_sidebar('product-tag-sidebar-right') ):
			dynamic_sidebar('product-tag-sidebar-right');
		endif;
	
		$enable = cs_get_option( 'show-shop-standard-right-sidebar-for-product-tag-layout' );
		if( $enable ):
			if( is_active_sidebar('shop-everywhere-sidebar-right') ):
				dynamic_sidebar('shop-everywhere-sidebar-right');
			endif;
		endif;	
	elseif( is_tax() ):
	
		$tax = get_query_var( 'taxonomy' );
		if( $tax == 'portfolio_entries' ) {
	
			if( is_active_sidebar('custom-post-portfolio-archives-sidebar-right') ):
				dynamic_sidebar('custom-post-portfolio-archives-sidebar-right');
			endif;

			$enable = cs_get_option( 'show-standard-right-sidebar-for-portfolio-archives' );
			if( $enable ):
				if( is_active_sidebar('standard-sidebar-right') ):
					dynamic_sidebar('standard-sidebar-right');
				endif;
			endif;
		} else {
			if( is_active_sidebar($tax.'-archives-sidebar-right') ):
				dynamic_sidebar($tax.'-archives-sidebar-right');
			endif;

			$standard = 'show-standard-right-sidebar-for-'.$tax;
			$enable = cs_get_option( $standard );
			if( $enable ):
				if( is_active_sidebar('standard-sidebar-right') ):
					dynamic_sidebar('standard-sidebar-right');
				endif;
			endif;
		}
	elseif( is_archive() || is_search() || is_home() ):
	
		if( is_active_sidebar('post-archives-sidebar-right') ):
			dynamic_sidebar('post-archives-sidebar-right');
		endif;
		
		$enable = cs_get_option( 'show-standard-right-sidebar-for-post-archives' );
		if(!empty($enable)):
			if( is_active_sidebar('standard-sidebar-right') ):
				dynamic_sidebar('standard-sidebar-right');
			endif;
		endif;
	elseif( is_home() ):
	
		$page_id = get_option('page_for_posts');
		consultancy_show_sidebar('page',$page_id, 'right');
		
		$enable = cs_get_option( 'show-standard-right-sidebar-for-post-archives' );
		if(!empty($enable)):
			if( is_active_sidebar('standard-sidebar-right') ):
				dynamic_sidebar('standard-sidebar-right');
			endif;
		endif;	

	elseif( function_exists('bp_is_active') && is_buddypress() ):

	$page_id = '';
	$current_component = bp_current_component();
  
	global $bp;
	if( $current_component === "members" ){
		$page_id = $bp->pages->members->id;
	} elseif( $current_component === "activity"){
		$page_id = $bp->pages->activity->id;
	} elseif( $current_component === "groups" ){
		$page_id = $bp->pages->groups->id;
	} elseif( $current_component === "register" ){
		$page_id = $bp->pages->register->id;
	} elseif( $current_component === "activate" ){
		$page_id = $bp->pages->activate->id;
	}
  
	dt_theme_show_sidebar('page',$page_id, 'right');
	
	else:
		if( is_active_sidebar('standard-sidebar-right') ):
			dynamic_sidebar('standard-sidebar-right');
		endif;
	endif;
if(!empty($wtstyle)):	
	echo "</div>";
endif;