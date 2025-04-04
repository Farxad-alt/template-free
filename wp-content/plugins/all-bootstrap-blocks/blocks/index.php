<?php
$block_folders = array(
	
	// Layout
	'strip',
	'container',
	'row',
	'column',
	'column-break',

	// Components
	'accordion',
	'accordion-item',
	'alert',
	'breadcrumb',
	'button',
	'button-group',
	'card',
	'card-body',
	'card-header',
	'card-footer',
	'card-group',
	'carousel',
	'carousel-item',
	'collapse',
	'div',
	'dropdown-item',
	'list-group',
	'list-group-item',
	'modal',
	'modal-header',
	'modal-body',
	'modal-footer',
	'tabs',
	'nav-and-tab',
	'nav-and-tab-item',
	'offcanvas',
	'offcanvas-header',
	'offcanvas-body',
	'progress',
	'spinner',
	'toast',
	'toast-header',
	'toast-body',
	'icon',

	// Strips
	'banner',
	'banner-item',
	'content-with-media',
	'content-grid',
	'content-grid-item',
	'post-grid',
	'media-grid',
	'media-grid-image',
);

foreach ( $block_folders as $block_folder ) {
	
	$exists = false;

	if ( file_exists( get_stylesheet_directory() . '/all-bootstrap-blocks/' . $block_folder . '.php' ) ) {
		
		require get_stylesheet_directory() . '/all-bootstrap-blocks/' . $block_folder . '.php';
		$exists = true;

	} elseif ( file_exists( AREOI__PLUGIN_DIR . '/blocks/' . $block_folder . '.php' ) ) {

		require AREOI__PLUGIN_DIR . '/blocks/' . $block_folder . '.php';
		$exists = true;

	}

	if ( $exists ) {

		$block_json = json_decode(file_get_contents(__DIR__ . '/' . $block_folder . '/block.json'), true);
		if ( isset( $block_json['attributes']['is_flex'] ) ) {
			$block_json['attributes']['is_flex']['default'] = ( areoi2_get_option( 'areoi-customize-options-force-flex', false ) ? true : false );
		}

		register_block_type_from_metadata(
			__DIR__ . '/' . $block_folder,
			array(
				'attributes' => $block_json['attributes'],
				'render_callback' => 'areoi_render_block_' . str_replace( '-', '_', $block_folder ),
			)
		);
	}
}