<?php
if (!class_exists('Medify_Theme_Helper')) { return; }

$theme_color = esc_attr(Medify_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(Medify_Theme_Helper::get_option('theme-secondary-color'));
$header_font = Medify_Theme_Helper::get_option('header-font');

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'wgl_team',
        'name' => esc_html__( 'Team List', 'medify' ),
        'description' => esc_html__( 'Show Team Grid', 'medify' ),
        'icon' => 'wgl_icon_team',
        'category' => esc_html__( 'WGL Modules', 'medify' ),
        'params' => array(
            // GENERAL TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Columns in Row', 'medify' ),
                'param_name' => 'posts_per_line',
                'admin_label' => true,
                'value' => array(
                    esc_html__( '1 Column', 'medify' ) => '1',
                    esc_html__( '2 Columns', 'medify' ) => '2',
                    esc_html__( '3 Columns', 'medify' ) => '3',
                    esc_html__( '4 Columns', 'medify' ) => '4',
                    esc_html__( '5 Columns', 'medify' ) => '5',
                ),
                'std' => '3',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Team Info Alignment', 'medify' ),
                'param_name' => 'info_align',
                'admin_label' => true,
                'value' => array(
                    esc_html__( 'Left', 'medify' ) => 'left',
                    esc_html__( 'Center', 'medify' ) => 'center',
                    esc_html__( 'Right', 'medify' ) => 'right',
                ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Gap Between Items', 'medify' ),
                'param_name' => 'grid_gap',
                'value' => array(
                    esc_html__( '0px', 'medify' ) => '0',
                    esc_html__( '2px', 'medify' ) => '2',
                    esc_html__( '4px', 'medify' ) => '4',
                    esc_html__( '6px', 'medify' ) => '6',
                    esc_html__( '10px', 'medify' ) => '10',
                    esc_html__( '20px', 'medify' ) => '20',
                    esc_html__( '30px', 'medify' ) => '30',
                ),
                'std' => '30',
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'medify_param_heading',
                'param_name' => 'divider_1',
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Link for Image', 'medify' ),
                'param_name' => 'single_link_wrapper',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Link for Heading', 'medify' ),
                'param_name' => 'single_link_heading',
                'value' => 'true',
                'edit_field_class' => 'vc_col-sm-3',
            ),
			array(
				'type' => 'medify_param_heading',
				'param_name' => 'divider_2',
				'edit_field_class' => 'divider',
			),
            // Hide title checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Title', 'medify' ),
                'param_name' => 'hide_title',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Hide department checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Department', 'medify' ),
                'param_name' => 'hide_department',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Hide socials checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Social Icons', 'medify' ),
                'param_name' => 'hide_soc_icons',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'medify' ),
                'param_name' => 'item_el_class',
                'description' => esc_html__( 'To customly style particular element, use this field to add a class name and then refer to it fron Custom CSS settings.', 'medify' ),
            ),
            // CAROUSEL TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Carousel', 'medify' ),
                'param_name' => 'use_carousel',
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-margin',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Autoplay', 'medify' ),
                'param_name' => 'autoplay',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-1 no-top-padding',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Autoplay Speed', 'medify' ),
                'param_name' => 'autoplay_speed',
                'value' => '3000',
                'description' => esc_html__( 'Value in milliseconds.', 'medify' ),
                'dependency' => array(
                    'element'   => 'autoplay',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'medify_param_heading',
                'param_name' => 'divider_ca_1',
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Infinite Loop Sliding', 'medify' ),
                'param_name' => 'carousel_infinite',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Slide per single item at a time', 'medify' ),
                'param_name' => 'scroll_items',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Center Mode', 'medify' ),
                'param_name' => 'center_mode',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Сarousel pagination style
            array(
                'type' => 'medify_param_heading',
                'heading' => esc_html__( 'Pagination Style', 'medify' ),
                'param_name' => 'h_pag_controls',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'medify' ),
                'param_name' => 'use_pagination',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'medify_radio_image',
                'heading' => esc_html__( 'Pagination Type', 'medify' ),
                'param_name' => 'pag_type',
                'fields' => array(
                    'circle' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle.png',
                        'label' => esc_html__( 'Circle', 'medify' )),
                    'circle_border' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle_border.png',
                        'label' => esc_html__( 'Empty Circle', 'medify' )),
                    'square' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_square.png',
                        'label' => esc_html__( 'Square', 'medify' )),
                    'line' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line.png',
                        'label' => esc_html__( 'Line', 'medify' )),
                    'line_circle' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line_circle.png',
                        'label' => esc_html__( 'Line - Circle', 'medify' )),
                ),
                'value' => 'circle',
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Pagination Top Offset', 'medify' ),
                'param_name' => 'pag_offset',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'medify' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'medify' ),
                'param_name' => 'custom_pag_color',
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Pagination Color', 'medify' ),
                'param_name' => 'pag_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_pag_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Carousel arrows style
            array(
                'type' => 'medify_param_heading',
                'heading' => esc_html__( 'Arrows Style', 'medify' ),
                'param_name' => 'h_arrow_control',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Arrows control', 'medify' ),
                'param_name' => 'use_prev_next',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'medify' ),
                'param_name' => 'custom_buttons_color',
                'dependency' => array(
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Arrows Color', 'medify' ),
                'param_name' => 'buttons_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_buttons_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Responsive settings
            array(
                'type' => 'medify_param_heading',
                'heading' => esc_html__( 'Responsive Settings', 'medify' ),
                'param_name' => 'h_resp',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'medify' ),
                'param_name' => 'custom_resp',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Desktop breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Desktop Screen Breakpoint', 'medify' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'medify' ),
                'param_name' => 'resp_medium_slides',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'medify_param_heading',
                'param_name' => 'divider_ca_2',
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'divider',
            ),
            // Tablet breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Tablet Screen Breakpoint', 'medify' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'medify' ),
                'param_name' => 'resp_tablets_slides',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'medify_param_heading',
                'param_name' => 'divider_ca_3',
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'divider',
            ),
            // Mobile breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Mobile Screen Breakpoint', 'medify' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'medify' ),
                'param_name' => 'resp_mobile_slides',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'medify' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // COLORS TAB
            array(
                'type' => 'medify_param_heading',
                'heading' => esc_html__( 'Background', 'medify' ),
                'param_name' => 'h_bg_styles',
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Background color
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize Backgrounds', 'medify' ),
                'param_name' => 'bg_color_type',
                'value' => array(
                    esc_html__( 'Theme Defaults', 'medify' ) => 'def',
                    esc_html__( 'Color', 'medify' ) => 'color',
                ),
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Background hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'medify' ),
                'param_name' => 'background_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover', 'medify' ),
                'param_name' => 'background_hover_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title styles heading
            array(
                'type' => 'medify_param_heading',
                'heading' => esc_html__( 'Title', 'medify' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Colors', 'medify' ),
            ),
            // Title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'medify' ),
                'param_name' => 'custom_title_color',
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Idle', 'medify' ),
                'param_name' => 'title_color',
                'value' => $header_font['color'],
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Hover', 'medify' ),
                'param_name' => 'title_hover_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // title styles heading
            array(
                'type' => 'medify_param_heading',
                'heading' => esc_html__( 'Department', 'medify' ),
                'param_name' => 'h_depart_styles',
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Color', 'medify' ),
                'param_name' => 'custom_depart_color',
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Department Color', 'medify' ),
                'param_name' => 'depart_color',
                'value' => $theme_color_secondary,
                'dependency' => array(
                    'element' => 'custom_depart_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title styles heading
            array(
                'type' => 'medify_param_heading',
                'heading' => esc_html__( 'Social Icons', 'medify' ),
                'param_name' => 'h_soc_styles',
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'medify' ),
                'param_name' => 'custom_soc_color',
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Idle', 'medify' ),
                'param_name' => 'soc_color',
                'value' => '#cfd1df',
                'dependency' => array(
                    'element' => 'custom_soc_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Hover', 'medify' ),
                'param_name' => 'soc_hover_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_soc_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'medify_param_heading',
                'param_name' => 'divider_co_1',
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'divider',
            ),
            // Title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Backgrounds', 'medify' ),
                'param_name' => 'custom_soc_bg_color',
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'medify' ),
                'param_name' => 'soc_bg_color',
                'value' => '#f3f3f3',
                'dependency' => array(
                    'element' => 'custom_soc_bg_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover', 'medify' ),
                'param_name' => 'soc_bg_hover_color',
                'value' => '#f3f3f3',
                'dependency' => array(
                    'element' => 'custom_soc_bg_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'medify' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
        )
    ));
    Medify_Loop_Settings::init('wgl_team', array( 'hide_cats' => true,
                    'hide_tags' => true));
    class WPBakeryShortCode_wgl_Team extends WPBakeryShortCode{}
}