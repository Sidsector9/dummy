<?php

add_action( 'init', 'thekeynote_speakers_cpt' );
/**
 * Registers the Speakers Post Type
 */
function thekeynote_speakers_cpt() {
	register_post_type( 'speaker',
		array(
			'labels' => array(
				'name'          => __( 'Speakers' ),
				'singular_name' => __( 'speaker' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'hierarchical' => true,
			'orderby'      => 'menu_order',
			'supports'     => array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
		)
	);
}

add_action( 'init', 'thekeynote_session_category' );
/**
 * Registers Sessions Category
 */
function thekeynote_session_category() {
	register_taxonomy(
		'session_category',
		'session',
		array(
			'label'        => __( 'Sessions Category' ),
			'rewrite'      => array(
				'slug' => 'session_cat',
			),
			'hierarchical' => true,
		)
	);
}

add_action( 'fm_post_speaker', 'speakers_options' );
/**
 * Creates Speakers Information metabox and adds fields to it.
 */
function speakers_options() {
	$fm = new Fieldmanager_Group( array(
		'name' => 'sessions_group',
		'serialize_data' => false,
		'children' => array(
			'speaker_position' => new Fieldmanager_Textfield( 'Speaker Position', array(
				'attributes' => array(
					'size' => 25,
				),
			)),

			'speaker_position_2' => new Fieldmanager_Textfield( 'Speaker Position (Line 2)', array(
				'attributes' => array(
					'size' => 25,
				),
			)),

			'company' => new Fieldmanager_Textfield( 'Company', array(
				'attributes' => array(
					'size' => 25,
				),
			)),

			'telephone' => new Fieldmanager_Textfield( 'Telephone', array(
				'attributes' => array(
					'size' => 25,
				),
			)),

			'email' => new Fieldmanager_Textfield( 'Email', array(
				'attributes' => array(
					'size' => 25,
				),
			)),

			'website' => new Fieldmanager_Link( 'Website', array(
				'attributes' => array(
					'size' => 25,
				),
			)),
		),
	));

	$fm->add_meta_box( 'Speaker Information', array( 'speaker' ) );
}

if ( function_exists( 'fm_register_submenu_page' ) ) {
	fm_register_submenu_page( 'banner_options', 'options-general.php', 'Homepage slider' );
	add_action( 'fm_submenu_banner_options', function() {
		$fm = new Fieldmanager_Group( array(
			'name'     => 'banner_options',
			'children' => array(
				'image_or_video' => new Fieldmanager_Radios( array(
					'options' => array(
						'image' => __( 'Image' ),
						'video' => __( 'Video' ),
					),
				)),
				'slider_options' => new Fieldmanager_Group( array(
					'display_if' => array(
						'src' => 'image_or_video',
						'value' => 'image',
					),
					'limit' => 5,
					'sortable' => true,
					'minimum_count' => 0,
					'add_more_label' => __( 'Add a new slide' ),
					'name' => 'slider_options',
					'children' => array(
						'slide_id' => new Fieldmanager_Media( 'Slide', array() ),
						'slide_text' => new Fieldmanager_Textfield( 'Slide Text' ),
						'slide_text_position' => new Fieldmanager_Radios( array(
							'options' => array(
								'top_left'      => __( 'Top Left' ),
								'top_center'    => __( 'Top Center' ),
								'top_right'     => __( 'Top Right' ),
								'middle_left'   => __( 'Middle Left' ),
								'middle_center' => __( 'Middle Center' ),
								'bottom_left'   => __( 'Bottom Left' ),
								'bottom_center' => __( 'Bottom Center' ),
								'bottom_right'  => __( 'Bottom Right' ),
							),
						)),
					),
				)),
				'video_options' => new Fieldmanager_Group( array(
					'display_if' => array(
						'src' => 'image_or_video',
						'value' => 'video',
					),
					'children' => array(
						'video_id' => new Fieldmanager_Media( 'Video', array() ),
						'video_text' => new Fieldmanager_Textfield( 'Video Text' ),
						'video_text_position' => new Fieldmanager_Radios( array(
							'options' => array(
								'top_left'      => __( 'Top Left' ),
								'top_center'    => __( 'Top Center' ),
								'top_right'     => __( 'Top Right' ),
								'middle_left'   => __( 'Middle Left' ),
								'middle_center' => __( 'Middle Center' ),
								'bottom_left'   => __( 'Bottom Left' ),
								'bottom_center' => __( 'Bottom Center' ),
								'bottom_right'  => __( 'Bottom Right' ),
							),
						)),
					),
				)),
			),
		) );
		$fm->activate_submenu_page();
	} );
}
