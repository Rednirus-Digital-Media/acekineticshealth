"use strict";

is_visible_init ();
medify_slick_navigation_init();

jQuery(document).ready(function($) {
	medify_split_slider();
	medify_sticky_init();
	medify_search_init();
	medify_side_panel_init();
	medify_mobile_header();
	medify_woocommerce_helper();
	medify_woocommerce_tools();
	medify_woocommerce_filters();
	medify_woocommerce_tabs();
	medify_woocommerce_login_in();
	medify_init_timeline_appear();
	medify_accordion_init();
	medify_striped_services_init();
	medify_progress_bars_init();
	medify_carousel_slick();
	medify_image_comparison();
	medify_counter_init();
	medify_countdown_init ();
	medify_circuit_services();
	medify_circuit_services_resize();
	medify_img_layers();
	medify_page_title_parallax();
	medify_extended_parallax();
	medify_portfolio_parallax();
	medify_message_anim_init();
	medify_scroll_up();
	medify_link_scroll();
	medify_skrollr_init();
	medify_sticky_sidebar ();
	medify_videobox_init ();
	medify_parallax_video();
	medify_tabs_init();
	medify_select_wrap();
	jQuery( '.wgl_module_title .carousel_arrows' ).medify_slick_navigation();
	jQuery( '.wgl-products > .carousel_arrows' ).medify_slick_navigation();
	jQuery( '.medify_module_custom_image_cats > .carousel_arrows' ).medify_slick_navigation();
	medify_scroll_animation();
	medify_woocommerce_mini_cart();
	medify_woocommerce_notifications();
	medify_text_background();
	medify_dynamic_styles();
});

jQuery(window).load(function() {
	medify_isotope();
	medify_blog_masonry_init();
	setTimeout(function(){
		jQuery('#preloader-wrapper').fadeOut();
	},1100);
	particles_custom();

	medify_menu_lavalamp();
	jQuery(".wgl-currency-stripe_scrolling").each(function(){
    	jQuery(this).simplemarquee({
	        speed: 40,
	        space: 0,
	        handleHover: true,
	        handleResize: true
	    });
    })
});
