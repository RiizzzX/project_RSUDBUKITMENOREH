<?php
/**
 * Phalcon Polyfill - Minimal implementation untuk development tanpa extension
 */

// Skip jika Phalcon extension sudah loaded
if (extension_loaded('phalcon')) {
    return;
}

// Load polyfill classes
require_once __DIR__ . '/phalcon-polyfill/Di.php';
require_once __DIR__ . '/phalcon-polyfill/Application.php';
require_once __DIR__ . '/phalcon-polyfill/Controller.php';
require_once __DIR__ . '/phalcon-polyfill/Router.php';
require_once __DIR__ . '/phalcon-polyfill/Config.php';
require_once __DIR__ . '/phalcon-polyfill/Loader.php';
require_once __DIR__ . '/phalcon-polyfill/View.php';
require_once __DIR__ . '/phalcon-polyfill/ViewEnginePhp.php';
require_once __DIR__ . '/phalcon-polyfill/ViewEngineVolt.php';
require_once __DIR__ . '/phalcon-polyfill/Url.php';


