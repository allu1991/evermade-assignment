import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { SelectControl, Spinner } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import metadata from './block.json';


// Register a new block type definition
registerBlockType( metadata, {
	edit: ( { attributes, setAttributes } ) => {

		// Define the selected post attribute
		const { selectedPost } = attributes;

		// Save block props into a constant
		const blockProps = useBlockProps();

		// Return the entity records of queried Wordpress posts by using the useSelect component
		const { posts } = useSelect( select => {
			let query = {
				per_page: -1,
				_embed: true,
				status: "publish",
			};

			return {
				posts: select( "core" ).getEntityRecords( "postType", "post", query ) ?? []
			};
		});

		
		// Initialize the list of posts
		let selectablePosts = [];

		// If posts are available, append posts to the array along with the default "select post" option
		if ( posts ) {
			selectablePosts.push( { value: 0, label: "Select post", disabled: true } );
			posts.forEach( ( post ) => {
				selectablePosts.push( {
					value: post.id,
					label: post?.title?.rendered ?? "?",
				} );
			} );
		}


		// Find from the posts list the post that matches the selected post and set the id number to the "selectedPost" block attribute
		let currentValidPost = posts.find( i => {
			return i.id == selectedPost;
		} );


		return (
			<div { ...blockProps }>

				{ /* The loading state. Use the core spinner component as an indicator */ }
				{ posts.length == 0 &&
					<Spinner />
				}

				{ /* Show following when posts found and loaded */ }
				{ posts.length > 0 &&
					<>
						<SelectControl
							label="Contact"
							hideLabelFromVision="true"
							options={selectablePosts}
							onChange={ ( value ) => {
								setAttributes( {
									selectedPost: parseInt(value),
								} );
							} }
							value={ selectedPost }
						/>

						{ /* Display the post content if one has been selected */ }
						{ currentValidPost ? (
							<>
								<div className="post-item-thumbnail">
									{ currentValidPost._embedded[ "wp:featuredmedia" ] ? (
										<img src={ currentValidPost._embedded[ "wp:featuredmedia" ][ 0 ].media_details.sizes.medium.source_url } alt={ currentValidPost._embedded[ "wp:featuredmedia" ][ 0 ].alt_text } />
									) : (
										<p>(no post thumbnail)</p>
									) }
								</div>

								<div className="post-item-info">
									<div className="post-item-title-and-date">
										<h3>{ currentValidPost.title.rendered }</h3>
										<time>{ currentValidPost.date }</time>
									</div>

									{/* Check whether post has a category */}
									{ currentValidPost._embedded[ "wp:term" ] && currentValidPost._embedded[ "wp:term" ][ 0 ][ 0 ].name !== "Uncategorized" && (
										<p className="post-item-category">{ currentValidPost._embedded[ "wp:term" ][ 0 ][ 0 ].name }</p>
									)}
									
								</div>
							</>
						) : (
							<p className="post-select-instruction">Select a post to be displayed here</p>
						) }
					</>
				}

			</div>
		)
	},

	save: ( { attributes } ) => {
		return null;
	},

} );
