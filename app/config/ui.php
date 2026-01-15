<?php
/**
 * RSUD Bukit Menoreh - UI Configuration
 * Pengaturan untuk zoom, theme, dan user interface
 */

return [
    'ui' => [
        // Zoom Configuration
        'zoom' => [
            'enabled' => true,
            'min_level' => 0.75,      // 75%
            'max_level' => 1.5,       // 150%
            'default_level' => 1.0,   // 100%
            'step' => 0.1,            // Setiap klik ±10%
            'allow_keyboard' => true, // Ctrl + Plus/Minus
            'allow_mouse_wheel' => true, // Ctrl + Scroll
            'save_to_localStorage' => true, // Simpan preferensi user
        ],

        // Theme Configuration
        'theme' => [
            'primary_color' => '#2ecc71',
            'secondary_color' => '#3498db',
            'danger_color' => '#e74c3c',
            'warning_color' => '#f39c12',
            'success_color' => '#27ae60',
            'dark_bg' => '#2c3e50',
            'light_bg' => '#ecf0f1',
        ],

        // Layout Configuration
        'layout' => [
            'sidebar_width' => 200,    // px
            'header_height' => 70,     // px
            'content_padding' => 2,    // rem
            'card_shadow' => true,
            'animations' => true,
        ],

        // Responsive Breakpoints
        'breakpoints' => [
            'xs' => 0,
            'sm' => 576,
            'md' => 768,
            'lg' => 992,
            'xl' => 1200,
            'xxl' => 1400,
        ],
    ],

    'features' => [
        'search' => true,
        'filter' => true,
        'export' => true,
        'print' => true,
        'notifications' => true,
        'dark_mode' => false,
    ],
];
