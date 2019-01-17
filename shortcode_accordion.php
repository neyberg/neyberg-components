<?php
// Shortcode for Accordion component
    add_shortcode( 'accordion', 'rod_accordion' );
    function rod_accordion( $rod_accordion_atts ) {
        $rod_accordion_atts = shortcode_atts( array(
            'id' => -1,
        ), $rod_accordion_atts );
        if ( $rod_accordion_atts['id'] > 0 ) {
            $rod_accordion_loop = new WP_Query(
                array(
                    'post_type' => 'accordion',
                    'p' => $rod_accordion_atts['id'],
                    'posts_per_page' => 1,
                )
            );
            ?>
            <?php $rod_accordion_output = ''; ?>
            <?php
            if ( $rod_accordion_loop->have_posts() ):

                while ( $rod_accordion_loop->have_posts() ):
                    $rod_accordion_loop->the_post();
                    $rod_accordion_groups = get_post_meta( get_the_ID(), '_rod_accordion_group', true );

                    foreach ( (array)$rod_accordion_groups as $key => $rod_accordion_group ):
                        ?>
                        <?php if ( $rod_accordion_groups ): ?>
                        <?php
                        $rod_accordion_output .= '<div class="info info--faq">
                        <div class="row">';
                        ?>

                        <?php
                        if ( !empty( $rod_accordion_group['group_title'] ) ):
                            $rod_accordion_group_title = $rod_accordion_group['group_title'];
                            ?>
                            <?php
                            $rod_accordion_output .= '<div class="col-md-3">
                                        <div class="info__heading">' .
                                '<h3>' . esc_html( $rod_accordion_group_title ) . '</h3>
                                        </div>
                                    </div>'; ?>
                        <?php else: ?>
                        <?php endif; ?>

                        <?php if ( !empty( $rod_accordion_group['group_title'] ) ): ?>
                            <?php $rod_accordion_output .= '<div class="col-md-9">'; ?>
                        <?php else: ?>
                            <?php $rod_accordion_output .= '<div class="col-md-12">'; ?>
                        <?php endif; ?>

                        <?php if ( isset( $rod_accordion_group['accordion_field'] ) ): ?>
                            <?php $rod_accordion_output .= '<div class="js-accordion" data-accordion-prefix-classes="rod">'; ?>

                            <?php foreach ( $rod_accordion_group['accordion_field'] as $rod_accordion ): ?>
                                <?php if ( !empty( $rod_accordion['input_with_area-1'] ) && !empty( $rod_accordion['input_with_area-2'] ) ): ?>
                                    <?php $rod_accordion_output .= '<h2 class="js-accordion__header">' . $rod_accordion['input_with_area-1'] . '</h2>'; ?>
                                    <?php
                                    $rod_accordion_output .= '<div class="js-accordion__panel">
                                                <p>' . $rod_accordion['input_with_area-2'] . '</p></div>';
                                    ?>
                                <?php endif; ?>

                            <?php endforeach; ?>

                            <?php $rod_accordion_output .= '</div>'; ?>

                        <?php endif; ?>
                        <?php
                        $rod_accordion_output .= '</div>
                            </div>
                        </div>';
                        ?>
                    <?php
                    endif;

                    endforeach;

                endwhile; // endwhile

            endif; // endif
            wp_reset_postdata();
        }
        wp_enqueue_script( 'van11y-accessible-accordion-aria', plugin_dir_url( __FILE__ ) . '/js/van11y-accessible-accordion-aria/van11y-accessible-accordion-aria.min.js', array(), '1', true );
        return $rod_accordion_output;
    }

?>