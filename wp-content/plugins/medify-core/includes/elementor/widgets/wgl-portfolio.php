<?php
namespace WglAddons\Widgets;

use WglAddons\Includes\Wgl_Loop_Settings;
use WglAddons\Includes\Wgl_Carousel_Settings;
use WglAddons\Templates\WglPortfolio;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wgl_Portfolio extends Widget_Base {

    public function get_name() {
        return 'wgl-portfolio';
    }

    public function get_title() {
        return esc_html__('Wgl Portfolio', 'medify-core' );
    }

    public function get_icon() {
        return 'wgl-portfolio';
    }

    public function get_categories() {
        return [ 'wgl-extensions' ];
    }

    public function get_script_depends() {
        return [
            'slick',
            'imagesloaded',
            'isotope',
            'wgl-elementor-extensions-widgets',
        ];
    }

    // Adding the controls fields for the premium title
    // This will controls the animation, colors and background, dimensions etc
    protected function register_controls() {
        $theme_color = esc_attr(\Medify_Theme_Helper::get_option('theme-custom-color'));
        $second_color = esc_attr(\Medify_Theme_Helper::get_option('theme-secondary-color'));
        $third_color = esc_attr(\Medify_Theme_Helper::get_option('theme-third-color'));
        $header_font_color = esc_attr(\Medify_Theme_Helper::get_option('header-font')['color']);
        $main_font_color = esc_attr(\Medify_Theme_Helper::get_option('main-font')['color']);

        /* Start General Settings Section */
        $this->start_controls_section('wgl_portfolio_section',
            array(
                'label'         => esc_html__('Settings', 'medify-core'),
            )
        );

        $this->add_control('portfolio_layout',
            array(
                'label'         => esc_html__( 'Layout', 'medify-core' ),
                'type'          => 'wgl-radio-image',
                'options'       => [
                    'grid'      => [
                        'title'=> esc_html__( 'Grid', 'medify-core' ),
                        'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_composer_addon/icons/layout_grid.png',
                    ],
                    'carousel'     => [
                        'title'=> esc_html__( 'Carousel', 'medify-core' ),
                        'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_composer_addon/icons/layout_carousel.png',
                    ],
                    'masonry'    => [
                        'title'=> esc_html__( 'Masonry', 'medify-core' ),
                        'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_composer_addon/icons/layout_masonry.png',
                    ],
                    'masonry2'    => [
                        'title'=> esc_html__( 'Masonry 2', 'medify-core' ),
                        'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_composer_addon/icons/layout_masonry.png',
                    ],
                    'masonry3'    => [
                        'title'=> esc_html__( 'Masonry 3', 'medify-core' ),
                        'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_composer_addon/icons/layout_masonry.png',
                    ],
                    'masonry4'    => [
                        'title'=> esc_html__( 'Masonry 4', 'medify-core' ),
                        'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_composer_addon/icons/layout_masonry.png',
                    ],

                ],
                'default'       => 'grid',
            )
        );

        $this->add_control('posts_per_row',
            array(
                'label'             => esc_html__('Columns Amount', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    '1'          => esc_html__('1', 'medify-core'),
                    '2'          => esc_html__('2', 'medify-core'),
                    '3'          => esc_html__('3', 'medify-core'),
                    '4'          => esc_html__('4', 'medify-core'),
                    '5'          => esc_html__('5', 'medify-core'),
                ],
                'default'           => '3',
                'condition'     => [
                    'portfolio_layout'   => array('grid', 'masonry', 'carousel')
                ]
            )
        );

        $this->add_control('grid_gap',
            array(
                'label'             => esc_html__('Grid Gap', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    '0px'          => esc_html__('0', 'medify-core'),
                    '1px'          => esc_html__('1', 'medify-core'),
                    '2px'          => esc_html__('2', 'medify-core'),
                    '3px'          => esc_html__('3', 'medify-core'),
                    '4px'          => esc_html__('4', 'medify-core'),
                    '5px'          => esc_html__('5', 'medify-core'),
                    '10px'          => esc_html__('10', 'medify-core'),
                    '15px'          => esc_html__('15', 'medify-core'),
                    '20px'          => esc_html__('20', 'medify-core'),
                    '25px'          => esc_html__('25', 'medify-core'),
                    '30px'          => esc_html__('30', 'medify-core'),
                    '35px'          => esc_html__('35', 'medify-core'),
                ],
                'default'           => '30px',
            )
        );

        $this->add_control('show_filter',
            array(
                'label'        => esc_html__('Show Filter','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'condition'     => [
                    'portfolio_layout'   => array( 'grid', 'masonry', 'masonry2', 'masonry3', 'masonry4' )
                ]
            )
        );

        $this->add_control('filter_align',
            array(
                'label'             => esc_html__('Filter Align', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    'left'          => esc_html__('Left', 'medify-core'),
                    'right'    		=> esc_html__('Right', 'medify-core'),
                    'center'     	=> esc_html__('Сenter', 'medify-core'),
                ],
                'default'           => 'center',
                'condition'     => [
                    'show_filter'  => 'yes',
                ]
            )
        );

        $this->add_control('crop_images',
            array(
                'label'        => esc_html__('Crop Images','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'default' 		=> 'yes',
            )
        );

        $this->add_control('navigation',
            array(
                'label'             => esc_html__('Navigation Type', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    'none'          => esc_html__('None', 'medify-core'),
                    'pagination'    => esc_html__('Pagination', 'medify-core'),
                    'infinite'    	=> esc_html__('Infinite Scroll', 'medify-core'),
                    'load_more'     => esc_html__('Load More', 'medify-core'),
                ],
                'default'           => 'none',
                'condition'     => [
                    'portfolio_layout'   => array( 'grid', 'masonry', 'masonry2', 'masonry3', 'masonry4' )
                ]
            )
        );

        $this->add_control('nav_align',
            array(
                'label'             => esc_html__('Navigation\'s Alignment', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                	'center'     	=> esc_html__('Сenter', 'medify-core'),
                    'left'          => esc_html__('Left', 'medify-core'),
                    'right'    		=> esc_html__('Right', 'medify-core'),
                ],
                'default'           => 'center',
                'condition'     => [
                    'navigation'  => 'pagination',
                ]
            )
        );

        $this->add_control('items_load',
            array(
                'label'         => esc_html__('Items to be loaded', 'medify-core'),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__('4','medify-core'),
                'condition'     => [
                    'navigation'   =>  array( 'load_more', 'infinite' )
                ]
            )
        );

        $this->add_control('name_load_more',
            array(
                'label'         => esc_html__('Button Text', 'medify-core'),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__('Load More','medify-core'),
                'condition'     => [
                    'navigation'   =>  'load_more'
                ]
            )
        );

        $this->add_control('add_animation',
            array(
                'label'        => esc_html__('Add Appear Animation','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('appear_animation',
            array(
                'label'             => esc_html__('Animation Style', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                	'fade-in'     		=> esc_html__('Fade In', 'medify-core'),
                    'slide-top'         => esc_html__('Slide Top', 'medify-core'),
                    'slide-bottom'    	=> esc_html__('Slide Bottom', 'medify-core'),
                    'slide-left'    	=> esc_html__('Slide Left', 'medify-core'),
                    'slide-right'    	=> esc_html__('Slide Right', 'medify-core'),
                    'zoom'    			=> esc_html__('Zoom', 'medify-core'),
                ],
                'default'           => 'fade-in',
                'condition'     => [
                    'add_animation'  => 'yes',
                ]
            )
        );

        /*End General Settings Section*/
        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  Dispay Section
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'display_section',
            array(
                'label' => esc_html__('Display', 'medify-core' ),
            )
        );

        $this->add_control(
            'click_area',
            array(
                'label'             => esc_html__('Click Item', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    'single'        => esc_html__('Single', 'medify-core'),
                    'popup'         => esc_html__('Popup', 'medify-core'),
                    'custom'        => esc_html__('Custom Link', 'medify-core'),
                    'none'          => esc_html__('Default', 'medify-core'),
                ],
                'default'           => 'popup',
            )
        );

        $this->add_control(
            'single_link_title',
            array(
                'label'        => esc_html__('Add Single Link to Title','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'default'      => 'yes'
            )
        );

        $this->add_control(
            'info_position',
            array(
                'label'             => esc_html__('Show Info Position', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    'inside_image'        => esc_html__('Inside Image', 'medify-core'),
                    'under_image'         => esc_html__('Under Image', 'medify-core'),
                ],
                'default'           => 'inside_image',
            )
        );

        $this->add_control(
            'image_anim',
            array(
                'label'             => esc_html__('Inside Image Animation', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    'simple'        => esc_html__('Simple', 'medify-core'),
                    'sub_layer'     => esc_html__('On Sub-Layer', 'medify-core'),
                    'offset'        => esc_html__('Side Offset', 'medify-core'),
                    'zoom_in'        => esc_html__('Zoom In', 'medify-core'),
                    'outline'        => esc_html__('Outline', 'medify-core'),
                    'always_info'        => esc_html__('Always Show Info', 'medify-core'),
                ],
                'default'           => 'simple',
                'condition'         => [
                    'info_position'   => 'inside_image',
                ]
            )
        );

        $this->add_control(
            'horizontal_align',
            array(
                'label'             => esc_html__('Horizontal Content Align', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    'center'        => esc_html__('Center', 'medify-core'),
                    'left'          => esc_html__('Left', 'medify-core'),
                    'right'         => esc_html__('Right', 'medify-core'),
                ],
                'default'           => 'center',
                'condition'         => [
                    'info_position'   => 'under_image',
                ]
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_section',
            array(
                'label' => esc_html__('Content', 'medify-core' ),
            )
        );

        $this->add_control(
            'gallery_mode',
            array(
                'label'        => esc_html__('Gallery Mode','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'show_portfolio_title',
            array(
                'label'        => esc_html__('Show Title?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'     => [
                    'gallery_mode'  => '',
                ]
            )
        );

        $this->add_control(
            'show_meta_categories',
            array(
                'label'        => esc_html__('Show categories?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'     => [
                    'gallery_mode'  => '',
                ]
            )
        );

        $this->add_control(
            'show_content',
            array(
                'label'        => esc_html__('Show Content?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'condition'     => [
                    'gallery_mode'  => '',
                ]
            )
        );

        $this->add_control(
            'content_letter_count',
            array(
                'label'       => esc_html__('Content Letter Count', 'medify-core'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '85',
                'description' => esc_html__( 'Enter content letter count.', 'integrio-core' ),
                'min'         => 1,
                'step'        => 1,
                'condition'     => [
                    'show_content'  => 'yes',
                    'gallery_mode'  => '',
                ]
            )
        );

        $this->end_controls_section();

        /* Start Carousel General Settings Section */
        $this->start_controls_section('wgl_carousel_section',
            array(
                'label'         => esc_html__('Carousel Options', 'medify-core'),
                'condition'     => [
                    'portfolio_layout'   => 'carousel',
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
            'multiple_items',
            array(
                'label'        => esc_html__('Multiple Items','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'slides_to_scroll',
            array(
                'label'        => esc_html__('Slide One Item per time','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'center_mode',
            array(
                'label'        => esc_html__('Center Mode','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'center_info',
            array(
                'label'        => esc_html__('Show Center Info','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'condition'     => [
                    'center_mode'  => 'yes',
                ]
            )
        );

        $this->add_control(
            'variable_width',
            array(
                'label'        => esc_html__('Variable Width','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
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
            'use_prev_next',
            array(
                'label'        => esc_html__('Add Prev/Next buttons','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'arrows_center_mode',
            array(
                'label'        => esc_html__('Center Mode','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'condition'    => [
                    'use_prev_next'  => 'yes',
                ]
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

        Wgl_Loop_Settings::init( $this, array('post_type' => 'portfolio', 'hide_cats' => true,
                    'hide_tags' => true) );

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section
        /*-----------------------------------------------------------------------------------*/

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section(Headings Section)
        /*-----------------------------------------------------------------------------------*/
        $this->start_controls_section(
            'filter_cats_style_section',
            array(
                'label'     => esc_html__( 'Filter', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'show_filter'   => 'yes',
                ],
            )
        );

        $this->add_responsive_control(
            'filter_cats_padding',
            array(
                'label' => esc_html__( 'Filter padding', 'medify-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'   => [
                    'top'       => 1,
                    'left'      => 6,
                    'right'     => 6,
                    'bottom'    => 1,
                    'unit'      => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .isotope-filter a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_responsive_control(
            'filter_cats_margin',
            array(
                'label' => esc_html__( 'Filter margin', 'medify-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'   => [
                    'top'       => 0,
                    'left'      => 0,
                    'right'     => 25,
                    'bottom'    => 35,
                    'unit'      => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .isotope-filter a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'custom_fonts_filter_cats',
                'selector' => '{{WRAPPER}} .isotope-filter a',
            )
        );


        $this->start_controls_tabs( 'filter_cats_color_tab' );

        $this->start_controls_tab(
            'custom_filter_cats_color_normal',
            array(
                'label' => esc_html__( 'Normal' , 'medify-core' ),
            )
        );

        $this->add_control(
            'filter_cats_color',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($second_color),
                'selectors' => array(
                    '{{WRAPPER}} .isotope-filter a' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'filter_cats_background',
            array(
                'label' => esc_html__( 'Background', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .isotope-filter a' => 'background: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_filter_cats_color_hover',
            array(
                'label' => esc_html__( 'Active' , 'medify-core' ),
            )
        );

        $this->add_control(
            'filter_cats_color_hover',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => array(
                    '{{WRAPPER}} .isotope-filter a.active' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'filter_cats_background_hover',
            array(
                'label' => esc_html__( 'Background', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($second_color),
                'selectors' => array(
                    '{{WRAPPER}} .isotope-filter a.active' => 'background: {{VALUE}};border-bottom-color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'filter_cats_border',
                'label'    => esc_html__( 'Border Type', 'medify-core' ),
                'default' => '1px',
                'selector' => '{{WRAPPER}} .isotope-filter a',
            )
        );

        $this->add_control(
            'filter_cats_radius',
            array(
                'label' => esc_html__( 'Border Radius', 'medify-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'   => [
                    'top'       => 3,
                    'left'      => 3,
                    'right'     => 3,
                    'bottom'    => 3,
                    'unit'      => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .isotope-filter a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'      => 'filter_cats_shadow',
                'selector' =>  '{{WRAPPER}} .isotope-filter a',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'headings_style_section',
            array(
                'label'     => esc_html__( 'Headings', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'custom_fonts_portfolio_headings',
                'selector' => '{{WRAPPER}} .title',
            )
        );

        $this->add_control(
            'h_heading_colors',
            array(
                'label'        => esc_html__('Custom Heading Colors','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->start_controls_tabs( 'headings_color' );

        $this->start_controls_tab(
            'custom_headings_color_normal',
            array(
                'label' => esc_html__( 'Normal' , 'medify-core' ),
                'condition'     => [
                    'h_heading_colors'   => 'yes',
                ],
            )
        );

        $this->add_control(
            'custom_headings_color',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($theme_color),
                'selectors' => array(
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ),
                'condition'     => [
                    'h_heading_colors'   => 'yes',
                ],
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_headings_color_hover',
            array(
                'label' => esc_html__( 'Hover' , 'medify-core' ),
                'condition'     => [
                    'h_heading_colors'   => 'yes',
                ],
            )
        );

        $this->add_control(
            'custom_hover_headings_color',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($theme_color),
                'selectors' => array(
                    '{{WRAPPER}} .title:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .title:hover a' => 'color: {{VALUE}};',
                ),
                'condition'     => [
                    'h_heading_colors'   => 'yes',
                ],
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'cats_style_section',
            array(
                'label'     => esc_html__( 'Categories', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'custom_fonts_portfolio_cats',
                'selector' => '{{WRAPPER}} .post_cats',
            )
        );

        $this->add_control(
            'h_cat_colors',
            array(
                'label'        => esc_html__('Custom Categories Colors','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->start_controls_tabs( 'cats_color_tab' );

        $this->start_controls_tab(
            'custom_cats_color_normal',
            array(
                'label' => esc_html__( 'Normal' , 'medify-core' ),
                'condition'     => [
                    'h_cat_colors'   => 'yes',
                ],
            )
        );

        $this->add_control(
            'cats_color',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($theme_color),
                'selectors' => array(
                    '{{WRAPPER}} .post_cats' => 'color: {{VALUE}};',
                ),
                'condition'     => [
                    'h_cat_colors'   => 'yes',
                ],
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_cats_color_hover',
            array(
                'label' => esc_html__( 'Hover' , 'medify-core' ),
                'condition'     => [
                    'h_cat_colors'   => 'yes',
                ],
            )
        );

        $this->add_control(
            'cat_color_hover',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($theme_color),
                'selectors' => array(
                    '{{WRAPPER}} .post_cats a:hover' => 'color: {{VALUE}};',
                ),
                'condition'     => [
                    'h_cat_colors'   => 'yes',
                ],
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style_section',
            array(
                'label'     => esc_html__( 'Content', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'custom_content',
            array(
                'label'        => esc_html__('Custom Content Colors','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );
        $this->add_control(
            'custom_content_color',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#cccccc',
                'selectors' => array(
                    '{{WRAPPER}} .wgl-portfolio-item_content' => 'color: {{VALUE}};',
                ),
                'condition'     => [
                    'custom_content'   => 'yes',
                ],
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'media_style_section',
            array(
                'label'     => esc_html__( 'Items', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'items_padding',
            array(
                'label' => esc_html__( 'Padding', 'medify-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-portfolio-item_description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'custom_desc_mask_color',
                'label' => esc_html__( 'Background', 'medify-core' ),
                'types' => [ 'classic', 'gradient' ],
                'default'  => esc_attr($theme_color),
                'selector' => '{{WRAPPER}} .wgl-portfolio-item_description',
                'condition'     => [
                    'info_position'   => 'inside_image',
                    'image_anim'   => 'sub_layer',
                ],
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'custom_image_mask_color',
                'label' => esc_html__( 'Background', 'medify-core' ),
                'types' => [ 'classic', 'gradient' ],
                'default'  => 'rgba(14,21,30,.6)',
                'selector' => '{{WRAPPER}} .overlay',
                'condition'     => [
                    'image_anim!'   => 'sub_layer',
                    'info_position'   => 'inside_image',
                ],
            )
        );

        $this->add_control(
            'sec_overlay_color',
            array(
                'label' => esc_html__( 'Secondary Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($theme_color),
                'condition'     => [
                    'image_anim'   => array('offset', 'outline', 'always_info'),
                    'info_position'   => 'inside_image',
                ],
                'selectors' => array(
                    '{{WRAPPER}} .inside_image .overlay:before' => 'box-shadow: inset 0px 0px 0px 0px {{VALUE}}',
                    '{{WRAPPER}} .inside_image:hover .overlay:before' => 'box-shadow: inset 0px 0px 0px 10px {{VALUE}}',
                    '{{WRAPPER}} .inside_image.offset_animation:before' => 'border-color: {{VALUE}}',

                ),
            )
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'load_more_style_section',
            array(
                'label'     => esc_html__( 'Load More', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'navigation'   =>  'load_more'
                ],
            )
        );

        $this->add_responsive_control(
            'load_more_padding',
            array(
                'label' => esc_html__( 'Load More Padding', 'medify-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'   => [
                    'top'       => 15,
                    'left'      => 52,
                    'right'     => 52,
                    'bottom'    => 15,
                    'unit'      => 'px',
                    'isLinked'  => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .load_more_wrapper .load_more_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_responsive_control(
            'load_more_margin',
            array(
                'label' => esc_html__( 'Load More margin', 'medify-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'   => [
                    'top'       => 50,
                    'left'      => 0,
                    'right'     => 0,
                    'bottom'    => 0,
                    'unit'      => 'px',
                    'isLinked'  => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .load_more_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'custom_fonts_load_more',
                'selector' => '{{WRAPPER}} .load_more_wrapper .load_more_item',
            )
        );


        $this->start_controls_tabs( 'load_more_color_tab' );

        $this->start_controls_tab(
            'custom_load_more_color_normal',
            array(
                'label' => esc_html__( 'Normal' , 'medify-core' ),
            )
        );

        $this->add_control(
            'load_more_color',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($header_font_color),
                'selectors' => array(
                    '{{WRAPPER}} .load_more_wrapper .load_more_item' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'load_more_background',
            array(
                'label' => esc_html__( 'Background', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .load_more_wrapper .load_more_item' => 'background: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_load_more_color_hover',
            array(
                'label' => esc_html__( 'Hover' , 'medify-core' ),
            )
        );

        $this->add_control(
            'load_more_color_hover',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => array(
                    '{{WRAPPER}} .load_more_wrapper .load_more_item:hover' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'load_more_background_hover',
            array(
                'label' => esc_html__( 'Background', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($header_font_color),
                'selectors' => array(
                    '{{WRAPPER}} .load_more_wrapper .load_more_item:hover' => 'background: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'load_more_border',
                'label'    => esc_html__( 'Border Type', 'medify-core' ),
                'default' => '1px',
                'selector' => '{{WRAPPER}} .load_more_wrapper .load_more_item',
            )
        );

        $this->add_control(
            'load_more_radius',
            array(
                'label' => esc_html__( 'Border Radius', 'medify-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .load_more_wrapper .load_more_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'      => 'load_more_shadow',
                'selector' =>  '{{WRAPPER}} .load_more_wrapper .load_more_item',
            )
        );

        $this->end_controls_section();

        // Gallery Styles

        $this->start_controls_section(
            'gallery_style_section',
            array(
                'label'     => esc_html__( 'Gallery Icon', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'gallery_mode'  => 'yes',
                ]
            )
        );

        $this->add_responsive_control(
            'gallery_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'medify-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-portfolio-item_gallery-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gallery_padding',
            array(
                'label' => esc_html__( 'Padding', 'medify-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-portfolio-item_gallery-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_control(
            'gallery_icon_color',
            array(
                'label' => esc_html__( 'Icon Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($second_color),
                'selectors' => array(
                    '{{WRAPPER}} .wgl-portfolio-item_gallery-icon' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'gallery_icon_bg_color',
            array(
                'label' => esc_html__( 'Background Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => array(
                    '{{WRAPPER}} .wgl-portfolio-item_gallery-icon' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->end_controls_section();

    }

    protected function render() {
        $atts = $this->get_settings_for_display();

       	$portfolio = new WglPortfolio();
        echo $portfolio->render($atts);

    }

}