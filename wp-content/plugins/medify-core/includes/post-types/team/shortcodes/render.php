<?php
if ( !class_exists('Medify_Theme_Helper') ) { return; }

class WglTeam {

	private $shortcodeName;
	public $post_count;

	public function __construct() {
		$this->shortcodeName = 'wgl_team';
		add_action('vc_before_init', array($this, 'shortcodesMap'));
		$this->addShortcode();
	}

	public function shortcodesMap(){
		require_once(WP_PLUGIN_DIR . '/' .trim(dirname(plugin_basename(__FILE__)), '/'). '/options.php');
	}

	public function addShortcode(){
		add_shortcode($this->shortcodeName, array($this, 'render'));
	}

	public function render($atts, $content = null){
		$theme_color = esc_attr(Medify_Theme_Helper::get_option('theme-custom-color'));
		$theme_color_secondary = esc_attr(Medify_Theme_Helper::get_option('theme-secondary-color'));
		$header_font = esc_attr(Medify_Theme_Helper::get_option('header-font')['color']);

		$defaults = array(
			// General
			'posts_per_line' => '3',
			'info_align' => 'left',
			'grid_gap' => '30',
			'single_link_wrapper' => false,
			'single_link_heading' => true,
			'hide_title' => false,
			'hide_department' => false,
			'hide_soc_icons' => false,
			'hide_content' => true,
			'letter_count' => '',
			'item_el_class' => '',
			'animation_class' => '',
			// Carousel
			'use_carousel' => false,
			'autoplay' => false,
			'carousel_infinite' => false,
			'scroll_items' => false,
			'center_mode' => false,
			'autoplay_speed' => '3000',
			'use_pagination' => false,
			'pag_type' => 'circle',
			'pag_offset' => '',
			'custom_pag_color' => false,
			'pag_color' => $theme_color,
			'use_prev_next' => false,
			'custom_buttons_color' => false,
			'buttons_color' => $theme_color,
			'custom_resp' => false,
			'resp_medium' => '1025',
			'resp_medium_slides' => '',
			'resp_tablets' => '800',
			'resp_tablets_slides' => '',
			'resp_mobile' => '480',
			'resp_mobile_slides' => '',
			// Colors
			'bg_color_type' => 'def',
			'background_color' => '#ffffff',
			'background_hover_color' => '#ffffff',
			'custom_title_color' => false,
			'title_color' => $header_font,
			'title_hover_color' => $theme_color,
			'custom_depart_color' => false,
			'depart_color' => $theme_color_secondary,
			'custom_soc_color' => false,
			'soc_color' => '#cfd1df',
			'soc_hover_color' => $theme_color,
			'custom_soc_bg_color' => false,
			'soc_bg_color' => '#f3f3f3',
			'soc_bg_hover_color' => '#f3f3f3',
		);

		$atts = vc_shortcode_attribute_parse($defaults, $atts);

		// Animation
		$atts['animation_class'] .= !empty($atts['css_animation']) ? $this->getCSSAnimation( $atts['css_animation'] ) : '';
		extract($atts);

		if ((bool)$use_carousel) {
			// carousel options array
			$carousel_options_arr = array(
				'slide_to_show' => $posts_per_line,
				'autoplay' => $autoplay,
				'autoplay_speed' => $autoplay_speed,
				'use_pagination' => $use_pagination,
				'pag_type' => $pag_type,
				'pag_offset' => $pag_offset,
				'custom_pag_color' => $custom_pag_color,
				'pag_color' => $pag_color,
				'use_prev_next' => $use_prev_next,
				'custom_prev_next_color' => $custom_buttons_color,
				'prev_next_color' => $buttons_color,
				'custom_resp' => $custom_resp,
				'resp_medium' => $resp_medium,
				'resp_medium_slides' => $resp_medium_slides,
				'resp_tablets' => $resp_tablets,
				'resp_tablets_slides' => $resp_tablets_slides,
				'resp_mobile' => $resp_mobile,
				'resp_mobile_slides' => $resp_mobile_slides,
				'infinite' => $carousel_infinite,
				'slides_to_scroll' => $scroll_items,
				'center_mode'   => $center_mode,    
			);

			// carousel options
			$carousel_options = array_map(function($k, $v) { return "$k=\"$v\" "; }, array_keys($carousel_options_arr), $carousel_options_arr);
			$carousel_options = implode('', $carousel_options);

			wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);
		}

		$team_classes = $team_id = $team_id_attr = '';

		if ((bool)$custom_title_color || (bool)$custom_depart_color || (bool)$custom_soc_color || (bool)$custom_soc_bg_color || $bg_color_type != 'def') {
			$team_id = uniqid( "medify_team_" );
			$team_id_attr = 'id='.$team_id;
		}

		// Custom styles
		ob_start();
			if ((bool)$custom_title_color) {
				echo "#$team_id .team-title{
						  color: ".(!empty($title_color) ? esc_attr($title_color) : 'transparent').";
					  }";
				echo "#$team_id .team-title:hover{
						  color: ".(!empty($title_hover_color) ? esc_attr($title_hover_color) : 'transparent').";
					  }";
			}
			if ((bool)$custom_depart_color) {
				echo "#$team_id .team-department{
						  color: ".(!empty($depart_color) ? esc_attr($depart_color) : 'transparent').";
					  }";
			}
			if ((bool)$custom_soc_color) {
				echo "#$team_id .team-info_icons{
						  color: ".(!empty($soc_color) ? esc_attr($soc_color) : 'transparent').";
					  }";
				echo "#$team_id .team-info_icons .team-icon:hover{
						  color: ".(!empty($soc_hover_color) ? esc_attr($soc_hover_color) : 'transparent').";
					  }";
			}
			if ((bool)$custom_soc_bg_color) {
				echo "#$team_id .team-info_icons{
						  background: ".(!empty($soc_bg_color) ? esc_attr($soc_bg_color) : 'transparent').";
					  }";
				echo "#$team_id .team-item_content:hover .team-info_icons{
						  background: ".(!empty($soc_bg_hover_color) ? esc_attr($soc_bg_hover_color) : 'transparent').";
					  }";
			}
			if ($bg_color_type == 'color') {
				echo "#$team_id .team-item_content{
						  background: ".(!empty($background_color) ? esc_attr($background_color) : '#ffffff').";
					  }";
				echo "#$team_id .team-item_content:hover{
						  background: ".(!empty($background_hover_color) ? esc_attr($background_hover_color) : '#ffffff').";
					  }";
			}
		$styles = ob_get_clean();
		Medify_shortcode_css()->enqueue_medify_css($styles);

		$style_gap = ($grid_gap != '0') ? ' style="margin-right:-'.esc_attr($grid_gap/2).'px; margin-left:-'.esc_attr($grid_gap/2).'px;"' : '';
		$team_classes .= 'team-col_'.$posts_per_line;
		$team_classes .= ' a'.$info_align;
		
		ob_start();
			render_wgl_team($atts);
		$team_items = ob_get_clean();
		ob_start();
		?>

		<div <?php echo esc_attr($team_id_attr); ?> class="wgl_module_team <?php echo esc_attr($team_classes); ?>">
			<div class="team-items_wrap" <?php echo Medify_Theme_Helper::render_html($style_gap);?> >
				<?php
				switch ((bool)$use_carousel) {
					case true: echo do_shortcode('[wgl_carousel '.$carousel_options.']'.$team_items.'[/wgl_carousel]'); break;
					default: echo Medify_Theme_Helper::render_html($team_items); break;
				}
				?>
			</div>
		</div>
		
		<?php
		$render = ob_get_clean();
		return $render;
	}
}