<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);

    $wp_customize->add_setting('upload_logo');
    $wp_customize->add_control(
     new \WP_Customize_Image_Control(
       $wp_customize,
       'upload_logo',
       array(
         'label' => 'Logo',
         'section' => 'title_tagline',
         'settings' => 'upload_logo',
         'transport' => 'postMessage'
       )
     )
    );

});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});
