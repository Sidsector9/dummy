<?php

add_action( 'init', 'thekeynote_sessions_cpt' );
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

add_action( 'init', 'thekeynote_speaker_category' );
/**
 * Registers Speaker Category
 */
function thekeynote_speaker_category() {
	register_taxonomy(
		'speaker_category',
		'speaker',
		array(
			'label'        => __( 'Speaker Category' ),
			'rewrite'      => array(
				'slug' => 'speak_cat',
			),
			'hierarchical' => true,
		)
	);
}

add_action( 'fm_post_session', 'session_timing_field' );
/**
 * Session Time Metabox
 */
function session_timing_field() {
	$fm = new Fieldmanager_TextField( array(
		'name' => 'session_time',
		'attributes' => array(
			'size' => '25',
		),
	) );

	$fm->add_meta_box( 'Session Time', array( 'session' ) );
}

add_action( 'fm_post_session', 'sessions_options' );
/**
 * Creates Sessions Options metabox and adds fields to it.
 */
function sessions_options() {
	$fdp = new Fieldmanager_Datasource_Post();
	$fdp->query_args = array(
		'post_type' => 'speaker',
	);

	$fm = new Fieldmanager_Group( array(
		'name' => 'sessions_group',
		'children' => array(
			'conference_type' => new Fieldmanager_Select( 'Conference Type', array(
				'name' => 'conference_type',
				'options' => array(
					'red'   => 'Conference',
					'green' => 'Break',
				),
			)),

			'session_date' => new Fieldmanager_Datepicker( 'Session Date', array(
				'name' => 'session_date',
			)),

			'session_location' => new Fieldmanager_Textfield( 'Location', array(
				'attributes' => array(
					'size' => 25,
				),
			)),

			'website' => new Fieldmanager_Link( 'Website', array(
				'attributes' => array(
					'size' => 25,
				),
			)),

			'session_speakers' => new Fieldmanager_Select( 'Session Speakers', array(
				'name' => 'session_speakers',
				'multiple' => true,
				'attributes' => array(
					'size' => 5,
				),
				'datasource' => $fdp,
			)),
		),
	));

	$fm->add_meta_box( 'Session Options', array( 'session' ) );
}
