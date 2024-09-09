<?php
update_option( 'wgl_licence_validated', [ 'purchase' => 'purchase', 'email' => 'email' ] );

//Class Theme Helper
require_once ( get_theme_file_path( '/core/class/theme-helper.php' ) );

//Class Theme Cache
require_once ( get_theme_file_path( '/core/class/theme-cache.php' ) );

//Class Walker comments
require_once ( get_theme_file_path( '/core/class/walker-comment.php' ) );

//Class Walker Mega Menu
require_once ( get_theme_file_path( '/core/class/walker-mega-menu.php' ) );

//Class Theme Likes
require_once ( get_theme_file_path( '/core/class/theme-likes.php' ) );

//Class Theme Cats Meta
require_once ( get_theme_file_path( '/core/class/theme-cat-meta.php' ) );

//Class Single Post
require_once ( get_theme_file_path( '/core/class/single-post.php' ) );

//Class Tinymce
require_once ( get_theme_file_path( '/core/class/tinymce-icon.php' ) );

//Class Theme Autoload
require_once ( get_theme_file_path( '/core/class/theme-autoload.php' ) );

//Class Theme Dashboard
require_once ( get_theme_file_path( '/core/class/theme-panel.php' ) );

//Class Theme Verify
require_once ( get_theme_file_path( '/core/class/theme-verify.php' ) );

function medify_content_width() {
    if ( ! isset( $content_width ) ) {
        $content_width = 940;
    }
}
add_action( 'after_setup_theme', 'medify_content_width', 0 );

function medify_theme_slug_setup() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'medify_theme_slug_setup');

add_action('init', 'medify_page_init');
if (!function_exists('medify_page_init')) {
    function medify_page_init()
    {
        add_post_type_support('page', 'excerpt');
    }
}

add_action('admin_init', 'medify_elementor_dom');
if (!function_exists('medify_elementor_dom')) {
    function medify_elementor_dom()
    {
        if(!get_option('wgl_elementor_e_dom') && class_exists('\Elementor\Core\Experiments\Manager')){
            $new_option = \Elementor\Core\Experiments\Manager::STATE_INACTIVE;
			update_option('elementor_experiment-e_dom_optimization', $new_option);
            update_option('wgl_elementor_e_dom', 1);
        }
    }
}

if (!function_exists('medify_main_menu')) {
    function medify_main_menu($location = '') {
        wp_nav_menu([
            'theme_location'  => 'main_menu',
            'menu'  => $location,
            'container' => '',
            'container_class' => '',
            'after' => '',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'walker' => new Medify_Mega_Menu_Waker()
        ]);
    }
}

// return all sidebars
if (!function_exists('medify_get_all_sidebar')) {
    function medify_get_all_sidebar() {
        global $wp_registered_sidebars;
        $out = array();
        if ( empty( $wp_registered_sidebars ) )
            return;
         foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar) :
            $out[$sidebar_id] = $sidebar['name'];
         endforeach;
         return $out;
    }
}

if (!function_exists('medify_get_custom_preset')) {
    function medify_get_custom_preset() {
        $custom_preset = get_option('medify_set_preset');
        $presets =  medify_default_preset();

        $out = array();
        $out['default'] = esc_html__( 'Default', 'medify' );
        $i = 1;
        if(is_array($presets)){
            foreach ($presets as $key => $value) {
                $out[$key] = $key;
                $i++;
            }
        }
        if(is_array($custom_preset)){
            foreach ( $custom_preset as $preset_id => $preset) :
                $out[$preset_id] = $preset_id;
            endforeach;
        }
        return $out;
    }
}

if (!function_exists('medify_get_custom_menu')) {
    function medify_get_custom_menu() {
        $taxonomies = array();

        $menus = get_terms('nav_menu');
        foreach ($menus as $key => $value) {
            $taxonomies[$value->name] = $value->name;
        }
        return $taxonomies;
    }
}

function medify_get_attachment( $attachment_id ) {
    $attachment = get_post( $attachment_id );
    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}

