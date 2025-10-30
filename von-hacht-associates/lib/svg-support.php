<?php
/**
 * IF YOU HAVE ANY DIFFICULTIES WITH SVG UPLOAD USE SVG-SUPPORT PLUGIN
 * https://wordpress.org/plugins/svg-support/
 */


/**
 * ADD MIME TYPES
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_filter( 'upload_mimes', 'support_for_upload_svg_files' );

function support_for_upload_svg_files( $mimes = array() ) {
	// allow SVG file upload
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	
	return $mimes;
}

/**
 * ADD ABILITY TO VIEW THUMBNAILS IN WP 4.0+
 */

add_action( 'admin_init', 'display_svg_thumbs' );

function display_svg_thumbs() {
	
	ob_start();
	
	function svgs_thumbs_filter( $content ) {
		
		return apply_filters( 'final_output', $content );
		
	}
	
	ob_start( 'svgs_thumbs_filter' );
	
	add_filter( 'final_output', 'svgs_final_output' );
	
	function svgs_final_output( $content ) {
		
		$content = str_replace(
			'<# } else if ( \'image\' === data.type && data.sizes && data.sizes.full ) { #>',
			'<# } else if ( \'svg+xml\' === data.subtype ) { #>
					<img class="details-image" src="{{ data.url }}" draggable="false" />
					<# } else if ( \'image\' === data.type && data.sizes && data.sizes.full ) { #>',
			
			$content
		);
		
		$content = str_replace(
			'<# } else if ( \'image\' === data.type && data.sizes ) { #>',
			'<# } else if ( \'svg+xml\' === data.subtype ) { #>
					<div class="centered">
						<img src="{{ data.url }}" class="thumbnail" draggable="false" />
					</div>
					<# } else if ( \'image\' === data.type && data.sizes ) { #>',
			
			$content
		);
		
		return $content;
		
	}
}

/**
 * Insert additional class to img tag and specify img dimensions if user select svg file
 *
 * @param string $html img tag
 *
 * @return string
 */

function additional_img_class( $html ) {
	if ( strpos( $html, '.svg' ) !== false ) {
		$html = preg_replace( '|class="(.+?)"|', 'class="$1 attachment-svg"', $html );
		$html = str_replace( 'width="1"', 'width="64"', $html );
		$html = str_replace( 'height="1"', 'height="64"', $html );
	}
	
	return $html;
}

add_filter( 'get_image_tag', 'additional_img_class' );

// Get svg dimensions
function svgs_get_dimensions( $svg ) {
	
	$svg = simplexml_load_file( $svg );
	
	if ( $svg === false ) {
		
		$width = '0';
		$height = '0';
		
	} else {
		
		$attributes = $svg->attributes();
		$width      = (string) $attributes->width;
		$height     = (string) $attributes->height;
		
	}
	
	return (object) array(
		'width' => $width,
		'height' => $height
	);
	
}

function svgs_response_for_svg( $response, $attachment, $meta ) {
	
	if ( $response['mime'] == 'image/svg+xml' && empty( $response['sizes'] ) ) {
		
		$svg_path = get_attached_file( $attachment->ID );
		
		if ( ! file_exists( $svg_path ) ) {
			// If SVG is external, use the URL instead of the path
			$svg_path = $response['url'];
		}
		
		$dimensions = svgs_get_dimensions( $svg_path );
		
		$response['sizes'] = array(
			'full' => array(
				'url' => $response['url'],
				'width' => $dimensions->width,
				'height' => $dimensions->height,
				'orientation' => $dimensions->width > $dimensions->height ? 'landscape' : 'portrait'
			)
		);
		
	}
	
	return $response;
}

add_filter( 'wp_prepare_attachment_for_js', 'svgs_response_for_svg', 10, 3 );
