<?php

/**
 * Registers the Sessions Post Type
 */
function thekeynote_sessions_cpt() {
	register_post_type( 'session',
		array(
			'labels' => array(
				'name'          => __( 'Sessions' ),
				'singular_name' => __( 'session' ),
			),
			'public'      => true,
			'has_archive' => true,
		)
	);
}
add_action( 'init', 'thekeynote_sessions_cpt' );
