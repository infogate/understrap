<?php 
/*
Prepare REST
 */
function prepare_rest( $data, $post, $request ){
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail300x180 = wp_get_attachment_image_src( $thumbnail_id, '300x180' );
	$thumbnailMedium = wp_get_attachment_image_src( $thumbnail_id, 'medium' );

	// Categories
	$cats = get_the_category( $post->ID );
	$_data['fi_300x180'] = $thumbnail300x180[0];
	$_data['fi_medium'] = $thumbnailMedium[0];
	$_data['cats'] = $cats;
	$data->data = $_data;
	return $data;
}
add_filter('rest_prepare_post', 'prepare_rest', 10, 3 );