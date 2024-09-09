<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Medify
 * @since 1.0
 * @version 1.0
 */

get_header();

$sb = Medify_Theme_Helper::render_sidebars();
$row_class = $sb['row_class'];
$column = $sb['column'];
$container_class = $sb['container_class'];

?>
    <div class="wgl-container<?php echo apply_filters('medify_container_class', $container_class); ?>">
        <div class="row<?php echo apply_filters('medify_row_class', $row_class); ?>">
            <div id='main-content' class="wgl_col-<?php echo apply_filters('medify_column_class', $column); ?>">
            <?php
                if ( have_posts() ) :
                ?>
                    <header class="searсh-header">
                        <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'medify' ), '<span>' .get_search_query(). '</span>' ); ?></h1>
                    </header>
                    <?php
                    global $wgl_blog_atts;
                    global $wp_query;
                    $wgl_blog_atts = array(
                        'query' => $wp_query,
                        'animation_class' => '',
                        // General
                        'blog_layout' => 'grid',
                        // Content
                        'blog_columns' => '4',
                        'hide_media' => false,
                        'hide_content' => false,
                        'hide_blog_title' => false,
                        'hide_postmeta' => false,
                        'meta_author' => false,
                        'meta_date' => false,
                        'meta_comments' => false,
                        'meta_categories' => true,
                        'hide_likes' => true,
                        'hide_share' => true,
                        'read_more_hide' => false,
                        'read_more_text' => esc_html__( 'Learn More', 'medify' ),
                        'content_letter_count' => '85',
                        'crop_square_img' => 'true',
                        'heading_tag' => 'h3',
                        'items_load'  => 4,
                        'heading_margin_bottom' => '10px',
                    );
                    extract($wgl_blog_atts);
                    // Row class for grid and massonry
                    if ( in_array($blog_layout, array('grid', 'masonry')) ) {

                        switch ( $blog_columns ) {
                            case '12':
                                $row_class = ' blog_columns-1';
                                break;
                            case '6':
                                $row_class = ' blog_columns-2';
                                break;
                            case '4':
                                $row_class = ' blog_columns-3';
                                break;
                            case '3':
                                $row_class = ' blog_columns-4';
                                break;
                        }

                    }
                    $row_class .= " blog-style-standard";
                    // Render wraper
                    if (have_posts()): ?>
                        <div class="blog-posts blog-posts-list">
                            <?php
                            echo '<div class="container-grid row '. esc_attr($row_class) .'">';
                                get_template_part('templates/post/post-standard');
                            echo '</div>';
                            ?>
                        </div>
                    <?php
                    endif;
                    /* Start the Loop */
                    echo Medify_Theme_Helper::pagination();

                else :
                    ?>
                    <div class="page_404_wrapper">
                        <header class="searсh-header">
                            <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'medify' ); ?></h1>
                        </header>

                        <div class="page-content">
                            <?php if ( is_search() ) : ?>
                                <p class="banner_404_text"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'medify' ); ?></p>
                            <?php else : ?>
                                <p class="banner_404_text"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'medify' ); ?></p>
                            <?php endif; ?>
                            <div class="search_result_form">
                                <?php get_search_form(); ?>
                            </div>
                            <div class="medify_404_button medify_module_button wgl_button wgl_button-xl">
                                <a class="wgl_button_link" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e( 'Take Me Home', 'medify' ); ?></a>
                            </div>
                        </div>
                        
                    </div>
                    <?php
                endif;
                ?>          
            </div>
            <?php
                echo (isset($sb['content']) && !empty($sb['content']) ) ? $sb['content'] : '';
            ?>
        </div>
    </div>

<?php

get_footer(); ?>