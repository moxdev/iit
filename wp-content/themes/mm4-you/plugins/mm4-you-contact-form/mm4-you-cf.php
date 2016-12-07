<?php
/*
Plugin Name: MM4 You Contact Form
Description: Contact form to work with the MM4 You theme
Version: 1
Author: Chris Stielper
License: GPL
*/

add_action('admin_menu', 'mm4_you_add_gcf_interface');

function mm4_you_add_gcf_interface() {
	add_menu_page( 'Contact Form Page', 'Contact Forms', 'manage_options', 'mm4_you_cf_options', 'mm4_you_cf_options' );
}

function mm4_you_cf_options() {?>
    <form method="post" action="options.php">
    <?php wp_nonce_field('update-options') ?>
    	<h1>Contact Form Settings</h1>
		<p>Enter the page ID of the contact form "Thank You" page. This is the page users will see after the form is submitted.<br>
		<input type="text" name="mm4-you-cf-page-id" size="5" value="<?php echo get_option('mm4-you-cf-page-id'); ?>"></p>
		
		<p>Enter the email address(es) that you would like the contact form to submit to. (Separate multiple email addresses with a comma and replace the "@" symbol with "_AT_").<br>
		<input type="text" name="mm4-you-cf-email-add" size="25" value="<?php echo get_option('mm4-you-cf-email-add'); ?>"></p>
		
		<input type="hidden" name="action" value="update">
		<input type="hidden" name="page_options" value="mm4-you-cf-page-id, mm4-you-cf-email-add">
		
		<p><input type="submit" name="Submit" value="Update Options"></p>
		
	</form>
<?php }

function mm4_you_quick_contact_form() { 
	$tyPage = get_option('mm4-you-cf-page-id'); 
	$action = get_permalink($tyPage); ?>
	<div class="form-quick-contact-wrapper">
		<h2>Fill out the form below for more information</h2>
		<form id="form-quick-contact" name="form-quick-contact" method="post" action="<?php echo $action; ?>" novalidate>
			<?php $recipients = get_option('mm4-you-cf-email-add'); ?>
			<input type="hidden" value="<?php echo $recipients; ?>" name="recipients" id="recipients">
			<input type="hidden" value="Online Contact Form for <?php echo bloginfo('name'); ?>" name="subject" id="subject">
			<div class="flex">
				<div>
					<label for="contact-names"><span class="asterisk">*</span> Name</label>
					<input type="text" id="contact-names" name="contact-names">
				</div>
				<div>
					<label for="contact-email"><span class="asterisk">*</span> Email</label>
					<input type="email" id="contact-email" name="contact-email">
				</div>
				<div>
					<label for="contact-phone">Phone</label>
					<input type="tel" id="contact-phone" name="contact-phone">
				</div>
			</div>
			<div class="flex">
				<div>
					<label for="contact-comments">Comments</label>
					<textarea name="contact-comments" rows="5" id="contact-comments"></textarea>
				</div>
			</div>
			<label for="spam" class="honey">What is 1 plus two + 4?</label>
			<input name="spam" type="text" size="4" id="spam" maxlength="4" class="honey">
			<div class="flex">
				<div>
					<span class="error-box"></span>
				</div>
			</div>
			<div class="flex">
				<div>
					<input type="submit" value="Contact Us">
				</div>
			</div>
		</form>
	</div>
<?php }

function mm4_you_add_quick_contact_form() {
	if( function_exists('get_field') ) {
		$addForm = get_field('quick_contact_form');
		$blogPage = get_option( 'page_for_posts' );
		$addFormBlog = get_field('quick_contact_form', $blogPage);
		if ( $addFormBlog == 'Yes' && is_home() || $addFormBlog == 'Yes' && is_archive() || $addFormBlog == 'Yes' && is_single() ) {
			mm4_you_quick_contact_form();
			wp_enqueue_script( 'mm4-you-validate-lib', get_template_directory_uri() . '/plugins/mm4-you-contact-form/js/validate.min.js', array('jquery'), '20150904', true );
			wp_enqueue_script( 'mm4-you-quick-form-validate', get_template_directory_uri() . '/plugins/mm4-you-contact-form/js/form-quick-validate.js', array('jquery', 'mm4-you-validate-lib'), '20150904', true );
		} else if( $addForm == 'Yes' && is_page() ) {
			mm4_you_quick_contact_form();
			wp_enqueue_script( 'mm4-you-validate-lib', get_template_directory_uri() . '/plugins/mm4-you-contact-form/js/validate.min.js', array('jquery'), '20150904', true );
			wp_enqueue_script( 'mm4-you-quick-form-validate', get_template_directory_uri() . '/plugins/mm4-you-contact-form/js/form-quick-validate.js', array('jquery', 'mm4-you-validate-lib'), '20150904', true );
		}
	}
}

function mm4_you_contact_page_form() {
	$tyPage = get_option('mm4-you-cf-page-id'); 
	$action = get_permalink($tyPage);
	if(is_page_template('page-contact.php')) { 
		wp_enqueue_script( 'mm4-you-validate-lib', get_template_directory_uri() . '/plugins/mm4-you-contact-form/js/validate.min.js', array('jquery'), '20150904', true ); 
		wp_enqueue_script( 'mm4-you-main-form-validate', get_template_directory_uri() . '/plugins/mm4-you-contact-form/js/form-main-validate.js', array('jquery', 'mm4-you-validate-lib'), '20150826', true ); ?>
		<form id="form-main-contact" name="form-main-contact" method="post" action="<?php echo $action; ?>" novalidate>
			<?php $recipients = get_option('mm4-you-cf-email-add'); ?>
			<input type="hidden" value="<?php echo $recipients; ?>" name="recipients" id="recipients">
			<input type="hidden" value="Online Contact Form for <?php echo bloginfo('name'); ?>" name="subject" id="subject">
			<label for="contact-names"><span class="asterisk">*</span> Name</label>
			<input type="text" id="contact-names" name="contact-names">
			<label for="contact-company">Company</label>
			<input type="text" id="contact-company" name="contact-company">
			<label for="contact-add1">Address 1</label>
			<input type="text" id="contact-add1" name="contact-add1">
			<label for="contact-add2">Address 2</label>
			<input type="text" id="contact-add2" name="contact-add2">
			<label for="contact-email"><span class="asterisk">*</span> Email</label>
			<input type="email" id="contact-email" name="contact-email">
			<label for="contact-phone"><span class="asterisk">*</span> Phone</label>
			<input type="tel" id="contact-phone" name="contact-phone">
			<label for="contact-comments">Comments</label>
			<textarea name="contact-comments" rows="5" id="contact-comments"></textarea>
			<label for="spam" class="honey">What is 1 plus two + 4?</label>
			<input name="spam" type="text" size="4" id="spam" maxlength="4" class="honey">
			<div class="error-box"></div>
			<input type="submit" value="Contact Us">
		</form>
	<?php }
}

function mm4_you_cf_require_contact_script() {
	require ('inc/contact.php');
}

function mm4_you_cf_thank_you_page() {
	global $post;
	$ID = $post->ID;
	$tyPage = get_option('mm4-you-cf-page-id');
	// echo 'ID = ' . $ID . '<br>Thank you page = ' . $tyPage . '<br>'; 
	if( $ID == $tyPage ) {
		require ('inc/contact.php');
	}
}

add_action('wp_head', 'mm4_you_cf_thank_you_page');

?>