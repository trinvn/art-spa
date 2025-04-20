<?php
/**
 * Register custom elements
 */
add_action('init', function () {
    $element_files = [
        __DIR__ . '/../elements/content-more.php',
    ];

    foreach ($element_files as $file) {
        \Bricks\Elements::register_element($file);
    }
}, 11);

/**
 * Add text strings to builder
 */
add_filter('bricks/builder/i18n', function ($i18n) {
    // For element category 'custom'
    $i18n['custom'] = esc_html__('Custom', 'bricks');

    return $i18n;
});

add_filter('bricks/body/attributes', function ($attributes) {
    if (is_singular('product')) {
        $product_id = get_the_ID();
        $attributes['data-post-id'] = $product_id;
    }

    return $attributes;
});

/*
add_filter('bricks/code/echo_function_names', function () {
    return [
        'has_viewed_product',
        'show_product_categories',
    ];
}); */