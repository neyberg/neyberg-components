<div id="components-home" class="wrap">
    <h1><?php echo esc_html('Components'); ?></h1>

    <div class="welcome-panel">
        <div class="welcome-panel-content">
            <p class="about-description"><?php echo esc_html('Arsenal of different custom templates helping you to create reusable distinct section of final interface.'); ?></p>

            <div class="welcome-panel-column-container">
                <div class="welcome-panel-column">
                    <h3><?php echo esc_html( 'Main idea' ); ?></h3>
                    <p><?php echo esc_html( 'Components is a core part of a creating page experience. They give opportunity easily expand page, cover more information, enhance its functionality.' ); ?></p>
                    <p><?php echo esc_html( 'There are several types of components: accordions, tabs, sequences and image grid. Each created to serve different purpose and bring unique experience for site visitors.' ); ?></p>
                </div>

                <div class="welcome-panel-column">
                    <h3><?php echo esc_html( 'How it works' ); ?></h3>
                    <p><?php echo esc_html( 'To create single component your just need fill the text fields and upload images, without writing single line of code. After creating component you will get shortcode.' ); ?> </p>
                    <p><?php echo esc_html( 'Most page templates have “Extra sections” area with predefined field for inserting this shortcode.' ); ?></p>
                </div>

                <div class="welcome-panel-column welcome-panel-last">
                    <h3><?php echo esc_html( 'Give a try' ); ?></h3>
                    <p><?php echo esc_html( 'Components are standalone, reusable, specially created, relatively complex HTML templates. They use theme styles, so, as result, look cohesive at the page where used.' ); ?></p>
                    <p><?php echo esc_html( 'Start exploring possibility and you will find component suitable for your need.' ); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">

            <div id="postbox-container-1" class="postbox-container">
                <div class="meta-box-sortables ui-sortable">

                    <div class="postbox">
                        <div class="inside">
                            <h2><?php echo esc_html('Accordions'); ?></h2>
                            <img class="components-image" src="<?php echo plugin_dir_url( __FILE__ ) . 'icons/icon-accordion.png'?>" alt="accordion">
                            <p><?php echo esc_html('Vertically stacked set of interactive headings representing a sections of content. Widely used to reduce scrolling when multiple sections of content placed on a single page.'); ?></p>
                            <a class="button button-secondary" href="/wp-admin/edit.php?post_type=accordion"><?php echo esc_html('Go to Accordions'); ?></a>
                        </div>
                    </div>

                     <div class="postbox">
                        <div class="inside">
                            <h2><?php echo esc_html('Sequences'); ?></h2>
                            <img class="components-image" src="<?php echo plugin_dir_url( __FILE__ ) . 'icons/icon-sequences.png'?>" alt="sequence">
                            <p><?php echo esc_html('Enumerated collection of related text or images sorted in logical ways, sequential content that needs to be read in a particular order. Used to present things that follow each other.'); ?></p>
                            <a class="button button-secondary" href="/wp-admin/edit.php?post_type=sequence"><?php echo esc_html('Go to Sequences'); ?></a>
                        </div>
                    </div>

                </div>
            </div>

            <div id="postbox-container-2" class="postbox-container">
                <div class="meta-box-sortables ui-sortable">

                    <div class="postbox">
                        <div class="inside">
                            <h2><?php echo esc_html('Tabs'); ?></h2>
                            <img class="components-image" src="<?php echo plugin_dir_url( __FILE__ ) . 'icons/icon-tabs.png'?>" alt="tabs">
                            <p><?php echo esc_html('Set of layered sections of content, known as tab panels, that display one panel of content at a time. Use tabs when readers don\'t need to see content from multiple tabs simultaneously.'); ?></p>
                            <a class="button button-secondary" href="/wp-admin/edit.php?post_type=tab"><?php echo esc_html('Go to Tabs'); ?></a>
                        </div>
                    </div>

                    <div class="postbox">
                       <div class="inside">
                           <h2><?php echo esc_html('Image grids'); ?></h2>
                           <img class="components-image" src="<?php echo plugin_dir_url( __FILE__ ) . 'icons/icon-image-grid.png'?>" alt="image grid">
                           <p><?php echo esc_html('Display a collection of images of varying ratios in an organized grid. Used for presentation of peer media content, items of equal importance.'); ?></p>
                           <a class="button button-secondary" href="/wp-admin/edit.php?post_type=imagegrid"><?php echo esc_html('Go to Image grids'); ?></a>
                       </div>
                    </div>

                </div>
            </div>

        </div>
     </div>

</div>

