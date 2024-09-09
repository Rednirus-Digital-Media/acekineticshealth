<?php


if (!class_exists( 'RWMB_Loader' )) {
	return;
}
class Medify_Metaboxes{
	public function __construct(){
		// Team Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'team_meta_boxes' ) );

		// Portfolio Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'portfolio_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'portfolio_post_settings_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'portfolio_related_meta_boxes' ) );

		// Blog Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'blog_settings_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'blog_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'blog_related_meta_boxes' ));

		// Page Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_layout_meta_boxes' ) );
		// Colors Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_color_meta_boxes' ) );
		// Logo Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_logo_meta_boxes' ) );
		// Header Builder Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_header_meta_boxes' ) );
		// Title Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_title_meta_boxes' ) );
		// Side Panel Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_side_panel_meta_boxes' ) );

		// Social Shares Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_soc_icons_meta_boxes' ) );
		// Footer Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_footer_meta_boxes' ) );
		// Copyright Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_copyright_meta_boxes' ) );

		// Shop Single Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'shop_catalog_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'shop_single_meta_boxes' ) );
	}

	public function team_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Team Options', 'medify' ),
	        'post_types' => array( 'team' ),
	        'context'    => 'advanced',
	        'fields'     => array(
	        	array(
		            'name' => esc_html__( 'Info Name Department', 'medify' ),
		            'id'   => 'department_name',
		            'type' => 'text',
		            'class' => 'name-field'
		        ),
	        	array(
		            'name' => esc_html__( 'Member Department', 'medify' ),
		            'id'   => 'department',
		            'type' => 'text',
		            'class' => 'field-inputs'
				),
				array(
		            'name' => esc_html__( 'Member Since', 'medify' ),
		            'id'   => 'department_since',
		            'type' => 'text',
		            'class' => 'field-inputs'
				),
				array(
					'name' => esc_html__( 'Member Info', 'medify' ),
		            'id'   => 'info_items',
		            'type' => 'social',
		            'clone' => true,
		            'sort_clone'     => true,
		            'options' => array(
						'name'    => array(
							'name' => esc_html__( 'Name', 'medify' ),
							'type_input' => 'text'
						),
						'description' => array(
							'name' => esc_html__( 'Description', 'medify' ),
							'type_input' => 'text'
						),
						'link' => array(
							'name' => esc_html__( 'Link', 'medify' ),
							'type_input' => 'text'
						),
					),
		        ),
		        array(
					'name'     => esc_html__( 'Social Icons', 'medify' ),
					'id'          => "soc_icon",
					'type'        => 'select_icon',
					'options'     => WglAdminIcon()->get_icons_name(),
					'clone' => true,
					'sort_clone'     => true,
					'placeholder' => esc_html__( 'Select an icon', 'medify' ),
					'multiple'    => false,
					'std'         => 'default',
				),
		        array(
					'name'             => esc_html__( 'Info Background Image', 'medify' ),
					'id'               => "mb_info_bg",
					'type'             => 'file_advanced',
					'max_file_uploads' => 1,
					'mime_type'        => 'image',
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function portfolio_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Portfolio Options', 'medify' ),
	        'post_types' => array( 'portfolio' ),
	        'context'    => 'advanced',
	        'fields'     => array(
	        	array(
					'id'   => 'mb_portfolio_featured_img',
					'name' => esc_html__( 'Show Featured image on single', 'medify' ),
					'type' => 'switch',
					'std'  => 'true',
				),
				array(
					'id'   => 'mb_portfolio_title',
					'name' => esc_html__( 'Show Title on single', 'medify' ),
					'type' => 'switch',
					'std'  => 'true',
				),
				array(
					'id'   => 'mb_portfolio_link',
					'name' => esc_html__( 'Add Custom Link for Portfolio Grid', 'medify' ),
					'type' => 'switch',
				),
				array(
                    'name' => esc_html__( 'Custom Url for Portfolio Grid', 'medify' ),
                    'id'   => 'portfolio_custom_url',
                    'type' => 'text',
					'class' => 'field-inputs',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_portfolio_link','=','1')
						), ),
					),
                ),
                array(
                    'id'   => 'portfolio_custom_url_target',
                    'name' => esc_html__( 'Open Custom Url in New Window', 'medify' ),
                    'type' => 'switch',
                    'std' => 'true',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_portfolio_link','=','1')
						), ),
					),
                ),
				array(
					'name' => esc_html__( 'Info', 'medify' ),
					'id'   => 'mb_portfolio_info_items',
					'type' => 'social',
					'clone' => true,
					'sort_clone' => true,
					'desc' => esc_html__( 'Description', 'medify' ),
					'options' => array(
						'name'    => array(
							'name' => esc_html__( 'Name', 'medify' ),
							'type_input' => 'text'
							),
						'description' => array(
							'name' => esc_html__( 'Description', 'medify' ),
							'type_input' => 'text'
							),
						'link' => array(
							'name' => esc_html__( 'Url', 'medify' ),
							'type_input' => 'text'
							),
					),
		        ),
		        array(
					'name'     => esc_html__( 'Info Description', 'medify' ),
					'id'       => "mb_portfolio_editor",
					'type'     => 'wysiwyg',
					'multiple' => false,
					'desc' => esc_html__( 'Info description is shown in one row with a main info', 'medify' ),
				),
		        array(
					'name'     => esc_html__( 'Categories On/Off', 'medify' ),
					'id'       => "mb_portfolio_single_meta_categories",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'yes'     => esc_html__( 'On', 'medify' ),
						'no'      => esc_html__( 'Off', 'medify' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
		        array(
					'name'     => esc_html__( 'Date On/Off', 'medify' ),
					'id'       => "mb_portfolio_single_meta_date",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'yes'     => esc_html__( 'On', 'medify' ),
						'no'      => esc_html__( 'Off', 'medify' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
		        array(
					'name'     => esc_html__( 'Tags On/Off', 'medify' ),
					'id'       => "mb_portfolio_above_content_cats",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'yes'     => esc_html__( 'On', 'medify' ),
						'no'      => esc_html__( 'Off', 'medify' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
		        array(
					'name'     => esc_html__( 'Share Links On/Off', 'medify' ),
					'id'       => "mb_portfolio_above_content_share",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'yes'     => esc_html__( 'On', 'medify' ),
						'no'      => esc_html__( 'Off', 'medify' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function portfolio_post_settings_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Portfolio Post Settings', 'medify' ),
	        'post_types' => array( 'portfolio' ),
	        'context'    => 'advanced',
	        'fields'     => array(
				array(
					'name'     => esc_html__( 'Post Layout', 'medify' ),
					'id'       => "mb_portfolio_post_conditional",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'custom'  => esc_html__( 'Custom', 'medify' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
				array(
					'name'     => esc_html__( 'Post Layout Settings', 'medify' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_post_conditional','=','custom')
						)),
					),
				),
				array(
					'name'    => esc_html__( 'Post Content Layout', 'medify' ),
					'id'      => "mb_portfolio_single_type_layout",
					'type'    => 'button_group',
					'options' => array(
						'1' => esc_html__( 'Title First', 'medify' ),
						'2' => esc_html__( 'Image First', 'medify' ),
						'3' => esc_html__( 'Overlay Image', 'medify' ),
						'4' => esc_html__( 'Overlay Image with Info', 'medify' ),
					),
					'multiple'   => false,
					'std'        => '1',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_portfolio_post_conditional','=','custom')
						), ),
					),
				),
				array(
					'name'     => esc_html__( 'Alignment', 'medify' ),
					'id'       => "mb_portfolio_single_align",
					'type'     => 'button_group',
					'options'  => array(
						'left' => esc_html__( 'Left', 'medify' ),
						'center' => esc_html__( 'Center', 'medify' ),
						'right' => esc_html__( 'Right', 'medify' ),
					),
					'multiple'   => false,
					'std'        => 'left',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_portfolio_post_conditional','=','custom')
						), ),
					),
				),
				array(
					'name' => esc_html__( 'Spacing', 'medify' ),
					'id'   => 'mb_portfolio_single_padding',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_post_conditional','=','custom'),
							array('mb_portfolio_single_type_layout','!=','1'),
							array('mb_portfolio_single_type_layout','!=','2'),
						)),
					),
					'std' => array(
						'padding-top' => '165',
						'padding-bottom' => '165'
					)
				),
				array(
					'id'   => 'mb_portfolio_parallax',
					'name' => esc_html__( 'Add Portfolio Parallax', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_post_conditional','=','custom'),
							array('mb_portfolio_single_type_layout','!=','1'),
							array('mb_portfolio_single_type_layout','!=','2'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Prallax Speed', 'medify' ),
					'id'   => "mb_portfolio_parallax_speed",
					'type' => 'number',
					'std'  => 0.3,
					'step' => 0.1,
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_post_conditional','=','custom'),
							array('mb_portfolio_single_type_layout','!=','1'),
							array('mb_portfolio_single_type_layout','!=','2'),
							array('mb_portfolio_parallax','=',true),
						)),
					),
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function portfolio_related_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Related Portfolio', 'medify' ),
	        'post_types' => array( 'portfolio' ),
	        'context'    => 'advanced',
	        'fields'     => array(
				array(
					'id'      => 'mb_portfolio_related_switch',
					'name'    => esc_html__( 'Portfolio Related', 'medify' ),
					'type'    => 'button_group',
					'options' => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'on' => esc_html__( 'On', 'medify' ),
						'off' => esc_html__( 'Off', 'medify' ),
					),
					'inline'   => true,
					'multiple' => false,
					'std'      => 'default'
				),
				array(
					'name'     => esc_html__( 'Portfolio Related Settings', 'medify' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),
	        	array(
					'id'   => 'mb_pf_carousel_r',
					'name' => esc_html__( 'Display items carousel for this portfolio post', 'medify' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Title', 'medify' ),
					'id'   => "mb_pf_title_r",
					'type' => 'text',
					'std'  => esc_html__( 'Related Portfolio', 'medify' ),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Categories', 'medify' ),
					'id'   => "mb_pf_cat_r",
					'multiple'    => true,
					'type' => 'taxonomy_advanced',
					'taxonomy' => 'portfolio-category',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),
				array(
					'name'    => esc_html__( 'Columns', 'medify' ),
					'id'      => "mb_pf_column_r",
					'type'    => 'button_group',
					'options' => array(
						'2' => esc_html__( '2', 'medify' ),
						'3' => esc_html__( '3', 'medify' ),
						'4' => esc_html__( '4', 'medify' ),
					),
					'multiple'   => false,
					'std'        => '3',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Number of Related Items', 'medify' ),
					'id'   => "mb_pf_number_r",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 3,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function blog_settings_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Post Settings', 'medify' ),
	        'post_types' => array( 'post' ),
	        'context'    => 'advanced',
	        'fields'     => array(
				array(
					'name'     => esc_html__( 'Post Layout Settings', 'medify' ),
					'type'     => 'wgl_heading',
				),
				array(
					'name'    => esc_html__( 'Post Layout', 'medify' ),
					'id'      => "mb_post_layout_conditional",
					'type'    => 'button_group',
					'options' => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'custom'  => esc_html__( 'Custom', 'medify' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
				array(
					'name'    => esc_html__( 'Post Layout Type', 'medify' ),
					'id'      => "mb_single_type_layout",
					'type'    => 'button_group',
					'options' => array(
						'1' => esc_html__( 'Title First', 'medify' ),
						'2' => esc_html__( 'Image First', 'medify' ),
						'3' => esc_html__( 'Overlay Image', 'medify' ),
					),
					'multiple' => false,
					'std'      => '1',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_post_layout_conditional','=','custom')
							),
						),
					),
				),
				array(
					'name' => esc_html__( 'Spacing', 'medify' ),
					'id'   => 'mb_single_padding_layout_3',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_post_layout_conditional','=','custom'),
							array('mb_single_type_layout','=','3'),
						)),
					),
					'std' => array(
						'padding-top' => '120',
						'padding-bottom' => '0'
					)
				),
				array(
					'id'   => 'mb_single_apply_animation',
					'name' => esc_html__( 'Apply Animation', 'medify' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_post_layout_conditional','=','custom'),
							array('mb_single_type_layout','=','3'),
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Featured Image Settings', 'medify' ),
					'type'     => 'wgl_heading',
				),
				array(
					'name'    => esc_html__( 'Featured Image', 'medify' ),
					'id'      => "mb_featured_image_conditional",
					'type'    => 'button_group',
					'options' => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'custom'  => esc_html__( 'Custom', 'medify' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
				array(
					'name'    => esc_html__( 'Featured Image Settings', 'medify' ),
					'id'      => "mb_featured_image_type",
					'type'    => 'button_group',
					'options' => array(
						'off'  => esc_html__( 'Off', 'medify' ),
						'replace'  => esc_html__( 'Replace', 'medify' ),
					),
					'multiple' => false,
					'std'      => 'off',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_featured_image_conditional','=','custom')
							),
						),
					),
				),
				array(
					'name' => esc_html__( 'Featured Image Replace', 'medify' ),
					'id'   => "mb_featured_image_replace",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array('mb_featured_image_conditional','=','custom'),
							array( 'mb_featured_image_type', '=', 'replace' ),
						)),
					),
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function blog_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Post Format Layout', 'medify' ),
			'post_types' => array( 'post' ),
			'context'    => 'advanced',
			'fields'     => array(
				// Standard Post Format
				array(
					'name'  => esc_html__( 'Standard Post( Enabled only Featured Image for this post format)', 'medify' ),
					'id'    => "post_format_standard",
					'type'  => 'static-text',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('formatdiv','=','0')
						), ),
					),
				),
				// Gallery Post Format
				array(
					'name'  => esc_html__( 'Gallery Settings', 'medify' ),
					'type'  => 'wgl_heading',
				),
				array(
					'name'  => esc_html__( 'Add Images', 'medify' ),
					'id'    => "post_format_gallery",
					'type'  => 'image_advanced',
					'max_file_uploads' => '',
				),
				// Video Post Format
				array(
					'name' => esc_html__( 'Video Settings', 'medify' ),
					'type' => 'wgl_heading',
				),
				array(
					'name' => esc_html__( 'Video Style', 'medify' ),
					'id'   => "post_format_video_style",
					'type' => 'select',
					'options' => array(
						'bg_video' => esc_html__( 'Background Video', 'medify' ),
						'popup' => esc_html__( 'Popup', 'medify' ),
					),
					'multiple' => false,
					'std'      => 'bg_video',
				),
				array(
					'name' => esc_html__( 'Start Video', 'medify' ),
					'id'   => "start_video",
					'type' => 'number',
					'std'  => '0',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('post_format_video_style','=','bg_video'),
						), ),
					),
				),
				array(
					'name' => esc_html__( 'End Video', 'medify' ),
					'id'   => "end_video",
					'type' => 'number',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('post_format_video_style','=','bg_video'),
						), ),
					),
				),
				array(
					'name' => esc_html__( 'oEmbed URL', 'medify' ),
					'id'   => "post_format_video_url",
					'type' => 'oembed',
				),
				// Quote Post Format
				array(
					'name' => esc_html__( 'Quote Settings', 'medify' ),
					'type' => 'wgl_heading',
				),
				array(
					'name' => esc_html__( 'Quote Text', 'medify' ),
					'id'   => "post_format_qoute_text",
					'type' => 'textarea',
				),
				array(
					'name' => esc_html__( 'Author Name', 'medify' ),
					'id'   => "post_format_qoute_name",
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Author Position', 'medify' ),
					'id'   => "post_format_qoute_position",
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Author Avatar', 'medify' ),
					'id'   => "post_format_qoute_avatar",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
				),
				// Audio Post Format
				array(
					'name' => esc_html__( 'Audio Settings', 'medify' ),
					'type' => 'wgl_heading',
				),
				array(
					'name' => esc_html__( 'oEmbed URL', 'medify' ),
					'id'   => "post_format_audio_url",
					'type' => 'oembed',
				),
				// Link Post Format
				array(
					'name' => esc_html__( 'Link Settings', 'medify' ),
					'type' => 'wgl_heading',
				),
				array(
					'name' => esc_html__( 'URL', 'medify' ),
					'id'   => "post_format_link_url",
					'type' => 'url',
				),
				array(
					'name' => esc_html__( 'Text', 'medify' ),
					'id'   => "post_format_link_text",
					'type' => 'text',
				),
			)
		);
		return $meta_boxes;
	}

	public function blog_related_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Related Blog Post', 'medify' ),
	        'post_types' => array( 'post' ),
	        'context'    => 'advanced',
	        'fields'     => array(

	        	array(
					'name'    => esc_html__( 'Related Options', 'medify' ),
					'id'      => "mb_blog_show_r",
					'type'    => 'button_group',
					'options' => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'custom'  => esc_html__( 'Custom', 'medify' ),
						'off'  	  => esc_html__( 'Off', 'medify' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
				array(
					'name' => esc_html__( 'Related Settings', 'medify' ),
					'type' => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_blog_show_r','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Title', 'medify' ),
					'id'   => "mb_blog_title_r",
					'type' => 'text',
					'std'  => esc_html__( 'Related Posts', 'medify' ),
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_blog_show_r','=','custom')
						), ),
					),
				),
				array(
					'name' => esc_html__( 'Categories', 'medify' ),
					'id'   => "mb_blog_cat_r",
					'multiple'    => true,
					'type' => 'taxonomy_advanced',
					'taxonomy' => 'category',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_blog_show_r','=','custom')
						), ),
					),
				),
				array(
					'name' => esc_html__( 'Columns', 'medify' ),
					'id'   => "mb_blog_column_r",
					'type' => 'button_group',
					'options' => array(
						'12' => esc_html__( '1', 'medify' ),
						'6'  => esc_html__( '2', 'medify' ),
						'4'  => esc_html__( '3', 'medify' ),
						'3'  => esc_html__( '4', 'medify' ),
					),
					'multiple'   => false,
					'std'        => '6',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_blog_show_r','=','custom')
						), ),
					),
				),
				array(
					'name' => esc_html__( 'Number of Related Items', 'medify' ),
					'id'   => "mb_blog_number_r",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 2,
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_blog_show_r','=','custom')
							),
						),
					),
				),
	        	array(
					'id'   => 'mb_blog_carousel_r',
					'name' => esc_html__( 'Display items carousel for this blog post', 'medify' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_blog_show_r','=','custom')
							),
						),
					),
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function page_layout_meta_boxes( $meta_boxes ) {

	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Page Layout', 'medify' ),
	        'post_types' => array( 'page' , 'post', 'team', 'practice','portfolio', 'product' ),
	        'context'    => 'advanced',
	        'fields'     => array(
				array(
					'name'    => esc_html__( 'Page Sidebar Layout', 'medify' ),
					'id'      => "mb_page_sidebar_layout",
					'type'    => 'wgl_image_select',
					'options' => array(
						'default' => get_template_directory_uri() . '/core/admin/img/options/1c.png',
						'none'    => get_template_directory_uri() . '/core/admin/img/options/none.png',
						'left'    => get_template_directory_uri() . '/core/admin/img/options/2cl.png',
						'right'   => get_template_directory_uri() . '/core/admin/img/options/2cr.png',
					),
					'std'     => 'default',
				),
				array(
					'name'     => esc_html__( 'Sidebar Settings', 'medify' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),
				array(
					'name'        => esc_html__( 'Page Sidebar', 'medify' ),
					'id'          => "mb_page_sidebar_def",
					'type'        => 'select',
					'placeholder' => 'Select a Sidebar',
					'options'     => medify_get_all_sidebar(),
					'multiple'    => false,
					'attributes'  => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),
				array(
					'name'    => esc_html__( 'Page Sidebar Width', 'medify' ),
					'id'      => "mb_page_sidebar_def_width",
					'type'    => 'button_group',
					'options' => array(
						'9' => esc_html( '25%' ),
						'8' => esc_html( '33%' ),
					),
					'std'  => '9',
					'multiple'   => false,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),
				array(
					'id'   => 'mb_sticky_sidebar',
					'name' => esc_html__( 'Sticky Sidebar On?', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),
				array(
					'name'  => esc_html__( 'Sidebar Side Gap', 'medify' ),
					'id'    => "mb_sidebar_gap",
					'type'  => 'select',
					'options' => array(
						'def' => 'Default',
	                    '0'  => '0',
	                    '15' => '15',
	                    '20' => '20',
	                    '25' => '25',
	                    '30' => '30',
	                    '35' => '35',
	                    '40' => '40',
	                    '45' => '45',
	                    '50' => '50',
					),
					'std'        => 'def',
					'multiple'   => false,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),
	        )
	    );
	    return $meta_boxes;
	}

	public function page_color_meta_boxes( $meta_boxes ) {

	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Page Colors', 'medify' ),
	        'post_types' => array( 'page' , 'post', 'team', 'practice','portfolio' ),
	        'context'    => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Page Colors', 'medify' ),
					'id'       => "mb_page_colors_switch",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'custom'  => esc_html__( 'Custom', 'medify' ),
					),
					'inline'   => true,
					'multiple' => false,
					'std'      => 'default',
				),
				array(
					'name' => esc_html__( 'Colors Settings', 'medify' ),
					'type' => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch', '=', 'custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'General Theme Color', 'medify' ),
	                'id'   => 'mb_page_theme_color',
	                'type' => 'color',
	                'std'  => '#2ea6f7',
					'js_options' => array( 'defaultColor' => '#2ea6f7' ),
	                'validate' => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch', '=', 'custom'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Secondary Color', 'medify' ),
	                'id'   => 'mb_page_theme_secondary_color',
	                'type' => 'color',
	                'std'  => '#54ced4',
					'js_options' => array( 'defaultColor' => '#54ced4' ),
	                'validate' => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch', '=', 'custom'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Third Color', 'medify' ),
	                'id'   => 'mb_page_theme_third_color',
	                'type' => 'color',
	                'std'  => '#ff9e21',
					'js_options' => array( 'defaultColor' => '#ff9e21' ),
	                'validate' => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch', '=', 'custom'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Body Background Color', 'medify' ),
	                'id'   => 'mb_body_background_color',
	                'type' => 'color',
	                'std'  => '#ffffff',
					'js_options' => array( 'defaultColor' => '#ffffff' ),
	                'validate'  => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch', '=', 'custom'),
						)),
					),
	            ),
				array(
					'name' => esc_html__( 'Scroll Up Settings', 'medify' ),
					'type' => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch', '=', 'custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Button Background Color', 'medify' ),
	                'id'   => 'mb_scroll_up_bg_color',
	                'type' => 'color',
	                'std'  => '#ff9e21',
					'js_options' => array( 'defaultColor' => '#ff9e21' ),
	                'validate'  => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch', '=', 'custom'),
						)),
					),
	            ),
	            array(
					'name' => esc_html__( 'Button Arrow Color', 'medify' ),
	                'id'   => 'mb_scroll_up_arrow_color',
	                'type' => 'color',
	                'std'  => '#ffffff',
					'js_options' => array( 'defaultColor' => '#ffffff' ),
	                'validate'  => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch', '=', 'custom'),
						)),
					),
	            ),
	        )
	    );
	    return $meta_boxes;
	}

	public function page_logo_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Logo', 'medify' ),
	        'post_types' => array( 'page', 'post' ),
	        'context'    => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Logo', 'medify' ),
					'id'       => "mb_customize_logo",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'custom'  => esc_html__( 'Custom', 'medify' ),
					),
					'multiple' => false,
					'inline'   => true,
					'std'      => 'default',
				),
				array(
					'name' => esc_html__( 'Logo Settings', 'medify' ),
					'type' => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Header Logo', 'medify' ),
					'id'   => "mb_header_logo",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_logo_height_custom',
					'name' => esc_html__( 'Enable Logo Height', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic' => array( array(
					    	array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Set Logo Height', 'medify' ),
					'id'   => "mb_logo_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 50,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array('mb_customize_logo','=','custom'),
							array('mb_logo_height_custom','=',true)
						)),
					),
				),
				array(
					'name' => esc_html__( 'Sticky Logo', 'medify' ),
					'id'   => "mb_logo_sticky",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_sticky_logo_height_custom',
					'name' => esc_html__( 'Enable Sticky Logo Height', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
					    	array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Set Sticky Logo Height', 'medify' ),
					'id'   => "mb_sticky_logo_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom'),
							array('mb_sticky_logo_height_custom','=',true),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Mobile Logo', 'medify' ),
					'id'   => "mb_logo_mobile",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_mobile_logo_height_custom',
					'name' => esc_html__( 'Enable Mobile Logo Height', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
					    	array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Set Mobile Logo Height', 'medify' ),
					'id'   => "mb_mobile_logo_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom'),
							array('mb_mobile_logo_height_custom','=',true),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Mobile Menu Logo', 'medify' ),
					'id'   => "mb_logo_mobile_menu",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_mobile_logo_menu_height_custom',
					'name' => esc_html__( 'Enable Mobile Logo Height', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
					    	array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Set Mobile Logo Height', 'medify' ),
					'id'   => "mb_mobile_logo_menu_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom'),
							array('mb_mobile_logo_menu_height_custom','=',true),
						)),
					),
				),
	        )
	    );
	    return $meta_boxes;
	}

	public function page_header_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Header', 'medify' ),
	        'post_types' => array( 'page', 'post', 'portfolio', 'product' ),
	        'context'    => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Header Settings', 'medify' ),
					'id'       => "mb_customize_header_layout",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'default', 'medify' ),
						'custom'  => esc_html__( 'custom', 'medify' ),
						'hide'    => esc_html__( 'hide', 'medify' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
	        	array(
					'name'     => esc_html__( 'Header Builder', 'medify' ),
					'id'       => "mb_customize_header",
					'type'     => 'select',
					'options'  => medify_get_custom_preset(),
					'multiple' => false,
					'std'      => 'default',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_header_layout','!=','hide')
						)),
					),
				),
				// It is works
				array(
					'id'   => 'mb_menu_header',
					'name' => esc_html__( 'Menu ', 'medify' ),
					'type' => 'select',
					'options'     => medify_get_custom_menu(),
					'multiple'    => false,
					'std'         => 'default',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_header_layout','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_header_sticky',
					'name' => esc_html__( 'Sticky Header', 'medify' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array('mb_customize_header_layout', '=', 'custom')
						)),
					),
				),
                // It is works
				[
					'id'   => 'mb_mobile_menu_header',
					'name' => esc_html__( 'Mobile Menu ', 'medify' ),
					'type' => 'select',
					'options'     => medify_get_custom_menu(),
					'multiple'    => false,
					'std'         => 'default',
					'attributes' => [
					    'data-conditional-logic'  =>  [ [
							['mb_customize_header_layout','=','custom']
                        ] ],
                    ],
                ],
	        )
		);
		return $meta_boxes;
	}

	public function page_title_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Page Title', 'medify' ),
			'post_types' => array( 'page', 'post', 'team', 'practice', 'portfolio', 'product' ),
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'id'      => 'mb_page_title_switch',
					'name'    => esc_html__( 'Page Title', 'medify' ),
					'type'    => 'button_group',
					'options' => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'on'      => esc_html__( 'On', 'medify' ),
						'off'     => esc_html__( 'Off', 'medify' ),
					),
					'std'      => 'default',
					'inline'   => true,
					'multiple' => false
				),
				array(
					'name' => esc_html__( 'Page Title Settings', 'medify' ),
					'type' => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'id'   => 'mb_page_title_bg_switch',
					'name' => esc_html__( 'Use Background?', 'medify' ),
					'type' => 'switch',
					'std'  => true,
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=' ,'on' )
						)),
					),
				),
				array(
					'id'         => 'mb_page_title_bg',
					'name'       => esc_html__( 'Background', 'medify' ),
					'type'       => 'wgl_background',
				    'image'      => '',
				    'position'   => 'center bottom',
				    'attachment' => 'scroll',
				    'size'       => 'cover',
				    'repeat'     => 'no-repeat',
					'color'      => '#f5f5f5',
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=', 'on' ),
							array( 'mb_page_title_bg_switch', '=', true ),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Height', 'medify' ),
					'id'   => 'mb_page_title_height',
					'type' => 'number',
					'std'  => 300,
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=', 'on' ),
							array( 'mb_page_title_bg_switch', '=', true ),
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Title Alignment', 'medify' ),
					'id'       => 'mb_page_title_align',
					'type'     => 'button_group',
					'options'  => array(
						'left'   => esc_html__( 'left', 'medify' ),
						'center' => esc_html__( 'center', 'medify' ),
						'right'  => esc_html__( 'right', 'medify' ),
					),
					'std'      => 'center',
					'multiple' => false,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=' ,'on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Paddings Top/Bottom', 'medify' ),
					'id'   => 'mb_page_title_padding',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array(
						'padding-top'    => '188',
						'padding-bottom' => '88',
					),
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=' ,'on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Margin Bottom', 'medify' ),
					'id'   => "mb_page_title_margin",
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'margin',
						'top'    => false,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array( 'margin-bottom' => '40' ),
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'id'   => 'mb_page_title_border_switch',
					'name' => esc_html__( 'Border Top Switch', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Border Top Color', 'medify' ),
					'id'   => 'mb_page_title_border_color',
					'type' => 'color',
					'std'  => '#e5e5e5',
					'js_options' => array(
						'defaultColor' => '#e5e5e5',
					),
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array('mb_page_title_border_switch','=',true)
						)),
					),
				),
				array(
					'id'   => 'mb_page_title_parallax',
					'name' => esc_html__( 'Parallax Switch', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Prallax Speed', 'medify' ),
					'id'   => 'mb_page_title_parallax_speed',
					'type' => 'number',
					'std'  => 0.3,
					'step' => 0.1,
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array( 'mb_page_title_parallax','=',true ),
							array( 'mb_page_title_switch', '=', 'on' ),
						)),
					),
				),
				array(
					'id'   => 'mb_page_change_tile_switch',
					'name' => esc_html__( 'Custom Page Title', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title', 'medify' ),
					'id'   => 'mb_page_change_tile',
					'type' => 'text',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array( 'mb_page_change_tile_switch','=','1' ),
							array( 'mb_page_title_switch', '=', 'on' ),
						)),
					),
				),
				array(
					'id'   => 'mb_page_title_breadcrumbs_switch',
					'name' => esc_html__( 'Show Breadcrumbs', 'medify' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Breadcrumbs Alignment', 'medify' ),
					'id'       => 'mb_page_title_breadcrumbs_align',
					'type'     => 'button_group',
					'options'  => array(
						'left' => esc_html__( 'left', 'medify' ),
						'center' => esc_html__( 'center', 'medify' ),
						'right' => esc_html__( 'right', 'medify' ),
					),
					'std'      => 'center',
					'multiple' => false,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch','=','on' ),
							array( 'mb_page_title_breadcrumbs_switch', '=', '1' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title Typography', 'medify' ),
					'type' => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title Font', 'medify' ),
					'id'   => 'mb_page_title_font',
					'type' => 'wgl_font',
					'options' => array(
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					),
					'std' => array(
						'font-size' => '42',
						'line-height' => '60',
						'color' => '#0a3380',
					),
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title Breadcrumbs Font', 'medify' ),
					'id'   => 'mb_page_title_breadcrumbs_font',
					'type' => 'wgl_font',
					'options' => array(
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					),
					'std' => array(
						'font-size' => '16',
						'line-height' => '24',
						'color' => '#0a3380',
					),
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch','=','on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Responsive Layout', 'medify' ),
					'type' => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
				array(
					'id'   => 'mb_page_title_resp_switch',
					'name' => esc_html__( 'Responsive Layout On/Off', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Screen breakpoint', 'medify' ),
					'id'   => 'mb_page_title_resp_resolution',
					'type' => 'number',
					'std'  => 768,
					'min'  => 1,
					'step' => 1,
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Height', 'medify' ),
					'id'   => 'mb_page_title_resp_height',
					'type' => 'number',
					'std'  => 230,
					'min'  => 0,
					'step' => 1,
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Padding Top/Bottom', 'medify' ),
					'id'   => 'mb_page_title_resp_padding',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array(
						'padding-top'    => '15',
						'padding-bottom' => '40',
					),
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title Font', 'medify' ),
					'id'   => 'mb_page_title_resp_font',
					'type' => 'wgl_font',
					'options' => array(
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					),
					'std' => array(
						'font-size' => '42',
						'line-height' => '60',
						'color' => '#0a3380',
					),
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array(
					'id'   => 'mb_page_title_resp_breadcrumbs_switch',
					'name' => esc_html__( 'Show Breadcrumbs', 'medify' ),
					'type' => 'switch',
					'std'  => 1,
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title Breadcrumbs Font', 'medify' ),
					'id'   => 'mb_page_title_resp_breadcrumbs_font',
					'type' => 'wgl_font',
					'options' => array(
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					),
					'std' => array(
						'font-size' => '16',
						'line-height' => '24',
						'color' => '#0a3380',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
							array('mb_page_title_resp_breadcrumbs_switch','=','1'),
						)),
					),
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function page_side_panel_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Side Panel', 'medify' ),
	        'post_types' => array( 'page' ),
	        'context' => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Side Panel', 'medify' ),
					'id'       => "mb_customize_side_panel",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'custom' => esc_html__( 'Custom', 'medify' ),
					),
					'multiple' => false,
					'inline'   => true,
					'std'      => 'default',
				),
				array(
					'name'     => esc_html__( 'Side Panel Settings', 'medify' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Content Type', 'medify' ),
					'id'       => 'mb_side_panel_content_type',
					'type'     => 'button_group',
					'options'  => array(
						'widgets' => esc_html__( 'Widgets', 'medify' ),
						'pages'   => esc_html__( 'Page', 'medify' )
					),
					'multiple' => false,
					'std'      => 'widgets',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),
				array(
	        		'name'        => 'Select a page',
					'id'          => 'mb_side_panel_page_select',
					'type'        => 'post',
					'post_type'   => 'side_panel',
					'field_type'  => 'select_advanced',
					'placeholder' => 'Select a page',
					'query_args'  => array(
					    'post_status'    => 'publish',
					    'posts_per_page' => - 1,
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_side_panel','=','custom'),
							array('mb_side_panel_content_type','=','pages')
						)),
					),
	        	),
				array(
					'name' => esc_html__( 'Paddings', 'medify' ),
					'id'   => 'mb_side_panel_spacing',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => true,
						'bottom' => true,
						'left'   => true,
					),
					'std' => array(
						'padding-top'    => '105',
						'padding-right'  => '90',
						'padding-bottom' => '105',
						'padding-left'   => '90'
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),

				array(
					'name' => esc_html__( 'Title Color', 'medify' ),
					'id'   => "mb_side_panel_title_color",
					'type' => 'color',
					'std'  => '#ffffff',
					'js_options' => array(
						'defaultColor' => '#ffffff',
					),
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Text Color', 'medify' ),
					'id'   => "mb_side_panel_text_color",
					'type' => 'color',
					'std'  => '#313538',
					'js_options' => array(
						'defaultColor' => '#313538',
					),
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Background Color', 'medify' ),
					'id'   => "mb_side_panel_bg",
					'type' => 'color',
					'std'  => '#ffffff',
					'alpha_channel' => true,
					'js_options' => array(
						'defaultColor' => '#ffffff',
					),
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Text Align', 'medify' ),
					'id'       => "mb_side_panel_text_alignment",
					'type'     => 'button_group',
					'options'  => array(
						'left' => esc_html__( 'Left', 'medify' ),
						'center' => esc_html__( 'Center', 'medify' ),
						'right' => esc_html__( 'Right', 'medify' ),
					),
					'multiple'   => false,
					'std'        => 'center',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_customize_side_panel','=','custom')
						), ),
					),
				),
				array(
					'name' => esc_html__( 'Width', 'medify' ),
					'id'   => "mb_side_panel_width",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 480,
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Position', 'medify' ),
					'id'          => "mb_side_panel_position",
					'type'        => 'button_group',
					'options'     => array(
						'left' => esc_html__( 'Left', 'medify' ),
						'right' => esc_html__( 'Right', 'medify' ),
					),
					'multiple'    => false,
					'std'         => 'right',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_customize_side_panel','=','custom')
							),
						),
					),
				),
	        )
	    );
	    return $meta_boxes;
	}

	public function page_soc_icons_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Social Shares', 'medify' ),
	        'post_types' => array( 'page' ),
	        'context' => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Social Shares', 'medify' ),
					'id'          => "mb_customize_soc_shares",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'on' => esc_html__( 'On', 'medify' ),
						'off' => esc_html__( 'Off', 'medify' ),
					),
					'multiple'    => false,
					'inline'    => true,
					'std'         => 'default',
				),
				array(
					'name'     => esc_html__( 'Choose your share style.', 'medify' ),
					'id'          => "mb_soc_icon_style",
					'type'        => 'button_group',
					'options'     => array(
						'standard' => esc_html__( 'Standard', 'medify' ),
						'hovered' => esc_html__( 'Hovered', 'medify' ),
					),
					'multiple'    => false,
					'std'         => 'standard',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),
				array(
					'id'   => 'mb_soc_icon_position',
					'name' => esc_html__( 'Fixed Position On/Off', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Offset Top(in percentage)', 'medify' ),
					'id'   => 'mb_soc_icon_offset',
					'type' => 'number',
					'std'  => 50,
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
					'desc' => esc_html__( 'Measurement units defined as "percents" while position fixed is enabled, and as "pixels" while position is off.', 'medify' ),
				),
				array(
					'id'   => 'mb_soc_icon_facebook',
					'name' => esc_html__( 'Facebook Share On/Off', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),
				array(
					'id'   => 'mb_soc_icon_twitter',
					'name' => esc_html__( 'Twitter Share On/Off', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),
				array(
					'id'   => 'mb_soc_icon_linkedin',
					'name' => esc_html__( 'Linkedin Share On/Off', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),
				array(
					'id'   => 'mb_soc_icon_pinterest',
					'name' => esc_html__( 'Pinterest Share On/Off', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),
				array(
					'id'   => 'mb_soc_icon_tumblr',
					'name' => esc_html__( 'Tumblr Share On/Off', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),

	        )
	    );
	    return $meta_boxes;
	}

	public function page_footer_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Footer', 'medify' ),
	        'post_types' => array( 'page' ),
	        'context'    => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Footer', 'medify' ),
					'id'       => "mb_footer_switch",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'on'      => esc_html__( 'On', 'medify' ),
						'off'     => esc_html__( 'Off', 'medify' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
				array(
					'name'     => esc_html__( 'Footer Settings', 'medify' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				),
				array(
					'id'   => 'mb_footer_add_wave',
					'name' => esc_html__( 'Add Wave', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Set Wave Height', 'medify' ),
					'id'   => "mb_footer_wave_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 158,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
					    	array('mb_footer_switch','=','on'),
							array('mb_footer_add_wave','=','1')
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Content Type', 'medify' ),
					'id'       => 'mb_footer_content_type',
					'type'     => 'button_group',
					'options'  => array(
						'widgets' => esc_html__( 'Default', 'medify' ),
						'pages'   => esc_html__( 'Page', 'medify' )
					),
					'multiple' => false,
					'std'      => 'widgets',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				),
				array(
	        		'name'        => 'Select a page',
					'id'          => 'mb_footer_page_select',
					'type'        => 'post',
					'post_type'   => 'footer',
					'field_type'  => 'select_advanced',
					'placeholder' => 'Select a page',
					'query_args'  => array(
					    'post_status'    => 'publish',
					    'posts_per_page' => - 1,
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on'),
							array('mb_footer_content_type','=','pages')
						)),
					),
	        	),
				array(
					'name' => esc_html__( 'Paddings', 'medify' ),
					'id'   => 'mb_footer_spacing',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => true,
						'bottom' => true,
						'left'   => true,
					),
					'std' => array(
						'padding-top'    => '85',
						'padding-right'  => '0',
						'padding-bottom' => '10',
						'padding-left'   => '0'
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				),
				array(
					'name'       => esc_html__( 'Background', 'medify' ),
					'id'         => "mb_footer_bg",
					'type'       => 'wgl_background',
				    'image'      => '',
				    'position'   => 'center center',
				    'attachment' => 'scroll',
				    'size'       => 'cover',
				    'repeat'     => 'no-repeat',
					'color'      => '#ffffff',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				),
				array(
					'id'   => 'mb_footer_add_border',
					'name' => esc_html__( 'Add Border Top', 'medify' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Border Color', 'medify' ),
					'id'   => "mb_footer_border_color",
					'type' => 'color',
					'std'  => '#e5e5e5',
					'alpha_channel' => true,
					'js_options' => array(
						'defaultColor' => '#e5e5e5',
					),
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on'),
							array('mb_footer_add_border','=','1'),
						)),
					),
				),
	        ),
	     );
	    return $meta_boxes;
	}

	public function page_copyright_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Copyright', 'medify' ),
	        'post_types' => array( 'page' ),
	        'context' => 'advanced',
	        'fields'     => array(
				array(
					'name'     => esc_html__( 'Copyright', 'medify' ),
					'id'          => "mb_copyright_switch",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'on' => esc_html__( 'On', 'medify' ),
						'off' => esc_html__( 'Off', 'medify' ),
					),
					'multiple'    => false,
					'std'         => 'default',
				),
				array(
					'name'     => esc_html__( 'Copyright Settings', 'medify' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_copyright_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Editor', 'medify' ),
					'id'   => "mb_copyright_editor",
					'type' => 'textarea',
					'cols' => 20,
					'rows' => 3,
					'std'  => 'Copyright © 2019 Medify by WebGeniusLab. All Rights Reserved',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_copyright_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Text Color', 'medify' ),
					'id'   => "mb_copyright_text_color",
					'type' => 'color',
					'std'  => '#838383',
					'js_options' => array(
						'defaultColor' => '#838383',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_copyright_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Background Color', 'medify' ),
					'id'   => "mb_copyright_bg_color",
					'type' => 'color',
					'std'  => '#171a1e',
					'js_options' => array(
						'defaultColor' => '#171a1e',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_copyright_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Paddings', 'medify' ),
					'id'   => 'mb_copyright_spacing',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array(
						'padding-top'    => '10',
						'padding-bottom' => '10',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_copyright_switch','=','on')
						)),
					),
				),
	        ),
	     );
	    return $meta_boxes;

	}

	public function shop_catalog_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Catalog Options', 'medify' ),
	        'post_types' => array( 'product' ),
	        'context'    => 'advanced',
	        'fields'     => array(
	        	array(
					'id'   => 'mb_product_carousel',
					'name' => esc_html__( 'Product Carousel', 'medify' ),
					'type' => 'switch',
					'std'  => '',
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function shop_single_meta_boxes( $meta_boxes ) {

	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Post Settings', 'medify' ),
	        'post_types' => array( 'product' ),
	        'context' => 'advanced',
	        'fields'     => array(
				array(
					'name'     => esc_html__( 'Post Layout', 'medify' ),
					'id'          => "mb_product_layout",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'medify' ),
						'custom' => esc_html__( 'Custom', 'medify' ),
					),
					'multiple'    => false,
					'std'         => 'default',
				),
				array(
					'name'     => esc_html__( 'Product Layout Settings', 'medify' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_product_layout','=','custom')
						)),
					),
				),

				array(
					'name'     => esc_html__( 'Single Image Layout', 'medify' ),
					'id'          => "mb_shop_single_image_layout",
					'type'        => 'wgl_image_select',
					'placeholder' => 'Select a Single Layout',
					'options'     => array(
						'default' => get_template_directory_uri() . '/core/admin/img/options/1c.png',
						'sticky_layout'    => get_template_directory_uri() . '/core/admin/img/options/none.png',
						'image_gallery'    => get_template_directory_uri() . '/core/admin/img/options/2cl.png',
						'full_width_image_gallery' => get_template_directory_uri() . '/core/admin/img/options/2cr.png',
						'with_background'   => get_template_directory_uri() . '/core/admin/img/options/2cr.png',
					),
					'std'         => 'default',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_product_layout','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_shop_layout_with_background',
					'name' => esc_html__( 'Background', 'medify' ),
					'type' => 'color',
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array('mb_product_layout','=','custom'),
							array('mb_shop_single_image_layout','=','with_background'),
						)),
					),
					'js_options' => array(
						'defaultColor' => '#f3f3f3',
					),
					'std'         => '#f3f3f3',
					'validate'  => 'color',
				),
	        ),
	    );
	    return $meta_boxes;
	}

}
new Medify_Metaboxes();

?>