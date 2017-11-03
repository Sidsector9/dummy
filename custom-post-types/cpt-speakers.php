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
