/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

( function( $ ) {

	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title a' ).html( newval );
		} );
	} );

	wp.customize( 'custom_logo', function( value ) {
		value.bind( function( to ) {

			if ( to ) {

				$( 'h1.site-title' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});

			} else {

				// Give it a few ms to remove the image before we show the title back.
				setTimeout( function() {
					$( 'h1.site-title' ).css({
						clip: 'auto',
						position: 'relative'
					});

					$( 'h1.site-title' ).removeClass( 'hidden' );
				}, 800 );
			}
		} );
	} );

	wp.customize( 'custom_logo_max_width', function( value ) {
		value.bind( function( newval ) {
			$( 'body .custom-logo-link img.custom-logo' ).css( 'width', newval );
		} );
	} );

	wp.customize( 'portfolio_lightbox-colorscheme', function( value ) {
		value.bind( function( newval ) {
			$( 'body' ).attr('data-lightbox-scheme', newval );
		} );
	} );

	wp.customize( 'header_introduction', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

	wp.customize( 'contact_button', function( value ) {
		value.bind( function( newval ) {
			$( '.bean-contact-form .button' ).html( newval );
		} );
	} );

	wp.customize( 'portfolio_cta_button_text', function( value ) {
		value.bind( function( newval ) {
			$( '.project-cta .cta-init' ).html( newval );
		} );
	} );

	wp.customize( 'portfolio_cta_header', function( value ) {
		value.bind( function( newval ) {
			$( '#ProjectForm header h2' ).html( newval );
		} );
	} );

	wp.customize( 'portfolio_cta_button', function( value ) {
		value.bind( function( newval ) {
			$( '.project-form .button' ).html( newval );
		} );
	} );

	wp.customize( 'portfolio_cta_email', function( value ) { } );

	wp.customize( 'contact_email', function( value ) { } );

	wp.customize( 'portfolio_sorting', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.sort-wrapper' ).removeClass( 'hidden' );
			} else {
				$( '.sort-wrapper' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'portfolio_filtering', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.filter-wrapper' ).removeClass( 'hidden' );
			} else {
				$( '.filter-wrapper' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'powered_by_charmed', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.powered-by-charmed' ).removeClass( 'hidden' );
			} else {
				$( '.powered-by-charmed' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'powered_by_wordpress', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.powered-by-wordpress' ).removeClass( 'hidden' );
			} else {
				$( '.powered-by-wordpress' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'portfolio_social', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.portfolio-sharing' ).removeClass( 'hidden' );
			} else {
				$( '.portfolio-sharing' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'copyright_text_display', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.copyright' ).removeClass( 'hidden' );
			} else {
				$( '.copyright' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'copyright_text', function( value ) {
		value.bind( function( newval ) {
			$( '.copyright' ).html( newval );
		} );
	} );

	wp.customize( 'portfolio_white_play_icon', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.lightbox-link.lightbox-play' ).addClass( 'play--white' );
			} else {
				$( '.lightbox-link.lightbox-play' ).removeClass( 'play--white' );
			}
		} );
	} );

	wp.customize( 'body_typography_color', function( value ) {
		value.bind( function( newval ) {
			$('body.page, body.home, body.single, body button, body input, body select, body textarea, body.single .project-meta h6, body.single .project-meta h6 a').css('color', newval );
		} );
	} );

	wp.customize( 'social_svg_color', function( value ) {
		value.bind( function( newval ) {
			$('body .social-navigation a svg, body .portfolio-sharing .svg__wrapper svg, body .widget-area .menu-social-menu-container a svg').css('fill', newval );
		} );
	} );

	wp.customize( 'theme_background_color', function( value ) {
		value.bind( function( newval ) {
			$('body, body .post--wrapper, body .sticky-wrapper, body .project-caption').css('background-color', newval );
		} );
	} );

	wp.customize( 'header_a_color', function( value ) {
		value.bind( function( newval ) {
			$('body .header .project-filter a, body .header .main-navigation a').css('color', newval );
		} );
	} );

	wp.customize( 'footer_color', function( value ) {
		value.bind( function( newval ) {
			$('body .site-footer, body .site-footer a').css('color', newval );
		} );
	} );

	wp.customize( 'wt_color', function( value ) {
		value.bind( function( newval ) {
			$('body h6.widget-title, body .project-taxonomy h6, body .project-taxonomy a').css('color', newval );
		} );
	} );

	wp.customize( 'header_typography_color', function( value ) {
		value.bind( function( newval ) {
			$('body h1, body h2, body h3, body h4, body h5, body h1.site-logo a').css('color', newval );
		} );
	} );

} )( jQuery );




















