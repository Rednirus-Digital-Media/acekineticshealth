<?php
namespace WglAddons\Modules;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Frontend;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
* Wgl Elementor Section
*
*
* @class        Wgl_Section
* @version      1.0
* @category Class
* @author       WebGeniusLab
*/

class Wgl_Section{

    public function __construct(){

        add_action( 'elementor/init', [ $this, 'add_hooks' ] );
    }

    public function add_hooks() {

        // Add WGL extension control section to Section panel
        add_action( 'elementor/element/section/section_typo/after_section_end', [ $this, 'extened_animation' ], 10, 2 );

        add_action( 'elementor/frontend/section/before_render', [ $this, 'extened_row_render' ], 10, 1 );

    }

    public function extened_row_render(  \Elementor\Element_Base $element  ){

        if( 'section' !== $element->get_name() ) {
            return;
        }

        $settings = $element->get_settings();

        if(isset($settings['add_background_text']) && !empty($settings['add_background_text'])){
            if(isset($settings['add_background_text']) && !empty($settings['add_background_text'])){

                wp_enqueue_script('appear', get_template_directory_uri() . '/js/jquery.appear.js', array(), false, false);
                wp_enqueue_script('anime', get_template_directory_uri() . '/js/anime.min.js', array(), false, false);
                //$element->add_render_attribute( '_wrapper', 'class', 'wgl-background-text_animation' );
            }
        }

    }

    public function extened_animation( $widget, $args ){
        $widget->start_controls_section(
            'extened_animation',
            array(
                'label'     => esc_html__( 'Wgl Extended', 'medify-core' ),
                'tab'       => Controls_Manager::TAB_STYLE
            )
        );

        $widget->add_control(
            'add_background_text',
            array(
                'label'        => esc_html__('Add Background Text?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'add-background-text',
                'prefix_class' => 'wgl-',
            )
        );

        $widget->add_control('background_text',
            array(
                'label'             => esc_html__('Background Text', 'medify-core'),
                'type'              => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' =>  esc_html__('Text', 'medify-core'),
                'selectors' => array(
                    '{{WRAPPER}}.wgl-add-background-text:before' => 'content:"{{VALUE}}"',
                    '{{WRAPPER}} .wgl-background-text' => 'content:"{{VALUE}}"',
                ),
                'condition' => [
                    'add_background_text' => 'add-background-text',
                ],
            )
        );

        $widget->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'background_text_typo',
                'selector' => '{{WRAPPER}}.wgl-add-background-text:before, {{WRAPPER}} .wgl-background-text',
                'condition' => [
                    'add_background_text' => 'add-background-text',
                ],
            )
        );

        $widget->add_responsive_control(
            'background_text_indent',
            [
                'label' => esc_html__( 'Text Indent', 'medify-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vw' ],
                'selectors' => [
                    '{{WRAPPER}}.wgl-add-background-text:before' => 'margin-left: calc({{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} .wgl-background-text .letter:last-child' => 'margin-right: -{{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 30,
                    ],
                ],
                'default' => [
                    'unit' => 'vw',
                    'size' => 8.9,
                ],
                'condition' => [
                    'add_background_text' => 'add-background-text',
                ],
            ]
        );

        $widget->add_control(
            'background_text_color',
            array(
                'label' => esc_html__( 'Color', 'medify-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#f1f1f1',
                'selectors' => array(
                    '{{WRAPPER}}.wgl-add-background-text:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wgl-background-text' => 'color: {{VALUE}};',
                ),
                'condition' => [
                    'add_background_text' => 'add-background-text',
                ],
            )
        );

        $widget->add_responsive_control(
            'background_text_spacing',
            [
                'label' => esc_html__( 'Top Spacing', 'medify-core' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}}.wgl-add-background-text:before' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wgl-background-text' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 400,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'condition' => [
                    'add_background_text' => 'add-background-text',
                ],
            ]
        );

        $widget->add_control(
            'apply_animation_background_text',
            array(
                'label'        => esc_html__('Apply Animation?','medify-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'medify-core' ),
                'label_off'    => esc_html__( 'Off', 'medify-core' ),
                'return_value' => 'animation-background-text',
                'default'      => 'animation-background-text',
                'prefix_class' => 'wgl-',
                'condition' => [
                    'add_background_text' => 'add-background-text',
                ],
            )
        );

        $widget->end_controls_section();
    }

}

?>