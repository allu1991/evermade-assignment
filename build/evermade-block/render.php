<?php
/**
 * The main block of the Evermade guterberg block.
 * Renders the main wrapper for the article grid containing the child blocks.
 */

namespace Evermade\Blocks\EvermadeBlock;
use Evermade\Blocks;

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

?>

<div class="wp-block-the-evermade-block-evermade-block align<?= $attributes[ 'align' ] ?>">

	<h2 class="posts-grid-header"><?php esc_html_e( 'Evermade article grid', 'evermade-block' ); ?></h2>

	<div class="the-posts-grid">
		<?= $content ?>
	</div>

</div>
