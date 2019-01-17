<?php
// function for image grid component
    function cmb2_output_file_list( $rod_image_list_meta_key ) {
        // Get the list of files
        $rod_image_list = get_post_meta( get_the_ID(), $rod_image_list_meta_key, 1 );
        // Loop through them and output an image
        $rod_img_list_output = '';

        if ( $rod_image_list ):

            foreach ( (array)$rod_image_list as $rod_attachment_id => $rod_attachment_url ): ?>
                <?php $rod_img_list_output .= '<div class="col-6 col-md-4 col-lg-3">
                <div class="media media--space">';
                ?>
                <?php
                $rod_attachment_title = get_the_title( $rod_attachment_id );
                $rod_img_list_output .= '<img class="lazy" alt="' . $rod_attachment_title . '" src="' . get_template_directory_uri() . '/images/assets/placeholder.png" data-src="' . $rod_attachment_url . '" />';
                ?>
                <?php $rod_img_list_output .= '
                </div>
            </div>';
                ?>

            <?php endforeach;

        endif;
        return $rod_img_list_output;
    }

?>
<?php
// Shortcode for Image grid component
    add_shortcode( 'imagegrid', 'rod_imagegrid' );
    function rod_imagegrid( $rod_imagegrid_atts )
    {
        $rod_imagegrid_atts = shortcode_atts( array(
            'id' => -1,
        ), $rod_imagegrid_atts );

        if ( $rod_imagegrid_atts['id'] > 0 ) {
            $rod_imagegrid_loop = new WP_Query(
                array(
                    'post_type' => 'imagegrid',
                    'p' => $rod_imagegrid_atts['id'],
                    'posts_per_page' => 1,
                )
            );
            ?>
            <?php $rod_img_list_output = ''; ?>

            <?php
            if ( $rod_imagegrid_loop->have_posts() ) {
                $rod_img_list_output .= '<div class="row grid-image align-center align-items-center">';
                while ( $rod_imagegrid_loop->have_posts() ) {
                    $rod_imagegrid_loop->the_post();
                    $rod_img_list_output .= cmb2_output_file_list( '_rod_image_list_grid' );
                } // endwhile
                $rod_img_list_output .= '</div>';
            } // endif

            wp_reset_postdata();
        }

        return $rod_img_list_output;
    }

?>