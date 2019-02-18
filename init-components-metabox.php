<?php
    add_action( 'cmb2_admin_init', 'cmb2_rod_components_metaboxes' );
    /**
     * Define the metabox and field configurations.
     */
    function cmb2_rod_components_metaboxes() {

        // Underscore to hide fields from custom fields list
        $prefix = '_rod_';

        /**
         * Initiate the metabox for accordion component
         */

        $cmb = new_cmb2_box( array(
            'id' => $prefix . 'accordion_info',
            'object_types' => array( 'accordion', ),
            'context' => 'after_title',
            'priority' => 'high',
            'show_names' => true,
            'remove_box_wrap' => true,
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'Accordion', 'rod' ),
            'desc' => esc_html__( 'Vertically stacked set of interactive headings representing a sections of content. Commonly used to reduce the need to scroll when multiple sections of content placed on a single page.', 'rod' ),
            'type' => 'title',
            'id'   => $prefix . 'accordion_info_title',
        ) );

        $cmb->add_field( array(
            'type' => 'banner',
            'url' => plugin_dir_url( __FILE__ ) . '/images/layout-accordion.png',
            'id'   => $prefix . 'accordion_info_banner',
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'accordion', 'rod' ),
            'desc' => esc_html__( 'Copy this shortcode and paste it into "Extra sections" area in your pages:', 'rod' ),
            'type' => 'title',
            'id'   => $prefix . 'accordion_shortcode',
            'render_row_cb' => 'cmb_render_shortcode_input_cb',
        ) );

        $cmb = new_cmb2_box( array(
            'id' => $prefix . 'accordion_section',
            'object_types' => array( 'accordion', ),
            'context' => 'after_editor',
            'priority' => 'high',
            'show_names' => true,
            'remove_box_wrap' => true,
        ) );

        $group_field_id = $cmb->add_field( array(
            'id' => $prefix . 'accordion_group',
            'type' => 'group',
            'repeatable' => true,
            'options' => array(
                'group_title' => esc_html__( 'Accordion group', 'rod' ),
                'add_button' => esc_html__( 'one more', 'rod' ),
                'remove_button' => esc_html__( 'remove this group', 'rod' ),
                'sortable' => true,
                'closed' => true,
            ),
        ) );

        // Id's for group's fields only need to be unique for the group. Prefix is not needed.

        $cmb->add_group_field( $group_field_id, array(
            'name' => esc_html__( 'Accordion group name', 'rod' ),
            'id' => 'group_title',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $group_field_id, array(
            'id' => 'accordion_field',
            'type' => 'input_with_area',
            'repeatable' => true,
            'text' => array(
                'add_row_text' => 'new accordion panel',
                'input_with_area_1_text' => 'interactive heading',
                'input_with_area_2_text' => 'collapsible content',
            ),
        ) );

        /**
         * Initiate the metabox for sequences component
         */

        $cmb = new_cmb2_box( array(
            'id' => $prefix . 'sequences_info',
            'object_types' => array( 'sequence', ),
            'context' => 'after_title',
            'priority' => 'high',
            'show_names' => true,
            'remove_box_wrap' => true,
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'Sequence', 'rod' ),
            'desc' => esc_html__( 'Enumerated collection of related text or images sorted in logical ways, sequential content that needs to be read in a particular order. Used to present things that follow each other.', 'rod' ),
            'type' => 'title',
            'id'   => $prefix . 'sequences_info_title',
        ) );

        $cmb->add_field( array(
            'type' => 'banner',
            'url' => plugin_dir_url( __FILE__ ) . '/images/layout-sequence.png',
            'id'   => $prefix . 'sequences_info_banner',
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'sequence', 'rod' ),
            'desc' => esc_html__( 'Copy this shortcode and paste it into "Extra sections" area in your pages:', 'rod' ),
            'type' => 'title',
            'id'   => $prefix . 'sequences_shortcode',
            'render_row_cb' => 'cmb_render_shortcode_input_cb',
        ) );

        $cmb = new_cmb2_box( array(
            'id' => $prefix . 'sequences_section',
            'object_types' => array( 'sequence', ),
            'context' => 'after_editor',
            'priority' => 'high',
            'show_names' => true,
            'remove_box_wrap' => true,
        ) );

        $group_field_id = $cmb->add_field( array(
            'id' => $prefix . 'step_group',
            'type' => 'group',
            'repeatable' => true,
            'options' => array(
                'group_title' => esc_html__( 'Sequence step', 'rod' ),
                'add_button' => esc_html__( 'one more', 'rod' ),
                'remove_button' => esc_html__( 'remove this step', 'rod' ),
                'sortable' => true,
                'closed' => true,
            ),
        ) );

        // Id's for group's fields only need to be unique for the group. Prefix is not needed.

        $cmb->add_group_field( $group_field_id, array(
            'name' => esc_html__( 'Subheading', 'rod' ),
            'id' => 'step_title',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $group_field_id, array(
            'name' => esc_html__( 'List of statements', 'rod' ),
            'id' => 'step_list',
            'type' => 'text',
            'repeatable' => true,
            'text' => array(
                'add_row_text' => 'one more',
            ),
        ) );

        $cmb->add_group_field( $group_field_id, array(
            'desc' => esc_html__( 'Supporting text to describe nuances of current step', 'rod' ),
            'id' => 'step_description',
            'type' => 'textarea_small',
        ) );

        $cmb = new_cmb2_box( array(
            'id' => $prefix . 'sequences_footer',
            'title' => esc_html__( 'Sequence footer', 'rod' ),
            'object_types' => array( 'sequence', ),
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true,
            'closed' => true,
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'Footer image', 'rod' ),
            'desc' => esc_html__( 'Help readers to visualize sequence or process described above', 'rod' ),
            'type' => 'title',
            'id'   => $prefix . 'sequences_presentation_image_title',
        ) );

        $cmb->add_field( array(
            'id' => $prefix . 'presentation_image',
            'type' => 'file',
            'options' => array(
                'url' => false,
            ),
            'text' => array(
                'add_upload_file_text' => esc_html__( 'upload an image', 'rod' ),
            ),
            'preview_size' => 'large',
        ) );

        /**
         * Initiate the metabox for image grids component
         */

        $cmb = new_cmb2_box( array(
            'id' => $prefix . 'image_grid_info',
            'object_types' => array( 'imagegrid', ),
            'context' => 'after_title',
            'priority' => 'high',
            'show_names' => true,
            'remove_box_wrap' => true,
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'Image grid', 'rod' ),
            'desc' => esc_html__( 'Display a collection of images of varying ratios in an organized grid. Used for presentation of peer media content, items of equal importance.', 'rod' ),
            'type' => 'title',
            'id'   => $prefix . 'image_grid_info_title',
        ) );

        $cmb->add_field( array(
            'type' => 'banner',
            'url' => plugin_dir_url( __FILE__ ) . '/images/layout-image-grid.png',
            'id'   => $prefix . 'image_grid_info_banner',
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'imagegrid', 'rod' ),
            'desc' => esc_html__( 'Copy this shortcode and paste it into "Extra sections" area in your pages:', 'rod' ),
            'type' => 'title',
            'id'   => $prefix . 'image_grid_shortcode',
            'render_row_cb' => 'cmb_render_shortcode_input_cb',
        ) );

        $cmb = new_cmb2_box( array(
            'id' => $prefix . 'image_grid_section',
            'title' => esc_html__( 'Image grid items', 'rod' ),
            'object_types' => array( 'imagegrid', ),
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true,
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'Photos, pictures, graphics, illustrations', 'rod' ),
            'desc' => esc_html__( 'Add as many images as you need, drag and drop to reorder', 'rod' ),
            'type' => 'title',
            'id'   => $prefix . 'image_list_grid_title',
        ) );

        $cmb->add_field( array(
            'id' => $prefix . 'image_list_grid',
            'type' => 'file_list',
            'preview_size' => array( 180, 180 ),
            'text' => array(
                'add_upload_files_text' => esc_html__( 'upload a set of images', 'rod' ),
            ),
        ) );

        /**
         * Initiate the metabox for tab component
         */

        $cmb = new_cmb2_box( array(
            'id' => $prefix . 'tab_info',
            'object_types' => array( 'tab', ),
            'context' => 'after_title',
            'priority' => 'high',
            'show_names' => true,
            'remove_box_wrap' => true,
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'Tabs', 'rod' ),
            'desc' => esc_html__( 'Set of layered sections of content, known as tab panels, that display one panel of content at a time. Tabs organize and allow navigation between groups of content that are related, share a common characteristic and at the same level of hierarchy. Text labels should clearly and succinctly describe the content of the tab they represent.', 'rod' ),
            'type' => 'title',
            'id'   => $prefix . 'tab_info_title',
        ) );

        $cmb->add_field( array(
            'type' => 'banner',
            'url' => plugin_dir_url( __FILE__ ) . '/images/layout-tabs.png',
            'id'   => $prefix . 'accordion_info_banner',
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'tab', 'rod' ),
            'desc' => esc_html__( 'Copy this shortcode and paste it into "Extra sections" area in your pages:', 'rod' ),
            'type' => 'title',
            'id'   => $prefix . 'accordion_info_test',
            'render_row_cb' => 'cmb_render_shortcode_input_cb',
        ) );

        $cmb = new_cmb2_box( array(
            'id' => $prefix . 'tabs_section',
            'object_types' => array( 'tab', ),
            'context' => 'after_editor',
            'priority' => 'high',
            'show_names' => true,
            'remove_box_wrap' => true,
        ) );

        $group_field_id = $cmb->add_field( array(
            'id' => $prefix . 'tab_component',
            'type' => 'group',
            'repeatable' => true,
            'options' => array(
                'group_title' => esc_html__( 'Tab panel', 'rod' ),
                'add_button' => esc_html__( 'one more', 'rod' ),
                'remove_button' => esc_html__( 'remove this tab', 'rod' ),
                'sortable' => true,
                'closed' => true,
            ),
        ) );

        // Id's for group's fields only need to be unique for the group. Prefix is not needed.

        $cmb->add_group_field( $group_field_id, array(
            'desc' => esc_html__( 'interactive heading', 'rod' ),
            'id' => 'tab_title',
            'type' => 'text_medium',
        ) );

        $cmb->add_group_field( $group_field_id, array(
            'desc' => esc_html__( 'associated content', 'rod' ),
            'id' => 'tab_description',
            'type' => 'textarea',
        ) );

        $cmb = new_cmb2_box( array(
            'id' => $prefix . 'tabs_section_header',
            'title' => esc_html__( 'Tabs header', 'rod' ),
            'object_types' => array( 'tab', ),
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true,
            'closed' => true,
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'Opening phrase', 'rod' ),
            'id' => $prefix . 'tabs_header',
            'type' => 'text',
        ) );

        $cmb = new_cmb2_box( array(
            'id' => $prefix . 'tabs_section_sidebar',
            'title' => esc_html__( 'Tabs sidebar', 'rod' ),
            'object_types' => array( 'tab', ),
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true,
            'closed' => true,
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'Sidebar image', 'rod' ),
            'desc' => esc_html__( 'Emphasize tabs main message', 'rod' ),
            'type' => 'title',
            'id'   => $prefix . 'tab_sidebar_media_title',
        ) );

        $cmb->add_field( array(
            'id' => $prefix . 'tab_sidebar_media',
            'type' => 'file',
            'options' => array(
                'url' => false,
            ),
            'text' => array(
                'add_upload_file_text' => 'upload an image',
            ),
            'preview_size' => 'medium',
        ) );

        $cmb->add_field( array(
            'desc' => esc_html__( 'Provide additional information that may be useful to readers', 'rod' ),
            'id' => $prefix . 'tab_sidebar_details',
            'type' => 'textarea_small',
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'Follow link', 'rod' ),
            'desc' => esc_html__( 'insert a link to direct your readers to target place', 'rod' ),
            'id' => $prefix . 'tab_sidebar_reference',
            'type' => 'text',
        ) );

        $cmb->add_field( array(
            'name' => ' ',
            'desc' => esc_html__( 'check this box if you want to use email address instead', 'rod' ),
            'id' => $prefix . 'tab_email_as_reference',
            'type' => 'checkbox',
        ) );

        function cmb_render_shortcode_input_cb( $field_args, $field ) {
            $label = $field->args( 'name' );
            $description = $field->args( 'description' );
            ?>
            <div class="custom-field-row">
                <p class="description"><?php echo esc_html( $description ); ?></p>
                <input type="text" onfocus="this.select();" readonly="readonly" class="shortcode-component" value="<?php echo esc_html(  '[' . $label . ' id="' . $field->object_id . '"]' ); ?>">
            </div>
            <?php
        }

    }