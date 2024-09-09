(function( $ ) {
    "use strict";

    jQuery(window).on('elementor/frontend/init', function (){
        if ( window.elementorFrontend.isEditMode() ) {
            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-blog.default',
                function( $scope ){ 
                    medify_parallax_video();
                    medify_blog_masonry_init();
                    medify_carousel_slick(); 
                }
            );            

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-blog-hero.default',
                function( $scope ){ 
                    medify_parallax_video();
                	medify_blog_masonry_init();
                	medify_carousel_slick(); 
                }
            );            

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-carousel.default',
                function( $scope ){ 
                    medify_carousel_slick();  
                }
            );            

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-portfolio.default',
                function( $scope ){ 
                    medify_isotope();
                	medify_carousel_slick();  
                    medify_scroll_animation();
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-progress-bar.default',
                function( $scope ){ 
                    medify_progress_bars_init();  
                }
            ); 

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-testimonials.default',
                function( $scope ){ 
                	medify_carousel_slick();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-toggle-accordion.default',
                function( $scope ){ 
                    medify_accordion_init();  
                }
            ); 

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-tabs.default',
                function( $scope ){ 
                    medify_tabs_init();  
                }
            ); 

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-clients.default',
                function( $scope ){ 
                	medify_carousel_slick();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-team.default',
                function( $scope ){ 
                    medify_isotope();
                    medify_carousel_slick();  
                    medify_scroll_animation();
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-image-layers.default',
                function( $scope ){ 
                	medify_img_layers();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-video-popup.default',
                function( $scope ){ 
                    medify_videobox_init();  
                }
            );            

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-countdown.default',
                function( $scope ){ 
                	medify_countdown_init();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-time-line-vertical.default',
                function( $scope ){ 
                	medify_init_timeline_appear();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-striped-services.default',
                function( $scope ){ 
                	medify_striped_services_init();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-image-comparison.default',
                function( $scope ){ 
                	medify_image_comparison();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-counter.default',
                function( $scope ){ 
                	medify_counter_init();  
                }
            );
        }
    });

})( jQuery );

