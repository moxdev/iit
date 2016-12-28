<?php
/**
 * MM4 You Theme Customizer.
 *
 * @package MM4 You
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mm4_you_customize_register( $wp_customize ) {
	//$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	//$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	//$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->remove_section("colors");

	// GENERAL CONTACT INFORMATION
	$wp_customize->add_section(
        'company_contact_information',
        array(
            'title' => 'Company Contact Information'
        )
    );
	$wp_customize->add_setting(
		'setting_name',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_name',
		array(
			'label' => 'Location Name',
			'section' => 'company_contact_information',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_latitude',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_latitude',
		array(
			'label' => 'Latitude',
			'section' => 'company_contact_information',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_longitude',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_longitude',
		array(
			'label' => 'Longitude',
			'section' => 'company_contact_information',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_address',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_address',
		array(
			'label' => 'Address',
			'section' => 'company_contact_information',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_address2',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_address2',
		array(
			'label' => 'Address 2',
			'section' => 'company_contact_information',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_city',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_city',
		array(
			'label' => 'City',
			'section' => 'company_contact_information',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_state',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_state',
		array(
			'label' => 'State',
			'section' => 'company_contact_information',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_zip',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_zip',
		array(
			'label' => 'Zip',
			'section' => 'company_contact_information',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_phone',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_phone',
		array(
			'label' => 'Phone',
			'section' => 'company_contact_information',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_fax',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_fax',
		array(
			'label' => 'Fax',
			'section' => 'company_contact_information',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_email',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_email',
		array(
			'label' => 'Email',
			'section' => 'company_contact_information',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_hours_1',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_hours_1',
		array(
			'label' => 'Hours 1',
			'section' => 'company_contact_information',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_hours_2',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_hours_2',
		array(
			'label' => 'Hours 2',
			'section' => 'company_contact_information',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_hours_3',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_hours_3',
		array(
			'label' => 'Hours 3',
			'section' => 'company_contact_information',
			'type' => 'text',
		)
	);

	// SOCIAL MEDIA LINKS
	$wp_customize->add_section(
        'social_media',
        array(
            'title' => 'Social Media'
        )
    );
	$wp_customize->add_setting(
		'setting_facebook',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_facebook',
		array(
			'label' => 'Facebook URL',
			'section' => 'social_media',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_twitter',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_twitter',
		array(
			'label' => 'Twitter URL',
			'section' => 'social_media',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_google',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_google',
		array(
			'label' => 'Google+ URL',
			'section' => 'social_media',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_linked_in',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_linked_in',
		array(
			'label' => 'LinkedIn URL',
			'section' => 'social_media',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting(
		'setting_you_tube',
		array(
			'sanitize_callback' => 'sanitize_text',
		)
	);
	$wp_customize->add_control(
		'setting_you_tube',
		array(
			'label' => 'You Tube URL',
			'section' => 'social_media',
			'type' => 'text',
		)
	);
}
add_action( 'customize_register', 'mm4_you_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mm4_you_customize_preview_js() {
	wp_enqueue_script( 'mm4_you_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'mm4_you_customize_preview_js' );

/**
 * SANITIZE WHAT IS ENTERED
*/

function sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}