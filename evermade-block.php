<?php
/**
 * Plugin Name:       Evermade block
 * Plugin URI:        https://github.com/allu1991
 * Description:       Evermade Gutenberg block coding assignment
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           1.0.0
 * Author:            Aleksi Pitkänen
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       evermade-block
 *
 * @package           the-evermade-block
 */

namespace Evermade\Blocks;


/**
 * Registers the block(s) using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 */
add_action( 'init', function() {
	register_block_type( __DIR__ . '/build/evermade-block' );
	register_block_type( __DIR__ . '/build/evermade-block-item' );
} );


// Add new custom gutenberg block category
add_filter('block_categories_all', function($categories, $post) {
	array_unshift(
		$categories,
		[
			'slug'  => 'evermade-blocks',
			'title' => 'Evermade blocks',
		]
	);
	return $categories;
}, 10, 2);


// Enqueue the block styles for the front end
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'evermade-styles', plugin_dir_url( __FILE__ ) . 'build/evermade-block/style-index.css' );
} );
