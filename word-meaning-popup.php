<?php
/**
 * Plugin Name: Word Meaning Popup
 * Description: Show meaning of a word when user double-clicks or selects a word in a post.
 * Version: 1.0.0
 * Author: Imtiaz
 * Author URI: https://www.fiverr.com/imtiazz4
 */

defined('ABSPATH') || exit;

require_once plugin_dir_path(__FILE__) . 'includes/class-word-meaning-popup.php';


function wmp_init_plugin()
{
    new Word_Meaning_Popup();
}
add_action('plugins_loaded', 'wmp_init_plugin');
