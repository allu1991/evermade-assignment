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

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function the_evermade_block_evermade_block_block_init() {
	register_block_type( __DIR__ . '/build' );
}

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

add_action( 'init', 'the_evermade_block_evermade_block_block_init' );
