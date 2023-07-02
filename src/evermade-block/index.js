import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InnerBlocks, useInnerBlocksProps } from '@wordpress/block-editor';
import metadata from './block.json';
import './style.scss';

// Register a new block type definition
registerBlockType( metadata, {
	edit: ( { attributes, setAttributes } ) => {

		// Save block props into a constant
		const blockProps = useBlockProps();

		// Ther inner block properties. Add the evermade child block (aka. the selectable articles) as the allowed content and template. Also add the "block appender" element to allow addition multiple child blocks
		const innerBlocksProps = useInnerBlocksProps( {
			className: "the-posts-grid"
		}, {
			allowedBlocks: [ 'evermade-block/evermade-block-item' ],
			template: [
				[ 'evermade-block/evermade-block-item' ],
			],
			renderAppender: InnerBlocks.ButtonBlockAppender,
		} );


		return (
			<div { ...blockProps }>
				<h2 className="posts-grid-header">{ __( 'Evermade article grid', 'evermade-block' ) }</h2>
				<div { ...innerBlocksProps } />
			</div>
		)
	},

	save: ( { attributes } ) => {
		return <InnerBlocks.Content />;
	},

	getEditWrapperProps( attributes ) {
		return {
			"data-align": attributes.align,
		};
	},

} );
