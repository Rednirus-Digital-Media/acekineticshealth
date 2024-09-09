<?php
namespace WglAddons\Widgets;

use WglAddons\Includes\Wgl_Loop_Settings;
use WglAddons\Includes\Wgl_Carousel_Settings;
use WglAddons\Templates\WglTeam;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wgl_Team extends Widget_Base {

    public function get_name() {
        return 'wgl-team';
    }

    public function get_title() {
        return esc_html__('Wgl Team', 'medify-core' );
    }

    public function get_icon() {
        return 'wgl-team';
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
        $theme_color_secondary = esc_attr(\Medify_Theme_Helper::get_option('theme-secondary-color'));
        $header_font = \Medify_Theme_Helper::get_option('header-font');

        /* Start General Settings Section */
        $this->start_controls_section('wgl_team_section',
            array(
                'label'         => esc_html__('Team Posts Settings', 'medify-core'),
            )
        );

        $this->add_control('posts_per_line',
            array(
                'label'             => esc_html__('Columns in Row', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    '1'          => esc_html__('1', 'medify-core'),
                    '2'          => esc_html__('2', 'medify-core'),
                    '3'          => esc_html__('3', 'medify-core'),
                    '4'          => esc_html__('4', 'medify-core'),
                    '5'          => esc_html__('5', 'medify-core'),
                ],
                'default'           => '3',
            )
        );

        $this->add_control('info_align',
            array(
                'label'             => esc_html__('Team Info Alignment', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    'left'          => esc_html__('Left', 'medify-core'),
                    'center'        => esc_html__('Center', 'medify-core'),
                    'right'         => esc_html__('Right', 'medify-core'),
                ],
                'default'           => 'left',
            )
        );

        $this->add_control('grid_gap',
            array(
                'label'             => esc_html__('Gap Between Items', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    '0'          => esc_html__('0px', 'medify-core'),
                    '2'          => esc_html__('2px', 'medify-core'),
                    '4'          => esc_html__('4px', 'medify-core'),
                    '6'          => esc_html__('6px', 'medify-core'),
                    '10'          => esc_html__('10px', 'medify-core'),
                    '20'          => esc_html__('20px', 'medify-core'),
                    '30'          => esc_html__('30px', 'medify-core'),
                    '40'          => esc_html__('40px', 'medify-core'),
                    '50'          => esc_html__('50px', 'medify-core'),
                    '60'          => esc_html__('60px', 'medify-core'),
                ],
                'default'           => '30',
            )
        );

        $this->add_control('grayscale_anim',
            array(
                'label'        => esc_html__('Add Grayscale Animation','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('info_anim',
            array(
                'label'        => esc_html__('Add Info Fade Animation','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('single_link_wrapper',
            array(
                'label'        => esc_html__('Add Link for Image','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('single_link_heading',
            array(
                'label'        => esc_html__('Add Link for Heading','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control('hide_title',
            array(
                'label'        => esc_html__('Hide Title','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('hide_department',
            array(
                'label'        => esc_html__('Hide Department','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('hide_since',
            array(
                'label'        => esc_html__('Hide Since','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('hide_soc_icons',
            array(
                'label'        => esc_html__('Hide Social Icons','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('hide_content',
            array(
                'label'        => esc_html__('Hide Content','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control('letter_count',
            array(
                'label'       => esc_html__('Content Letters Count', 'medify-core'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '100',
                'min'         => 1,
                'step'        => 1,
                'condition'     => [
                    'hide_content!'  => 'yes',
                ]
            )
        );

        /*End General Settings Section*/
        $this->end_controls_section();

        Wgl_Carousel_Settings::options($this);

        /*-----------------------------------------------------------------------------------*/
        /*  Build Query Section
        /*-----------------------------------------------------------------------------------*/

        Wgl_Loop_Settings::init( $this, array('post_type' => 'team', 'hide_cats' => true,
                    'hide_tags' => true) );

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section
        /*-----------------------------------------------------------------------------------*/

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section(Background Section)
        /*-----------------------------------------------------------------------------------*/
        $this->start_controls_section(
            'background_style_section',
            array(
                'label'     => esc_html__( 'Background', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'bg_color_type',
            array(
                'label'        => esc_html__('Customize Backgrounds','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->start_controls_tabs( 'background_color_tabs' );

        $this->start_controls_tab(
            'custom_background_color_normal',
            array(
                'label' => esc_html__( 'Normal' , 'medify-core' ),
                'condition'     => [
                    'bg_color_type'   => 'yes',
                ],
            )
        );

        $this->add_control(
            'background_color',
            array(
                'label' => esc_html__( 'Background Idle', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($theme_color),
                'selectors' => array(
                    '{{WRAPPER}} .team-item_content' => 'background: {{VALUE}}',
                ),
                'condition'     => [
                    'bg_color_type'   => 'yes',
                ],
            )
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_background_color_hover',
            array(
                'label' => esc_html__( 'Hover' , 'medify-core' ),
                'condition'     => [
                    'bg_color_type'   => 'yes',
                ],
            )
        );

        $this->add_control(
            'background_hover_color',
            array(
                'label' => esc_html__( 'Background Hover', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($theme_color),
                'selectors' => array(
                    '{{WRAPPER}}  .team-item_content:hover' => 'background: {{VALUE}}',
                ),
                'condition'     => [
                    'bg_color_type'   => 'yes',
                ],
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style_section',
            array(
                'label'     => esc_html__( 'Title', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'custom_title_color',
            array(
                'label'        => esc_html__('Customize Colors','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->start_controls_tabs( 'title_color_tabs' );

        $this->start_controls_tab(
            'custom_title_color_normal',
            array(
                'label' => esc_html__( 'Normal' , 'medify-core' ),
                'condition'     => [
                    'custom_title_color'   => 'yes',
                ],
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label' => esc_html__( 'Title Idle', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => $header_font['color'],
                'selectors' => array(
                    '{{WRAPPER}} .team-title' => 'color: {{VALUE}}',
                ),
                'condition'     => [
                    'custom_title_color'   => 'yes',
                ],
            )
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_title_color_hover',
            array(
                'label' => esc_html__( 'Hover' , 'medify-core' ),
                'condition'     => [
                    'custom_title_color'   => 'yes',
                ],
            )
        );

        $this->add_control(
            'title_hover_color',
            array(
                'label' => esc_html__( 'Title Hover', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($theme_color),
                'selectors' => array(
                    '{{WRAPPER}} .team-title:hover' => 'color: {{VALUE}}',
                ),
                'condition'     => [
                    'custom_title_color'   => 'yes',
                ],
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'department_style_section',
            array(
                'label'     => esc_html__( 'Department', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'custom_depart_color',
            array(
                'label'        => esc_html__('Customize Color','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'depart_color',
            array(
                'label' => esc_html__( 'Department Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => $theme_color_secondary,
                'selectors' => array(
                    '{{WRAPPER}} .team-department' => 'color: {{VALUE}}',
                ),
                'condition'     => [
                    'custom_depart_color'   => 'yes',
                ],
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'soc_icons_style_section',
            array(
                'label'     => esc_html__( 'Social Icons', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'custom_soc_color',
            array(
                'label'        => esc_html__('Customize Colors','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->start_controls_tabs( 'soc_color_tabs' );

        $this->start_controls_tab(
            'custom_soc_color_normal',
            array(
                'label' => esc_html__( 'Normal' , 'medify-core' ),
                'condition'     => [
                    'custom_soc_color'   => 'yes',
                ],
            )
        );

        $this->add_control(
            'soc_color',
            array(
                'label' => esc_html__( 'Icon Idle', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => $header_font['color'],
                'selectors' => array(
                    '{{WRAPPER}} .team-info_icons' => 'color: {{VALUE}}',
                ),
                'condition'     => [
                    'custom_soc_color'   => 'yes',
                ],
            )
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_soc_color_hover',
            array(
                'label' => esc_html__( 'Hover' , 'medify-core' ),
                'condition'     => [
                    'custom_soc_color'   => 'yes',
                ],
            )
        );

        $this->add_control(
            'soc_hover_color',
            array(
                'label' => esc_html__( 'Icon Hover', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($theme_color),
                'selectors' => array(
                    '{{WRAPPER}} .team-icon:hover' => 'color: {{VALUE}}',
                ),
                'condition'     => [
                    'custom_soc_color'   => 'yes',
                ],
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'custom_soc_bg_color',
            array(
                'label'        => esc_html__('Customize Backgrounds','medify-core' ),

                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->start_controls_tabs( 'soc_background_tabs' );

        $this->start_controls_tab(
            'custom_soc_bg_normal',
            array(
                'label' => esc_html__( 'Normal' , 'medify-core' ),
                'condition'     => [
                    'custom_soc_bg_color'   => 'yes',
                ],
            )
        );

        $this->add_control(
            'soc_bg_color',
            array(
                'label' => esc_html__( 'Background Idle', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#f3f3f3',
                'selectors' => array(
                    '{{WRAPPER}} .team-info_icons' => 'background: {{VALUE}}',
                ),
                'condition'     => [
                    'custom_soc_bg_color'   => 'yes',
                ],
            )
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_soc_bg_hover',
            array(
                'label' => esc_html__( 'Hover' , 'medify-core' ),
                'condition'     => [
                    'custom_soc_bg_color'   => 'yes',
                ],
            )
        );

        $this->add_control(
            'soc_bg_hover_color',
            array(
                'label' => esc_html__( 'Background Hover', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#f3f3f3',
                'selectors' => array(
                    '{{WRAPPER}} .team-item_content:hover .team-info_icons' => 'background: {{VALUE}}',
                ),
                'condition'     => [
                    'custom_soc_bg_color'   => 'yes',
                ],
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


    }

    protected function render() {
        $atts = $this->get_settings_for_display();

        $team = new WglTeam();
        echo $team->render($atts);

    }

}