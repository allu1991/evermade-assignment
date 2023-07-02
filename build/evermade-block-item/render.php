<?php
/**
 * The child block of Evermade gutenberg block
 * These block items are passed as the child block content for main block (evermade-block)
 * The selected article is set as the block content
 */

namespace Evermade\Blocks\EvermadeBlockItem;
use Evermade\Blocks;

// Exit if accessed directly
if(!defined('ABSPATH')) exit;


// Check whether an article has been selected
if ( $attributes['selectedPost'] !== 0 ) {

	// Render the main wrapper as a link html element instead of div like the backend JS ?>
	<a href="<?= get_permalink( $attributes['selectedPost'] ) ?>" class="wp-block-evermade-block-evermade-block-item">

		<div class="post-item-thumbnail">
			<?= get_the_post_thumbnail( $attributes['selectedPost'], 'medium' ) ?>
		</div>

		<div class="post-item-info">

			<div class="post-item-title-and-date">
				<h3><?php esc_html_e( get_the_title( $attributes['selectedPost'] ) ); ?></h3>
				<time><?php esc_html_e( get_the_date( 'd.m.Y', $attributes['selectedPost'] ) ); ?></time>
			</div>

			<?php 
				// Check whether post has a category
				if ( get_the_category( $attributes['selectedPost'] ) && get_the_category( $attributes['selectedPost'] )[0]->name !== "Uncategorized") { ?>
					<p class="post-item-category"><?php esc_html_e( get_the_category( $attributes['selectedPost'] )[0]->name ); ?></p>
				 <?php }
			?>

			<div class="post-item-footer">
				<span class="read-more-link"><?= esc_html_e( 'Read more', 'evermade-block' ); ?></span>
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"><g clip-path="url(#a)"><path fill="#000" fill-opacity=".55" d="m13.172 12-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414 4.95-4.95Z"/></g><defs><clipPath id="a"><path fill="#fff" d="M0 0h24v24H0z"/></clipPath></defs></svg>
			</div>
		</div>

	</a>
<?php
};
?>
