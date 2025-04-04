<?php
function areoi_render_block_column( $attributes, $content, $block ) 
{
	$is_grid = areoi2_get_option( 'areoi-customize-options-enable-cssgrid', false );

	if ( !empty( $block->context['areoi/isFlex'] ) ) $is_grid = false;

	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			( !$is_grid ? 'col' : '' ),
			'areoi-element',
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),

			( empty( $attributes['hide_xs'] ) && !empty( $attributes['vertical_align_xs'] ) ? $attributes['vertical_align_xs'] : '' ),
			( empty( $attributes['hide_sm'] ) && !empty( $attributes['vertical_align_sm'] ) ? $attributes['vertical_align_sm'] : '' ),
			( empty( $attributes['hide_md'] ) && !empty( $attributes['vertical_align_md'] ) ? $attributes['vertical_align_md'] : '' ),
			( empty( $attributes['hide_lg'] ) && !empty( $attributes['vertical_align_lg'] ) ? $attributes['vertical_align_lg'] : '' ),
			( empty( $attributes['hide_xl'] ) && !empty( $attributes['vertical_align_xl'] ) ? $attributes['vertical_align_xl'] : '' ),
			( empty( $attributes['hide_xxl'] ) && !empty( $attributes['vertical_align_xxl'] ) ? $attributes['vertical_align_xxl'] : '' ),

			( empty( $attributes['hide_xs'] ) && !empty( $attributes['col_xs'] ) ? $attributes['col_xs'] : '' ),
			( empty( $attributes['hide_sm'] ) && !empty( $attributes['col_sm'] ) ? $attributes['col_sm'] : '' ),
			( empty( $attributes['hide_md'] ) && !empty( $attributes['col_md'] ) ? $attributes['col_md'] : '' ),
			( empty( $attributes['hide_lg'] ) && !empty( $attributes['col_lg'] ) ? $attributes['col_lg'] : '' ),
			( empty( $attributes['hide_xl'] ) && !empty( $attributes['col_xl'] ) ? $attributes['col_xl'] : '' ),
			( empty( $attributes['hide_xxl'] ) && !empty( $attributes['col_xxl'] ) ? $attributes['col_xxl'] : '' ),

			( empty( $attributes['hide_xs'] ) && !empty( $attributes['offset_xs'] ) ? $attributes['offset_xs'] : '' ),
			( empty( $attributes['hide_sm'] ) && !empty( $attributes['offset_sm'] ) ? $attributes['offset_sm'] : '' ),
			( empty( $attributes['hide_md'] ) && !empty( $attributes['offset_md'] ) ? $attributes['offset_md'] : '' ),
			( empty( $attributes['hide_lg'] ) && !empty( $attributes['offset_lg'] ) ? $attributes['offset_lg'] : '' ),
			( empty( $attributes['hide_xl'] ) && !empty( $attributes['offset_xl'] ) ? $attributes['offset_xl'] : '' ),
			( empty( $attributes['hide_xxl'] ) && !empty( $attributes['offset_xxl'] ) ? $attributes['offset_xxl'] : '' ),

			( empty( $attributes['hide_xs'] ) && !empty( $attributes['order_xs'] ) ? $attributes['order_xs'] : '' ),
			( empty( $attributes['hide_sm'] ) && !empty( $attributes['order_sm'] ) ? $attributes['order_sm'] : '' ),
			( empty( $attributes['hide_md'] ) && !empty( $attributes['order_md'] ) ? $attributes['order_md'] : '' ),
			( empty( $attributes['hide_lg'] ) && !empty( $attributes['order_lg'] ) ? $attributes['order_lg'] : '' ),
			( empty( $attributes['hide_xl'] ) && !empty( $attributes['order_xl'] ) ? $attributes['order_xl'] : '' ),
			( empty( $attributes['hide_xxl'] ) && !empty( $attributes['order_xxl'] ) ? $attributes['order_xxl'] : '' ),
			areoi_get_utilities_classes( $attributes )
		) ) 
		. ' ' . 
		areoi_get_display_class_str( $attributes, 'block' )
	);

	if ( $is_grid ) {
		$class = str_replace( 'col-', 'g-col-', $class );
		$class = str_replace( 'offset-', 'g-start-', $class );
	}

	$background 	= include( AREOI__PLUGIN_DIR . '/blocks/_partials/background.php' );

	$url = null;
	if ( !empty( $attributes['url'] ) ) {
		$url = '
			<a class="areoi-full-link"
		';
		if ( !empty( $attributes['url'] ) ) {
			$url .= ' href="' . esc_url( $attributes['url'] ) . '"';
		}
		if ( !empty( $attributes['url_title'] ) ) {
			$url .= ' title="' . esc_attr( $attributes['url_title'] ) . '"';
		}
		if ( !empty( $attributes['rel'] ) ) {
			$url .= ' rel="' . esc_attr( $attributes['rel'] ) . '"';
		}
		if ( !empty( $attributes['linkTarget'] ) ) {
			$url .= ' target="' . esc_attr( $attributes['linkTarget'] ) . '"';
		}
		$url .= '></a>';
	}

	$block_id = ( !empty( $attributes['block_id'] ) ? areoi_format_block_id( $attributes['block_id'] ) : '' );

	$output = '
		<div ' . areoi_return_id( $attributes ) . ' class="' . $block_id . ' ' . $class . '">
			' . $background . '
			' . $content . ' 
			' . $url . '
		</div>
	';

	return $output;
}