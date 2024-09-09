<?php
namespace WglAddons\Widgets;

use WglAddons\Includes\Wgl_Icons;
use WglAddons\Includes\Wgl_Loop_Settings;
use WglAddons\Includes\Wgl_Carousel_Settings;
use WglAddons\Templates\WglCountDown;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wgl_CountDown extends Widget_Base {

    public function get_name() {
        return 'wgl-countdown';
    }

    public function get_title() {
        return esc_html__('Wgl Countdown Timer', 'medify-core' );
    }

    public function get_icon() {
        return 'wgl-countdown';
    }

    public function get_categories() {
        return [ 'wgl-extensions' ];
    }

    public function get_script_depends() {
        return [
            'coundown',
            'wgl-elementor-extensions-widgets',
        ];
    }

    // Adding the controls fields for the premium title
    // This will controls the animation, colors and background, dimensions etc
    protected function register_controls() {
        $theme_color = esc_attr(\Medify_Theme_Helper::get_option('theme-custom-color'));
        $header_font_color = esc_attr(\Medify_Theme_Helper::get_option('header-font')['color']);
        $main_font_color = esc_attr(\Medify_Theme_Helper::get_option('main-font')['color']);

        /* Start General Settings Section */
        $this->start_controls_section('wgl_countdown_section',
            array(
                'label'         => esc_html__('Countdown Timer Settings', 'medify-core'),
            )
        );

        $this->add_control('countdown_year',
            array(
                'label'             => esc_html__('Year', 'medify-core'),
                'type'              => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your title', 'medify-core' ),
                'default' => esc_html__( '2020', 'medify-core' ),
                'label_block' => true,
                'description' => esc_html__( 'Example: 2020', 'medify-core' ),
            )
        );

        $this->add_control('countdown_month',
            array(
                'label'             => esc_html__('Month', 'medify-core'),
                'type'              => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '12', 'medify-core' ),
                'default' => esc_html__( '12', 'medify-core' ),
                'label_block' => true,
                'description' => esc_html__( 'Example: 12', 'medify-core' ),
            )
        );

        $this->add_control('countdown_day',
            array(
                'label'             => esc_html__('Day', 'medify-core'),
                'type'              => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '31', 'medify-core' ),
                'default' => esc_html__( '31', 'medify-core' ),
                'label_block' => true,
                'description' => esc_html__( 'Example: 31', 'medify-core' ),
            )
        );

        $this->add_control('countdown_hours',
            array(
                'label'             => esc_html__('Hours', 'medify-core'),
                'type'              => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '24', 'medify-core' ),
                'default' => esc_html__( '24', 'medify-core' ),
                'label_block' => true,
                'description' => esc_html__( 'Example: 24', 'medify-core' ),
            )
        );

        $this->add_control('countdown_min',
            array(
                'label'             => esc_html__('Minutes', 'medify-core'),
                'type'              => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '59', 'medify-core' ),
				'default' => esc_html__( '59', 'medify-core' ),
                'label_block' => true,
				'description' => esc_html__( 'Example: 59', 'medify-core' ),
            )
        );

        /*End General Settings Section*/
        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  Button Section
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section('wgl_countdown_content_section',
            array(
                'label'         => esc_html__('Countdown Timer Content', 'medify-core'),
            )
        );

        $this->add_control('hide_day',
            array(
                'label'        => esc_html__('Hide Days?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('hide_hours',
            array(
                'label'        => esc_html__('Hide Hours?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('hide_minutes',
            array(
                'label'        => esc_html__('Hide Minutes?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('hide_seconds',
            array(
                'label'        => esc_html__('Hide Seconds?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        $this->add_control('show_value_names',
            array(
                'label'        => esc_html__('Show Value Names?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control('show_separating',
            array(
                'label'        => esc_html__('Show Separating?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'yes',
            )
        );

        /*End General Settings Section*/
        $this->end_controls_section();

        $this->start_controls_section(
            'countdown_style_section',
            array(
                'label'     => esc_html__( 'Style', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control('size',
            array(
                'label'             => esc_html__('Countdown Size', 'medify-core'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    'large'         => esc_html__('Large', 'medify-core'),
                    'medium'        => esc_html__('Medium', 'medify-core'),
                    'small'         => esc_html__('Small', 'medify-core'),
                    'custom'        => esc_html__('Custom', 'medify-core'),
                ],
                'default'           => 'small'
            )
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label'             => esc_html__('Number Typography', 'medify-core'),
                'name' => 'custom_fonts_number',
                'selector' => '{{WRAPPER}} .wgl-countdown .countdown-section .countdown-amount',
                'condition'         => [
                    'size'   => 'custom'
                ]
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label'             => esc_html__('Text Typography', 'medify-core'),
                'name' => 'custom_fonts_text',
                'selector' => '{{WRAPPER}} .wgl-countdown .countdown-section .countdown-period',
                'condition'         => [
                    'size'   => 'custom'
                ]
            )
        );

        $this->add_control(
            'number_text_color',
            array(
                'label' => esc_html__( 'Number Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#323232',
                'selectors' => [
                    '{{WRAPPER}} .wgl-countdown .countdown-section .countdown-amount' => 'color: {{VALUE}};',
                ],
            )
        );

        $this->add_control(
            'number_text_bg_color',
            array(
                'label' => esc_html__( 'Number Background Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wgl-countdown .countdown-section .countdown-amount' => 'background-color: {{VALUE}};',
                ],
            )
        );

        $this->add_control(
            'period_text_color',
            array(
                'label' => esc_html__( 'Text Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wgl-countdown .countdown-section .countdown-period' => 'color: {{VALUE}};',
                ],
            )
        );

        $this->add_control(
            'separating_color',
            array(
                'label' => esc_html__( 'Separating Points Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wgl-countdown .countdown-section:not(:last-child) .countdown-amount:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .wgl-countdown .countdown-section:not(:last-child) .countdown-amount:after' => 'background-color: {{VALUE}};',
                ],
                'condition'         => [
                    'show_separating'   => 'yes'
                ]
            )
        );

        /*End Style Section*/
        $this->end_controls_section();
    }

    protected function render() {
        $atts = $this->get_settings_for_display();

       	$countdown = new WglCountDown();
        echo $countdown->render($this, $atts);

    }

}