if (!function_exists('medify_reorder_comment_fields')) {
    function medify_reorder_comment_fields($fields ) {
        $new_fields = array();

        $myorder = array('author', 'email', 'url', 'comment');

        foreach( $myorder as $key ){
            $new_fields[ $key ] = isset($fields[ $key ]) ? $fields[ $key ] : '';
            unset( $fields[ $key ] );
        }

        if( $fields ) {
            foreach( $fields as $key => $val ) {
                $new_fields[ $key ] = $val;
            }
        }

        return $new_fields;
    }
}
add_filter('comment_form_fields', 'medify_reorder_comment_fields');

function medify_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'medify_mce_buttons_2' );


function medify_tiny_mce_before_init( $settings ) {

    $settings['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4';
    $header_font_color = esc_attr(\Medify_Theme_Helper::get_option('header-font')['color']);
    $second_color = esc_attr(\Medify_Theme_Helper::get_option('theme-secondary-color'));

    $style_formats = array(
        array(
            'title' => esc_html__( 'Dropcap', 'medify' ),
            'items' => array(
                array(
                    'title' => esc_html__( 'Dropcap', 'medify' ),
                    'inline' => 'span',
                    'classes' => 'dropcap',
                    'styles' => array( 'background-color' => esc_attr( Medify_Theme_Helper::get_option('theme-custom-color') )),
                ),
                array(
                    'title' => esc_html__( 'Dropcap with dark background', 'medify' ),
                    'inline' => 'span',
                    'classes' => 'dropcap-bg',
                    'styles' => array( 'background-color' => esc_attr( $second_color )),
                ),
            ),
        ),
        array(
            'title' => esc_html__( 'Highlighter', 'medify' ),
            'inline' => 'span',
            'classes' => 'highlighter',
            'styles' => array( 'color' => '#ffffff', 'background-color' => esc_attr( Medify_Theme_Helper::get_option('theme-custom-color') )),
        ),
        array(
            'title' => esc_html__( 'Double Heading Font', 'medify' ),
            'inline' => 'span',
            'classes' => 'dbl_font',
        ),
        array(
            'title' => esc_html__( 'Font Weight', 'medify' ),
            'items' => array(
                array( 'title' => esc_html__( 'Default', 'medify' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => 'inherit' ) ),
                array( 'title' => esc_html__( 'Lightest (100)', 'medify' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '100' ) ),
                array( 'title' => esc_html__( 'Lighter (200)', 'medify' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '200' ) ),
                array( 'title' => esc_html__( 'Light (300)', 'medify' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '300' ) ),
                array( 'title' => esc_html__( 'Normal (400)', 'medify' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '400' ) ),
                array( 'title' => esc_html__( 'Medium (500)', 'medify' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '500' ) ),
                array( 'title' => esc_html__( 'Semi-Bold (600)', 'medify' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '600' ) ),
                array( 'title' => esc_html__( 'Bold (700)', 'medify' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '700' ) ),
                array( 'title' => esc_html__( 'Bolder (800)', 'medify' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '800' ) ),
                array( 'title' => esc_html__( 'Extra Bold (900)', 'medify' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '900' ) ),
            )
        ),
        array(
            'title' => esc_html__( 'List Style', 'medify' ),
            'items' => array(
                array( 'title' => esc_html__( 'Check', 'medify' ), 'selector' => 'ul', 'classes' => 'medify_check' ),
                array( 'title' => esc_html__( 'Plus', 'medify' ), 'selector' => 'ul', 'classes' => 'medify_plus' ),
                array( 'title' => esc_html__( 'Dash', 'medify' ), 'selector' => 'ul', 'classes' => 'medify_dash' ),
                array( 'title' => esc_html__( 'Slash', 'medify' ), 'selector' => 'ul', 'classes' => 'medify_slash' ),
                array( 'title' => esc_html__( 'No List Style', 'medify' ), 'selector' => 'ul', 'classes' => 'no-list-style' ),
            )
        ),
    );

    $settings['style_formats'] = str_replace( '"', "'", json_encode( $style_formats ) );
    $settings['extended_valid_elements'] = 'span[*],a[*],i[*]';
    return $settings;
}
add_filter( 'tiny_mce_before_init', 'medify_tiny_mce_before_init' );

function medify_theme_add_editor_styles() {
    add_editor_style( 'css/font-awesome.min.css' );
}
add_action( 'current_screen', 'medify_theme_add_editor_styles' );

function medify_categories_postcount_filter ($variable) {
    if(strpos($variable,'</a> (')){
        $variable = str_replace('</a> (', '</a> <span class="line"></span><span class="post_count">', $variable);
        $variable = str_replace('</a>&nbsp;(', '</a>&nbsp;<span class="post_count">', $variable);
        $variable = str_replace(')', '</span>', $variable);
    }
    else{
        $variable = str_replace('</a> <span class="count">(', '</a><span class="line"></span><span class="post_count">', $variable);
        $variable = str_replace(')', '</span>', $variable);
    }

    $pattern1 = '/cat-item-\d+/';
    preg_match_all( $pattern1, $variable,$matches );
    if(isset($matches[0])){
        foreach ($matches[0] as $key => $value) {
            $int = (int) str_replace('cat-item-','', $value);
            $icon_image_id = get_term_meta ( $int, 'category-icon-image-id', true );
            if(!empty($icon_image_id)){
                $icon_image = wp_get_attachment_image_src ( $icon_image_id, 'full' );
                $icon_image_alt = get_post_meta($icon_image_id, '_wp_attachment_image_alt', true);
                $replacement = '$1<img class="cats_item-image" src="'. esc_url($icon_image[0]) .'" alt="'.(!empty($icon_image_alt) ? esc_attr($icon_image_alt) : '').'"/>';
                $pattern = '/(cat-item-'.$int.'+.*?><a.*?>)/';
                $variable = preg_replace( $pattern, $replacement, $variable );
            }
        }
    }

    return $variable;
}
add_filter('wp_list_categories', 'medify_categories_postcount_filter');

add_filter( 'get_archives_link', 'medify_render_archive_widgets', 10, 6 );
function medify_render_archive_widgets ( $link_html, $url, $text, $format, $before, $after ) {

    $text = wptexturize( $text );
    $url  = esc_url( $url );

    if ( 'link' == $format ) {
        $link_html = "\t<link rel='archives' title='" . esc_attr( $text ) . "' href='$url' />\n";
    } elseif ( 'option' == $format ) {
        $link_html = "\t<option value='$url'>$before $text $after</option>\n";
    } elseif ( 'html' == $format ) {
        $after = str_replace('(', '', $after);
        $after = str_replace(' ', '', $after);
        $after = str_replace('&nbsp;', '', $after);
        $after = str_replace(')', '', $after);

        $after = !empty($after) ? " <span class='line'></span><span class='post_count'>(".esc_html($after).")</span> " : "";

        $link_html = "<li>".esc_html($before)."<a href='".esc_url($url)."'>".esc_html($text)."</a>".$after."</li>";
    } else { // custom
        $link_html = "\t$before<a href='$url'>$text</a>$after\n";
    }

    return $link_html;
}

// Add image size
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'medify-840-620',  840, 620, true  );
    add_image_size( 'medify-440-440',  440, 440, true  );
    add_image_size( 'medify-180-180',  180, 180, true  );
    add_image_size( 'medify-120-120',  120, 120, true  );
}

// Include Woocommerce init if plugin is active
if ( class_exists( 'WooCommerce' ) ) {
    require_once( get_theme_file_path ( '/woocommerce/woocommerce-init.php' ) );
}

add_filter('medify_enqueue_shortcode_css', 'medify_render_css');
function medify_render_css($styles){
    global $medify_dynamic_css;
    if(! isset($medify_dynamic_css['style'])){
        $medify_dynamic_css = array();
        $medify_dynamic_css['style'] = $styles;
    }else{
        $medify_dynamic_css['style'] .= $styles;
    }
}