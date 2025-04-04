<?php
function areoi_render_block_breadcrumb( $attributes, $content ) 
{
	$breadcrumbs = areoi_generate_breadcrumbs( $attributes );

	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			'breadcrumb',
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),
		) ) 
		. ' ' . 
		areoi_get_display_class_str( $attributes, 'flex' ) 
	);

	$divider = "style=\"--bs-breadcrumb-divider: '" . esc_attr( htmlentities( $attributes['divider'] ) ) . "';\"";

	$list = '';
	if ( !empty( $breadcrumbs ) ) {
		foreach ( $breadcrumbs as $breadcrumb_key => $breadcrumb ) {
			if ( $breadcrumb['active'] ) {
				$list .= '<li class="breadcrumb-item active" aria-current="page">' . wp_kses_post( $breadcrumb['label'] ) . '</li>';
			} else {
				$list .= '<li class="breadcrumb-item"><a href="' . esc_url( $breadcrumb['permalink'] ) . '">' . wp_kses_post( $breadcrumb['label'] ) . '</a></li>';
			}
		}
	}
	
	$output = '
		<nav  
			' . areoi_return_id( $attributes ) . ' 
			class="' . areoi_format_block_id( $attributes['block_id'] ) . ' ' . $class . '" 
			aria-label="breadcrumb"
			' . $divider . '
		>
			<ol class="breadcrumb">
				' . $list . '
			</ol>
		</nav>
	';

	return $output;
}