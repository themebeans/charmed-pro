<?php
/**
 * The contact form.
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

if ( isset( $_POST['submitted'] ) ) {

	if ( trim( $_POST['messageName'] ) === '' ) {
		$hasError = true;
	} else {
		$name = trim( $_POST['messageName'] );
	}

	if ( trim( $_POST['messageEmail'] ) === '' ) {
		$hasError = true;
	} elseif ( ! is_email( trim( $_POST['messageEmail'] ) ) ) {
		$hasError = true;
	} else {
		$email = trim( $_POST['messageEmail'] );
	}

	if ( trim( $_POST['messageContent'] ) === ' ' ) {
		$hasError = true;
	} else {
		if ( function_exists( 'stripslashes' ) ) {
			$content = stripslashes( trim( $_POST['messageContent'] ) );
		} else {
			$content = trim( $_POST['messageContent'] );
		}
	}

	do_action( 'bean_after_contactform_errors' );

	if ( ! isset( $hasError ) ) {

		$site_name    = get_bloginfo( 'name' );
		$contactEmail = get_theme_mod( 'contact_email' );

		if ( ! isset( $contactEmail ) || ( $contactEmail == '' ) ) {
			$contactEmail = get_option( 'admin_email' );
		}

		$subject_content = '[' . $site_name . ' Contact Form]';
		$subject         = apply_filters( 'bean_contactform_emailsubject', $subject_content );

		$body_content = "Name: $name \n\nEmail: $email \n\nMessage: $content";
		$body         = apply_filters( 'bean_contactform_emailbody', $body_content );

		$headers = 'Reply-To: ' . $email;

		/*
		By default, this form will send from wordpress@yourdomain.com in order to work with
		a number of web hosts' anti-spam measures. If you want the from field to be the
		user sending the email, please uncomment the following line of code.
		*/

		wp_mail( $contactEmail, $subject, $body, $headers );

		$emailSent = true;
	}
}

if ( isset( $emailSent ) && $emailSent == true ) : ?>

	<div class="contact-alert success">
		<?php echo apply_filters( 'bean_contactform_success_msg', esc_html__( 'Your message was sent. Thanks.', 'charmed-pro' ) ); ?>
	</div>

<?php
endif;

if ( isset( $hasError ) || isset( $captchaError ) ) :
?>

	<div class="contact-alert fail">
		<?php echo apply_filters( 'bean_contactform_error_msg', esc_html__( 'An error occured. Try again.', 'charmed-pro' ) ); ?>
	</div>

<?php endif; ?>

<form xid="contact-form" class="bean-contact-form" method="post" id="contact-form" >

	<div class="group name">
		<input type="text" name="messageName" id="messageName" value="
		<?php
		if ( isset( $_POST ['messageName'] ) ) {
			echo esc_html( $_POST['messageName'] );}
?>
" class="required requiredField" required/>
		<span class="bar"></span>
		<label for="messageName"><?php esc_html_e( 'Name ', 'charmed-pro' ); ?></label>
	</div>

	<?php do_action( 'bean_after_contactform_namefield' ); ?>

	<div class="group email">
		<input type="text" name="messageEmail" id="messageEmail" value="
		<?php
		if ( isset( $_POST ['messageEmail'] ) ) {
			echo esc_html( $_POST['messageEmail'] );}
?>
" class="required requiredField email" required/>
		<span class="bar"></span>
		<label for="messageEmail"><?php esc_html_e( 'Email ', 'charmed-pro' ); ?></label>
	</div>

	<?php do_action( 'bean_after_contactform_emailfield' ); ?>

	<div class="group message last">
		<textarea name="messageContent" id="messageContent" rows="20" cols="30" class="required requiredField" required>
		<?php
		if ( isset( $_POST ['messageContent'] ) ) {
			if ( function_exists( 'stripslashes' ) ) {
				echo stripslashes( $_POST['messageContent'] );
			} else {
				echo esc_html( $_POST['messageContent'] ); }
		}
?>
</textarea>
		<span class="bar"></span>
		<label for="messageContent"><?php esc_html_e( 'Message ', 'charmed-pro' ); ?></label>
	</div>

	<?php do_action( 'bean_after_contactform_allfields' ); ?>

	<div class="submit">
		<input type="hidden" name="submitted" id="submitted" value="true" />
		<span class="bar"></span>
		<button type="submit" class="button"><?php echo get_theme_mod( 'portfolio_cta_button', 'Send Email' ); ?></button>
	</div>

	<?php do_action( 'bean_after_contactform_submit' ); ?>

</form>
