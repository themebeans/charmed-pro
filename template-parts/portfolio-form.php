<?php
/**
 * The project "Hire Me" form.
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

if ( isset( $_POST['submitted'] ) ) {
	if ( trim( $_POST['contactName'] ) === '' ) {
		$hasError = true;
	} else {
		$name = trim( $_POST['contactName'] );
	}

	if ( trim( $_POST['email'] ) === '' ) {
		$hasError = true;
	} elseif ( ! is_email( trim( $_POST['email'] ) ) ) {
		$hasError = true;
	} else {
		$email = trim( $_POST['email'] );
	}

	if ( trim( $_POST['phone'] ) === '' ) {
		$hasError = true;
	} else {
		$phone = trim( $_POST['phone'] );
	}

	if ( trim( $_POST['timezone'] ) === '' ) {
		$hasError = true;
	} else {
		$timezone = trim( $_POST['timezone'] );
	}

	if ( trim( $_POST['subject_select'] ) === '' ) {
		$hasError       = true;
		$subject_select = '';
	} else {
		$subject_select = trim( $_POST['subject_select'] );
	}

	if ( trim( $_POST['comments'] ) === '' ) {
		$hasError = true;
	} else {
		if ( function_exists( 'stripslashes' ) ) {
			$comments = stripslashes( trim( $_POST['comments'] ) );
		} else {
			$comments = trim( $_POST['comments'] );
		}
	}

	if ( ! isset( $hasError ) ) {

		$site_name    = get_bloginfo( 'name' );
		$contactEmail = get_theme_mod( 'portfolio_cta_email' );

		if ( ! isset( $contactEmail ) || ( $contactEmail === '' ) ) {
			$contactEmail = get_option( 'contact_email' );
		}

		$subject = '[' . $site_name . ' Contact Form - ' . $subject_select . ' ] ';
		$body    = "Name: $name \n\nEmail: $email \n\nPhone: $phone \n\nTimezone: $timezone \n\nMessage: $comments";

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
?>

<section id="formContainer" class="formContainer">

	<div class="project-form">

		<form action="<?php the_permalink(); ?>" id="ProjectForm" method="post">

			<div class="project-form--wrapper clearfix">

				<header>
					<h2><?php echo esc_html( get_theme_mod( 'portfolio_cta_header', esc_html__( 'Lets Talk', 'charmed-pro' ) ) ); ?></h2>

					<?php if ( get_theme_mod( 'portfolio_cta_subject1' ) ) { ?>

						<?php
						$subject_1 = get_theme_mod( 'portfolio_cta_subject1' );
						$subject_2 = get_theme_mod( 'portfolio_cta_subject2' );
						$subject_3 = get_theme_mod( 'portfolio_cta_subject3' );
						$subject_4 = get_theme_mod( 'portfolio_cta_subject4' );
						$subject_5 = get_theme_mod( 'portfolio_cta_subject5' );
						?>

						<select id="subject_select" name="subject_select">
							<?php
							if ( $subject_1 ) {
								echo '<option class="subject_1" value="' . esc_attr( $subject_1 ) . '">' . esc_html( $subject_1 ) . '</option>'; }
?>
							<?php
							if ( $subject_2 ) {
								echo '<option class="subject_2" value="' . esc_attr( $subject_2 ) . '">' . esc_html( $subject_2 ) . '</option>'; }
?>
							<?php
							if ( $subject_3 ) {
								echo '<option class="subject_3" value="' . esc_attr( $subject_3 ) . '">' . esc_html( $subject_3 ) . '</option>'; }
?>
							<?php
							if ( $subject_4 ) {
								echo '<option class="subject_4" value="' . esc_attr( $subject_4 ) . '">' . esc_html( $subject_4 ) . '</option>'; }
?>
							<?php
							if ( $subject_5 ) {
								echo '<option class="subject_5" value="' . esc_attr( $subject_5 ) . '">' . esc_html( $subject_5 ) . '</option>'; }
?>
						</select>

					<?php } ?>

				</header>



				<div class="group">
					<input placeholder="<?php echo esc_attr__( 'Name', 'charmed-pro' ); ?>" type="text" name="contactName" id="contactName" value="
													<?php
													if ( isset( $_POST['contactName'] ) ) {
														echo esc_html( $_POST['contactName'] );}
?>
" class="required requiredField" required/>
					<label for="contactName"><?php echo esc_html__( 'Name', 'charmed-pro' ); ?></label>
				</div>

				<div class="group">
					<input placeholder="<?php echo esc_attr__( 'Email', 'charmed-pro' ); ?>" type="text" name="email" id="email" value="
													<?php
													if ( isset( $_POST['email'] ) ) {
														echo esc_html( $_POST['email'] );}
?>
" class="required requiredField email" required/>
					<label for="email"><?php echo esc_html__( 'Email', 'charmed-pro' ); ?></label>
				</div>

				<div class="group phone">
					<input placeholder="<?php echo esc_attr__( 'Phone', 'charmed-pro' ); ?>" type="text" name="phone" id="phone" value="
													<?php
													if ( isset( $_POST['phone'] ) ) {
														echo esc_html( $_POST['phone'] );}
?>
" class="required requiredField" required/>
					<label for="phone"><?php echo esc_html__( 'Phone', 'charmed-pro' ); ?></label>
				</div>

				<div class="group timezone">
					<input placeholder="<?php echo esc_attr__( 'Timezone', 'charmed-pro' ); ?>" type="text" name="timezone" id="timezone" value="
													<?php
													if ( isset( $_POST['timezone'] ) ) {
														echo esc_html( $_POST['timezone'] );}
?>
" class="required requiredField" required/>
					<label for="timezone"><?php echo esc_html__( 'Timezone', 'charmed-pro' ); ?></label>
				</div>

				<div class="group last">
					<textarea placeholder="<?php echo esc_attr__( 'How can I help?', 'charmed-pro' ); ?>" name="comments" id="commentsText" rows="20" cols="30" class="required requiredField" required>
														<?php
														if ( isset( $_POST['comments'] ) ) {
															if ( function_exists( 'stripslashes' ) ) {
																echo stripslashes( $_POST['comments'] );
															} else {
																echo esc_html( $_POST['comments'] ); }
														}
?>
</textarea>
					<label for="commentsText"><?php echo esc_html__( 'How can I help?', 'charmed-pro' ); ?></label>
				</div>

				<div class="submit">
					<input type="hidden" name="submitted" id="submitted" value="true"  />
					<button type="submit" class="button"><?php echo get_theme_mod( 'portfolio_cta_button', 'Send Email' ); ?></button>
				</div>

			</div>

		</form>



	</div>

</section>
