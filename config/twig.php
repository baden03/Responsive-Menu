<?php

$twig = new Twig_Environment(new Twig_Loader_Filesystem([
    dirname(dirname(__FILE__)) . '/views',
    dirname(dirname(__FILE__)) . '/public',
]));

$twig->addFilter(new Twig_SimpleFilter('shortcode', function($string) {
    return do_shortcode($string);
}));

$twig->addFilter(new Twig_SimpleFilter('translate', function($string, $key) {
    $translated = apply_filters('wpml_translate_single_string', $string, 'Responsive Menu', $key);
    $translated = function_exists('pll__') ? pll__($translated) : $translated;
    return $translated;
}));

$twig->addFilter(new Twig_SimpleFilter('json_decode', function($string) {
    return json_decode($string, true);
}));

$twig->addFunction(new Twig_SimpleFunction('combine', function($keys, $values) {
    return array_combine($keys, $values);
}));

$twig->addFunction(new Twig_SimpleFunction('build_menu', function($env, $options) {

    $translator = $env->getFilter('translate')->getCallable();
    $menu = $translator($options['menu_to_use'], 'menu_to_use');

    return wp_nav_menu(
        [
            'container' => '',
            'menu_id' => 'responsive-menu',
            'menu_class' => null,
            'menu' => $menu && !$options['theme_location_menu'] ? $menu : null,
            'depth' => $options['menu_depth'] ? $options['menu_depth'] : 0,
            'theme_location' => $options['theme_location_menu'] ? $options['theme_location_menu'] : null,
            'walker' => new ResponsiveMenuTest\Walkers\Walker($options),
            'echo' => false
        ]
    );

}, ['needs_environment' => true]));

$twig->addGlobal('search_url', function_exists('icl_get_home_url') ? icl_get_home_url() : get_home_url());
$twig->addGlobal('admin_url', get_admin_url());
$twig->addGlobal('current_page', isset($_POST['responsive-menu-current-page']) ? $_POST['responsive-menu-current-page'] : get_option('responsive_menu_current_page', 'initial-setup'));

return $twig;