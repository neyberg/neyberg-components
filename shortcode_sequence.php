<?php
// Shortcode for Sequence component
    add_shortcode( 'sequence', 'rod_sequence' );
    function rod_sequence( $rod_sequence_atts ) {
        $rod_sequence_atts = shortcode_atts( array(
            'id' => -1,
        ), $rod_sequence_atts );
        if ( $rod_sequence_atts['id'] > 0 ) {
            $rod_sequence_loop = new WP_Query(
                array(
                    'post_type' => 'sequence',
                    'p' => $rod_sequence_atts['id'],
                    'posts_per_page' => 1,
                )
            );
            ?>
            <?php $rod_sequence_output = ''; ?>

            <?php
            if ( $rod_sequence_loop->have_posts() ) {
                $rod_sequence_output .= '<div class="sequences">';

                while ( $rod_sequence_loop->have_posts() ) {
                    $rod_sequence_loop->the_post();
                    $rod_step_groups = get_post_meta( get_the_ID(), '_rod_step_group', true );
                    foreach ( (array)$rod_step_groups as $key => $rod_step_group ) {
                        $rod_step_title = $rod_step_lists = $rod_step_description = '';
                        $rod_sequence_output .= '<div class="sequence"><div class="row">';

                        if ( isset( $rod_step_group['step_description'] ) || isset( $rod_step_group['step_list'] ) && isset( $rod_step_group['step_title'] ) ) {
                            $rod_step_title = esc_html( $rod_step_group['step_title'] );
                            $rod_sequence_output .= '<div class="col-md-5"><div class="sequence__name">' . $rod_step_title . '</div></div>';

                            $rod_step_description = esc_html( $rod_step_group['step_description'] );
                            $rod_sequence_output .= '<div class="col-md-7"><div class="sequence__info">';
                            if( isset( $rod_step_group['step_list'] ) ) {
                                $rod_step_lists = $rod_step_group['step_list'];
                                $rod_sequence_output .= '<ul class="list">';
                                if (is_array($rod_step_lists) || is_object($rod_step_lists)) {
                                    foreach ( $rod_step_lists as $rod_step_list ) {
                                        $rod_sequence_output .= '<li>' . $rod_step_list . '</li>';
                                    }
                                }
                                $rod_sequence_output .= '</ul>';
                            }
                            $rod_sequence_output .= '<p>' . $rod_step_description . '</p>';
                            $rod_sequence_output .= '</div></div>';
                        }

                        $rod_sequence_output .= '</div></div>';
                    }

                    $rod_image_sequences = get_post_meta( get_the_ID(), '_rod_presentation_image', 1 );

                    if ( $rod_image_sequences ) {
                        $rod_sequence_attachment_id = attachment_url_to_postid( $rod_image_sequences );
                        $rod_sequence_image_alt = get_the_title( $rod_sequence_attachment_id );
                        $rod_sequence_output .= '
                      <div class="media">
                          <img src="' . $rod_image_sequences . '" alt="' . $rod_sequence_image_alt . '" />
                      </div>';
                    }

                } // endwhile
                $rod_sequence_output .= '</div>';
            } // endif
            wp_reset_postdata();
        }
        return $rod_sequence_output;
    }

?>