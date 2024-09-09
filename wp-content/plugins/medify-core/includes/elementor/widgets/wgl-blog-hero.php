<?php
namespace WglAddons\Widgets;

use WglAddons\Includes\Wgl_Loop_Settings;
use WglAddons\Includes\Wgl_Carousel_Settings;
use WglAddons\Templates\WglBlogHero;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wgl_Blog_Hero extends Widget_Base {

    public function get_name() {
        return 'wgl-blog-hero';
    }

    public function get_title() {
        return esc_html__('Wgl Blog Hero', 'medify-core' );
    }

    public function get_icon() {
        return 'wgl-blog-hero';
    }

    public function get_script_depends() {
        return [
            'slick',
            'jarallax',
            'jarallax-video',
            'imagesloaded',
            'wgl-elementor-extensions-widgets',
        ];
    }

    public function get_categories() {
        return [ 'wgl-extensions' ];
    }

    // Adding the controls fields for the blog
    // This will controls the animation, colors and background, dimensions etc
    protected function register_controls() {
        $theme_color = esc_attr(\Medify_Theme_Helper::get_option('theme-custom-color'));
        $main_font_color = esc_attr(\Medify_Theme_Helper::get_option('main-font')['color']);
        $header_font_color = esc_attr(\Medify_Theme_Helper::get_option('header-font')['color']);

        /* Start General Settings Section */
        $this->start_controls_section('wgl_blog_section',
            array(
                'label'         => esc_html__('Settings', 'medify-core'),
            )
        );


        /*Title Text*/
        $this->add_control('blog_title',
            array(
                'label'         => esc_html__('Title', 'medify-core'),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'dynamic'       => [ 'active' => true ]
            )
        );
        $this->add_control('blog_subtitle',
            array(
                'label'         => esc_html__('Sub Title', 'medify-core'),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'dynamic'       => [ 'active' => true ]
            )
        );

        $this->add_control(
            'blog_columns',
            array(
                'label'          => esc_html__( 'Grid Columns Amount', 'medify-core' ),
                'type'           => Controls_Manager::SELECT,

                'options'        => array(
                    '12' => esc_html__( 'One', 'medify-core' ),
                    '6'  => esc_html__( 'Two', 'medify-core' ),
                    '4'  => esc_html__( 'Three', 'medify-core' ),
                    '3'  =>esc_html__( 'Four', 'medify-core' )
                ),
                'default'        => '4',
                'tablet_default' => 'inherit',
                'mobile_default' => '12',
                'frontend_available' => true,
                'label_block'  => true,
            )
        );

        $this->add_control('blog_layout',
            array(
                'label'         => esc_html__( 'Layout', 'medify-core' ),
                'type'          => 'wgl-radio-image',
                'options'       => [
                    'grid'      => [
                        'title'=> esc_html__( 'Grid', 'medify-core' ),
                        'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_composer_addon/icons/layout_grid.png',
                    ],
                    'masonry'    => [
                        'title'=> esc_html__( 'Masonry', 'medify-core' ),
                        'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_composer_addon/icons/layout_masonry.png',
                    ],
                    'carousel'     => [
                        'title'=> esc_html__( 'Carousel', 'medify-core' ),
                        'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_composer_addon/icons/layout_carousel.png',
                    ],
                ],
                'default'       => 'grid',            )
        );

        $this->add_control('blog_navigation',
            array(
                'label'             => esc_html__('Navigation Type', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    'none'          => esc_html__('None', 'medify-core'),
                    'pagination'    => esc_html__('Pagination', 'medify-core'),
                    'load_more'     => esc_html__('Load More', 'medify-core'),
                ],
                'default'           => 'none',
                'condition'     => [
                     'blog_layout'   => array('grid', 'masonry')
                ]
            )
        );

        $this->add_control('blog_navigation_align',
            array(
                'label'             => esc_html__('Navigation\'s Alignment', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    'left'          => esc_html__('Left', 'medify-core'),
                    'center'        => esc_html__('Center', 'medify-core'),
                    'right'         => esc_html__('Right', 'medify-core'),
                ],
                'default'           => 'left',
                'condition'         => [
                    'blog_navigation'   => 'pagination'
                ]
            )
        );

        $this->add_control('items_load',
            array(
                'label'         => esc_html__('Items to be loaded', 'medify-core'),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__('4','medify-core'),
                'condition'     => [
                    'blog_navigation'   => 'load_more',
                    'blog_layout'   => array('grid', 'masonry')
                ]
            )
        );

        $this->add_control('name_load_more',
            array(
                'label'         => esc_html__('Button Text', 'medify-core'),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__('Load More','medify-core'),
                'condition'     => [
                    'blog_navigation'   => 'load_more',
                    'blog_layout'   => array('grid', 'masonry')
                ]
            )
        );
        $this->add_control(
            'spacer_load_more',
            array(
                'label' => esc_html__( 'Button Spacer Top', 'medify-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -20,
                        'max' => 200,
                    ],
                ],
                'size_units' => [ 'px', 'em', 'rem', 'vw' ],
                'condition'     => [
                    'blog_navigation'   => 'load_more',
                    'blog_layout'   => array('grid', 'masonry')
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '30',
                ],
                'selectors' => [
                    '{{WRAPPER}} .load_more_wrapper' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            )
        );

        /*End General Settings Section*/
        $this->end_controls_section();

        $this->start_controls_section(
            'display_section',
            array(
                'label' => esc_html__('Display', 'medify-core' ),
            )
        );

        $this->add_control(
            'hide_media',
            array(
                'label'        => esc_html__('Hide Media?','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'hide_blog_title',
            array(
                'label'        => esc_html__('Hide Title?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'hide_content',
            array(
                'label'        => esc_html__('Hide Content?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'hide_postmeta',
            array(
                'label'        => esc_html__('Hide all post-meta?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'meta_author',
            array(
                'label'        => esc_html__('Hide post-meta author?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'     => [
                    'hide_postmeta!'   => 'yes',
                ]
            )
        );

        $this->add_control(
            'meta_comments',
            array(
                'label'        => esc_html__('Hide post-meta comments?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'     => [
                    'hide_postmeta!'   => 'yes',
                ]
            )
        );

        $this->add_control(
            'meta_categories',
            array(
                'label'        => esc_html__('Hide post-meta categories?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'condition'     => [
                    'hide_postmeta!'   => 'yes',
                ]
            )
        );

        $this->add_control(
            'meta_date',
            array(
                'label'        => esc_html__('Hide post-meta date?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'condition'     => [
                    'hide_postmeta!'   => 'yes',
                ]
            )
        );

        $this->add_control(
            'hide_likes',
            array(
                'label'        => esc_html__('Hide Likes?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'hide_share',
            array(
                'label'        => esc_html__('Hide Post Share?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'read_more_hide',
            array(
                'label'        => esc_html__('Hide \'Read More\' button?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('read_more_text',
            array(
                'label'         => esc_html__('Read More Text', 'medify-core'),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__('Read More','medify-core'),
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'read_more_hide'   => '',
                ]
            )
        );

        $this->add_control('content_letter_count',
            array(
                'label'       => esc_html__('Characters Amount in Content', 'medify-core'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '115',
                'min'         => 1,
                'step'        => 1,
                'condition'     => [
                    'hide_content'   => '',
                ]
            )
        );

        $this->add_control(
            'crop_square_img',
            array(
                'label'        => esc_html__('Crop Images for Posts List?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'description'  => esc_html__( 'For correctly work uploaded image size should be larger than 700px height and width.', 'text-domain' ),
            )
        );

        $this->end_controls_section();


        /* Start Carousel General Settings Section */
        $this->start_controls_section('wgl_carousel_section',
            array(
                'label'         => esc_html__('Carousel Options', 'medify-core'),
                'condition'     => [
                    'blog_layout'   => 'carousel',
                ]
            )
        );

        $this->add_control(
            'autoplay',
            array(
                'label'        => esc_html__('Autoplay','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('autoplay_speed',
            array(
                'label'       => esc_html__('Autoplay Speed', 'medify-core'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '3000',
                'min'         => 1,
                'step'        => 1,
                'condition'     => [
                    'autoplay'  => 'yes',
                ]
            )
        );

        $this->add_control(
            'use_pagination',
            array(
                'label'        => esc_html__('Add Pagination control','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('pag_type',
            array(
                'label'         => esc_html__( 'Pagination Type', 'medify-core' ),
                'type'          => 'wgl-radio-image',
                'options'       => [
                    'circle'      => [
                        'title'=> esc_html__( 'Circle', 'medify-core' ),
                        'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_composer_addon/icons/pag_circle.png',
                    ],
                    'circle_border' => [
                        'title'=> esc_html__( 'Empty Circle', 'medify-core' ),
                        'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_composer_addon/icons/pag_circle_border.png',
                    ],
                    'square'    => [
                        'title'=> esc_html__( 'Square', 'medify-core' ),
                        'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_composer_addon/icons/pag_square.png',
                    ],
                    'line'    => [
                        'title'=> esc_html__( 'Line', 'medify-core' ),
                        'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_composer_addon/icons/pag_line.png',
                    ],
                    'line_circle'    => [
                        'title'=> esc_html__( 'Line - Circle', 'medify-core' ),
                        'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_composer_addon/icons/pag_line_circle.png',
                    ],
                ],
                'default'       => 'circle',
                'condition'     => [
                    'use_pagination'  => 'yes',
                ]
            )
        );

        $this->add_control('pag_offset',
            array(
                'label'       => esc_html__('Pagination Top Offset', 'medify-core'),
                'type'        => Controls_Manager::NUMBER,
                'min'         => 1,
                'step'        => 1,
                'condition'     => [
                    'use_pagination'  => 'yes',
                ]
            )
        );

        $this->add_control(
            'custom_pag_color',
            array(
                'label'        => esc_html__('Custom Pagination Color','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'pag_color',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default'      => esc_attr($theme_color),
                'condition'     => [
                    'custom_pag_color'  => 'yes',
                ]
            )
        );

        $this->add_control(
            'use_navigation',
            array(
                'label'        => esc_html__('Add Navigation control','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );


        $this->add_control('custom_resp',
            array(
                'label'        => esc_html__('Customize Responsive','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'heading_desktop',
            array(
                'label' => esc_html__( 'Desktop Settings', 'medify-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
                'condition'         => [
                    'custom_resp'   => 'yes',
                ]
            )
        );

        $this->add_control('resp_medium',
            array(
                'label'             => esc_html__('Desktop Screen Breakpoint', 'medify-core'),
                'type'              => Controls_Manager::NUMBER,
                'default'           => '1025',
                'min'               => 1,
                'step'              => 1,
                'condition'         => [
                    'custom_resp'   => 'yes',
                ]
            )
        );

        $this->add_control('resp_medium_slides',
            array(
                'label'             => esc_html__('Slides to show', 'medify-core'),
                'type'              => Controls_Manager::NUMBER,
                'min'               => 1,
                'step'              => 1,
                'condition'         => [
                    'custom_resp'   => 'yes',
                ]
            )
        );

        $this->add_control(
            'heading_tablet',
            array(
                'label' => esc_html__( 'Tablet Settings', 'medify-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
                'condition'         => [
                    'custom_resp'   => 'yes',
                ]
            )
        );

        $this->add_control('resp_tablets',
            array(
                'label'             => esc_html__('Tablet Screen Breakpoint', 'medify-core'),
                'type'              => Controls_Manager::NUMBER,
                'default'           => '800',
                'min'               => 1,
                'step'              => 1,
                'condition'         => [
                    'custom_resp'   => 'yes',
                ]
            )
        );

        $this->add_control('resp_tablets_slides',
            array(
                'label'             => esc_html__('Slides to show', 'medify-core'),
                'type'              => Controls_Manager::NUMBER,
                'min'               => 1,
                'step'              => 1,
                'condition'         => [
                    'custom_resp'   => 'yes',
                ]
            )
        );

        $this->add_control(
            'heading_mobile',
            array(
                'label' => esc_html__( 'Mobile Settings', 'medify-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
                'condition'         => [
                    'custom_resp'   => 'yes',
                ]
            )
        );

        $this->add_control('resp_mobile',
            array(
                'label'             => esc_html__('Mobile Screen Breakpoint', 'medify-core'),
                'type'              => Controls_Manager::NUMBER,
                'default'           => '480',
                'min'               => 1,
                'step'              => 1,
                'condition'         => [
                    'custom_resp'   => 'yes',
                ]
            )
        );

        $this->add_control('resp_mobile_slides',
            array(
                'label'             => esc_html__('Slides to show', 'medify-core'),
                'type'              => Controls_Manager::NUMBER,
                'min'               => 1,
                'step'              => 1,
                'condition'         => [
                    'custom_resp'   => 'yes',
                ]
            )
        );

        /*End General Settings Section*/
        $this->end_controls_section();



        /*-----------------------------------------------------------------------------------*/
        /*  Build Query Section
        /*-----------------------------------------------------------------------------------*/

        Wgl_Loop_Settings::init( $this, array( 'post_type' => 'post') );

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section
        /*-----------------------------------------------------------------------------------*/

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section(Headings Section)
        /*-----------------------------------------------------------------------------------*/
        $this->start_controls_section(
            'headings_style_section',
            array(
                'label'     => esc_html__( 'Headings', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control('heading_tag',
            array(
                'label'         => esc_html__('Heading tag', 'medify-core'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'h4',
                'options'       => [
                    'h1'    => 'H1',
                    'h2'    => 'H2',
                    'h3'    => 'H3',
                    'h4'    => 'H4',
                    'h5'    => 'H5',
                    'h6'    => 'H6',
                ],
            )
        );

        $this->add_responsive_control(
            'heading_margin',
            array(
                'label' => esc_html__( 'Heading margin', 'medify-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'   => [
                    'top'       => 0,
                    'left'      => 0,
                    'right'     => 0,
                    'bottom'    => 12,
                    'unit'      => 'px',
                    'isLinked'  => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-post_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );


        $this->start_controls_tabs( 'headings_color' );

        $this->start_controls_tab(
            'custom_headings_color_normal',
            array(
                'label' => esc_html__( 'Normal' , 'medify-core' ),
            )
        );

        $this->add_control(
            'custom_headings_color',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => array(
                    '{{WRAPPER}} .blog-post_title a' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_headings_color_hover',
            array(
                'label' => esc_html__( 'Hover' , 'medify-core' ),
            )
        );

        $this->add_control(
            'custom_hover_headings_color',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($theme_color),
                'selectors' => array(
                    '{{WRAPPER}} .blog-post_title a:hover' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'custom_fonts_blog_headings',
                'selector' => '{{WRAPPER}} .blog-post_title, {{WRAPPER}} .blog-post_title > a',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style_section',
            array(
                'label'     => esc_html__( 'Content', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'content_margin',
            array(
                'label' => esc_html__( 'Margin', 'medify-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'   => [
                    'top'       => 0,
                    'left'      => 0,
                    'right'     => 0,
                    'bottom'    => 12,
                    'unit'      => 'px',
                    'isLinked'  => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-post_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );


        $this->add_control(
            'custom_content_color',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#cccccc',
                'selectors' => array(
                    '{{WRAPPER}} .blog-post_text' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'custom_fonts_blog_content',
                'selector' => '{{WRAPPER}} .blog-post_text',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'meta_info_style_section',
            array(
                'label'     => esc_html__( 'Meta Info', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'meta_info_margin',
            array(
                'label' => esc_html__( 'Margin', 'medify-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'   => [
                    'top'       => 0,
                    'left'      => 0,
                    'right'     => 0,
                    'bottom'    => 4,
                    'unit'      => 'px',
                    'isLinked'  => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-post .blog-post-hero_content > .meta-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->start_controls_tabs( 'tabs_meta_info' );

        $this->start_controls_tab(
            'tab_meta_info_normal',
            [
                'label' => esc_html__( 'Normal', 'medify-core' ),
            ]
        );

        $this->add_control(
            'custom_main_color',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => array(
                    '{{WRAPPER}} .meta-wrapper' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .meta-wrapper a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-post_meta-categories .lavalamp-object' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-post_meta-categories a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-post_meta-categories span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-post_likes-wrap .sl-count' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .share_post-container > a' => 'color: {{VALUE}};',
                ),
            )
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_meta_hover',
            [
                'label' => esc_html__( 'Hover', 'medify-core' ),
            ]
        );

        $this->add_control(
            'custom_main_color_hover',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($theme_color),
                'selectors' => array(
                    '{{WRAPPER}} .blog-post_meta-categories:hover a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-post_meta-categories:hover span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-post_likes-wrap:hover .sl-count' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .meta-wrapper a:hover' => 'color: {{VALUE}};',
                ),
            )
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'media_style_section',
            array(
                'label'     => esc_html__( 'Media', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'custom_blog_mask',
            array(
                'label'        => esc_html__('Custom Image Idle Overlay','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'custom_image_mask_color',
                'label' => esc_html__( 'Background', 'medify-core' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'default'  => 'rgba( '.\Medify_Theme_Helper::hexToRGB($header_font_color).',0.1)',
                'condition'     => [
                    'custom_blog_mask'   => 'yes',
                ],
                'selector' => '{{WRAPPER}} .blog-post_bg_media:before',
            )
        );

        $this->add_control(
            'custom_blog_hover_mask',
            array(
                'label'        => esc_html__('Custom Image Hover Overlay','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'custom_image_hover_mask_color',
                'label' => esc_html__( 'Background', 'medify-core' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'default'  => 'rgba(50,50,50,1)',
                'condition'     => [
                    'custom_blog_hover_mask'   => 'yes',
                ],
                'selector' => '{{WRAPPER}} .blog-post .blog-post_bg_media:after',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'without_media_style_section',
            array(
                'label'     => esc_html__( 'Without Media', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );

        $this->start_controls_tabs( 'headings_standard_color' );

        $this->start_controls_tab(
            'custom_standard_headings_color_normal',
            array(
                'label' => esc_html__( 'Normal' , 'medify-core' ),
            )
        );

        $this->add_control(
            'custom_standard_headings_color',
            array(
                'label' => esc_html__( 'Title Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($header_font_color),
                'selectors' => array(
                    '{{WRAPPER}} .format-standard.format-no_featured .blog-post_title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-link.format-no_featured .blog-post_title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-video.format-no_featured .blog-post_title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-gallery.format-no_featured .blog-post_title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-quote.format-no_featured .blog-post_title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-audio.format-no_featured .blog-post_title a' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_standard_headings_color_hover',
            array(
                'label' => esc_html__( 'Hover' , 'medify-core' ),
            )
        );

        $this->add_control(
            'custom_standard_hover_headings_color',
            array(
                'label' => esc_html__( 'Title Hover Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($theme_color),
                'selectors' => array(
                    '{{WRAPPER}} .format-standard.format-no_featured .blog-post_title a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-link.format-no_featured .blog-post_title a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-video.format-no_featured .blog-post_title a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-gallery.format-no_featured .blog-post_title a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-quote.format-no_featured .blog-post_title a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-audio.format-no_featured .blog-post_title a:hover' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'hr_meta_color',
            array(
                'type' => Controls_Manager::DIVIDER,
            )
        );

        $this->start_controls_tabs( 'tabs_meta_standard_info' );

        $this->start_controls_tab(
            'tab_meta_standard_info_normal',
            [
                'label' => esc_html__( 'Normal', 'medify-core' ),
            ]
        );

        $this->add_control(
            'custom_meta_standard_color',
            array(
                'label' => esc_html__( 'Meta Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($main_font_color),
                'selectors' => array(
                    '{{WRAPPER}} .format-no_featured .meta-wrapper' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-no_featured .meta-wrapper a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-no_featured .blog-post_meta-categories span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-no_featured .blog-post_likes-wrap .sl-count' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-no_featured .share_post-container > a' => 'color: {{VALUE}};',
                ),
            )
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_meta_standard_hover',
            [
                'label' => esc_html__( 'Hover', 'medify-core' ),
            ]
        );

        $this->add_control(
            'custom_meta_standard_color_hover',
            array(
                'label' => esc_html__( 'Meta Hover Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($theme_color),
                'selectors' => array(
                    '{{WRAPPER}} .format-no_featured .blog-post_meta-categories:hover a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-no_featured .blog-post_meta-categories:hover span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-no_featured .blog-post_likes-wrap:hover .sl-count' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-no_featured .meta-wrapper a:hover' => 'color: {{VALUE}};',
                ),
            )
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'hr_content_color',
            array(
                'type' => Controls_Manager::DIVIDER,
            )
        );

        $this->add_control(
            'custom_standard_content_color',
            array(
                'label' => esc_html__( 'Content Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($main_font_color),
                'selectors' => array(
                    '{{WRAPPER}} .format-standard.format-no_featured .blog-post_text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-link.format-no_featured .blog-post_text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-video.format-no_featured .blog-post_text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-gallery.format-no_featured .blog-post_text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-quote.format-no_featured .blog-post_text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .format-audio.format-no_featured .blog-post_text' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'hr_bg_color',
            array(
                'type' => Controls_Manager::DIVIDER,
            )
        );


        $this->add_control(
            'custom_blog_bg_item',
            array(
                'label'        => esc_html__('Custom Items Background','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'custom_bg_color',
                'label' => esc_html__( 'Background', 'medify-core' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'default'  => 'rgba(247,247,247,1)',
                'condition'     => [
                    'custom_blog_bg_item'   => 'yes',
                ],
                'selector' => '{{WRAPPER}} .blog-style-hero .blog-post-hero_wrapper',
            )
        );

        $this->add_control(
            'custom_blog_bg_item_hover',
            array(
                'label'        => esc_html__('Custom Items Hover Background','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'custom_bg_color_hover',
                'label' => esc_html__( 'Hover Background', 'medify-core' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'default'  => 'rgba(247,247,247,1)',
                'condition'     => [
                    'custom_blog_bg_item_hover'   => 'yes',
                ],
                'selector' => '{{WRAPPER}} .blog-style-hero .blog-post-hero_wrapper:hover',
            )
        );

        $this->end_controls_section();

    }

    protected function render() {
        $atts = $this->get_settings_for_display();

        $blog = new WglBlogHero();
        echo $blog->render($atts);
    }

}