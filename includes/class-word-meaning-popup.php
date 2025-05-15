<?php

class Word_Meaning_Popup
{
    const VERSION = '1.0.0';
    function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('wp_footer', [$this, 'add_popup_container']);
    }

    function enqueue_assets()
    {
        if (is_admin())
            return;
        $plugin_url = plugin_dir_url(__DIR__);
        wp_enqueue_style('wmp-style', $plugin_url . 'assets/css/style.css', [], self::VERSION);
        wp_enqueue_script('wmp-script', $plugin_url . 'assets/js/script.js', ['jquery'], self::VERSION, true);

        wp_localize_script('wmp-script', 'wmp_ajax', [
            'api_url' => '//api.dictionaryapi.dev/api/v2/entries/en/'
        ]);
    }

    function add_popup_container()
    {
        if (is_admin())
            return;
        echo '<div id="wmp-popup"></div>';
    }
}
