<?php
// Shortcode for Tab component
    add_shortcode( 'tab', 'rod_tab' );
    function rod_tab( $rod_tab_atts ) {
        $rod_tab_atts = shortcode_atts( array(
            'id' => -1,
        ), $rod_tab_atts );

        if ( $rod_tab_atts['id'] > 0 ) {
            $rod_tabs_loop = new WP_Query(
                array(
                    'post_type' => 'tab',
                    'p' => $rod_tab_atts['id'],
                    'posts_per_page' => 1,
                )
            );
            ?>
            <?php $rod_tabs_output = ''; ?>

            <?php
            if ( $rod_tabs_loop->have_posts() ) {
                $rod_tabs_output .= '<div id="tabs-jobs">
                  <div class="js-tabs" data-tabs-prefix-class="component">
                  <div class="row">';
                ?>

                <?php
                while ( $rod_tabs_loop->have_posts() ) {
                    $rod_tabs_loop->the_post();
                    $rod_tabs_header = get_post_meta( get_the_ID(), '_rod_tabs_header', true );
                    $rod_tab_media = esc_html( get_post_meta( get_the_ID(), '_rod_tab_sidebar_media', true ) );
                    $rod_tab_details = esc_html( get_post_meta( get_the_ID(), '_rod_tab_sidebar_details', true ) );
                    $rod_tab_reference = esc_html( get_post_meta( get_the_ID(), '_rod_tab_sidebar_reference', true ) );

                    if ( $rod_tab_media == true || $rod_tab_details == true || $rod_tab_reference == true ):
                        $rod_tabs_output .= '<div class="col-lg-8">';
                    else:
                        $rod_tabs_output .= '<div class="col-lg-12">';
                    endif;

                    // tabs intro
                    $rod_tabs_output .= '<div class="tabs-heading tabs-heading--static">' . $rod_tabs_header . '</div>';
                    $rod_tab_id = 1;
                    $rod_tab_groups = get_post_meta( get_the_ID(), '_rod_tab_component', true );

                    foreach ( (array)$rod_tab_groups as $key => $rod_tab_group ) {

                        if ( isset( $rod_tab_group['tab_title'] ) ) {
                            $rod_tab_title = esc_html( $rod_tab_group['tab_title'] );
                        }

                        if ( isset( $rod_tab_group['tab_description'] ) ) {
                            $rod_tab_description = esc_html( $rod_tab_group['tab_description'] );
                        }

                        if ( $rod_tab_title == true && $rod_tab_description == true ) {
                            $rod_tabs_output .= '<div class="js-tabcontent" id="offer-' . $rod_tab_atts['id'] . $rod_tab_id . '">
                            <h3 class="tabs-heading">' . $rod_tab_title . '</h3>
                            <p>' . $rod_tab_description . '</p>
                            </div>';

                        }
                        $rod_tab_id++;
                    }
                    $rod_tabs_output .= '</div>';

                        // tabs sidebar
                        $rod_tabs_output .= '<aside class="col-lg-4 tabs-sidebar">
                        <div class="row">';
                        if( !empty( $rod_tab_media ) ) {
                            $rod_tabs_output .= '<div class="col-sm-6 col-lg-12">
                        <div class="media">';
                            $rod_tabs_attachment_id = attachment_url_to_postid( $rod_tab_media );
                            $rod_tabs_image_alt = get_the_title( $rod_tabs_attachment_id );
                            $rod_tabs_output .= '<img src="' . $rod_tab_media . '" alt="' . $rod_tabs_image_alt . '">';
                            $rod_tabs_output .= '</div>
                        </div>';
                        }
                        ?>

                        <?php
                        $rod_tabs_output .= '<div class="col-sm-6 col-lg-12">';

                        if ( !empty( $rod_tab_details ) ) {
                            $rod_tabs_output .= '<p>' . $rod_tab_details . '</p>';
                        }

                        if ( !empty( $rod_tab_reference ) ) {

                            if ( get_post_meta( get_the_ID(), '_rod_tab_email_as_reference', 1 ) ) {
                                $rod_tabs_output .= '<a class="link link--large" href="mailto:' . $rod_tab_reference . '">' . $rod_tab_reference . '</a>';
                            } else {
                                $rod_tabs_output .= $rod_tab_reference;
                            }

                        }
                        $rod_tabs_output .= '
                      </div>
                      </div>
                      </aside>';

                    $rod_tabs_output .= '</div>';
                    $rod_tabs_output .= '<ul class="js-tablist" data-existing-hx="h3">';
                    $rod_tab_button_id = 1;

                    foreach ( (array)$rod_tab_groups as $key => $rod_tab_group ) {

                        if ( isset( $rod_tab_group['tab_title'] ) ) {
                            $rod_tab_title = esc_html( $rod_tab_group['tab_title'] );
                        }
                        if ( isset( $rod_tab_group['tab_description'] ) ) {
                            $rod_tab_description = esc_html( $rod_tab_group['tab_description'] );
                        }
                        // tabs header
                        if ( $rod_tab_title == true && $rod_tab_description == true ) {
                            $rod_tabs_output .= '<li class="js-tablist__item">
                          <a class="js-tablist__link" href="#offer-' . $rod_tab_atts['id'] . $rod_tab_button_id . '" data-parent="tabs-jobs">' . $rod_tab_title . '</a>
                          </li>';
                        }
                        $rod_tab_button_id++;

                    }
                    $rod_tabs_output .= '</ul>';
                } // endwhile
                $rod_tabs_output .= '</div></div>';
            } // endif
            wp_reset_postdata();
        }

        wp_enqueue_script( 'van11y-accessible-tab-panel-aria', plugin_dir_url( __FILE__ ) . 'js/van11y-accessible-tab-panel-aria/van11y-accessible-tab-panel-aria.min.js', array( 'generic' ), '1', false );

        wp_add_inline_script('van11y-accessible-tab-panel-aria', '
        console.log("a");
            document.addEventListener("DOMContentLoaded", function(event) {
	        "use strict";
	        var rod_scroll = new SmoothScroll();
            // Scroll behavior for tabs component
                var rod_tab_links = document.querySelectorAll(\'.component-tabs__link\');
            
                var rodScrollTab = function() {
                    var rod_tab_anchor = document.querySelector(\'#\' + this.dataset.parent);
            
                    setTimeout(function() { 
                        rod_scroll.animateScroll(rod_tab_anchor);
                    }, 200);
                };
            
                if ( rod_tab_links.length ) {
                    for ( var i = 0; i < rod_tab_links.length; i++ ) {
                        rod_tab_links[i].addEventListener(\'click\', rodScrollTab, false);
                    }
                }
                }
                );' );

        return $rod_tabs_output;
    }

?>