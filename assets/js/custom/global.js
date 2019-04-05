/**
* Theme javascript functions file.
*
*/

( function( $ ) {
	"use strict";

	var
	body          = $("body"),
	container     = $(".bricks"),
	active        = ("active"),
	formContainer = $(".formContainer"),
	dur           = 200;

	/**
	 * Removes "no-js" and adds "js" classes to the body tag.
	 */
	(function(html){html.className = html.className.replace(/\bno-js\b/,'js');})(document.documentElement);

	/**
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	/**
	 * Lazy loading.
	 */
	function lazyLoad() {
		var myLazyLoad = new LazyLoad({
			elements_selector: ".lazyload"
		});
	}
	lazyLoad();

	/**
	* Wow Animations.
	*/
	new WOW().init();

	/**
	 * Sticky Content.
	 */
	function stickyPortfolioContent() {

		var
		$window = $( window );

		$( '.has-sticky-content .post--wrapper' ).sticky({
			topSpacing: 50,
			responsiveBreakpoint: 900
		});

		$( '.has-sticky-content .site-footer' ).sticky({
			topSpacing: 90,
			responsiveBreakpoint: 900
		});
	}

	/* Fade in .back-to-top after scrolling 500px */
	function projectCTAFadeIn() {
		var topLink = $( '.project-cta' );

		if ( jQuery( window ).scrollTop() > 700) {
			topLink.fadeIn(500);
		} else {
			topLink.fadeOut(500);
		}
	}

	/* Document Ready */
	$( document ).ready(function() {

		/* FitVids */
		$( 'body' ).fitVids();

		stickyPortfolioContent();

		supportsInlineSVG();

		if ( true === supportsInlineSVG() ) {
            		document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
        	}

        	$( '.animsition' ).animsition({
        		inClass: 'blur-intro',
        		outClass: 'blur-exit',
        		inDuration: 800,
        		outDuration: 800,
        		linkElement: 'a:not([target="_blank"]):not(#cancel-comment-reply-link):not(.customize-unpreviewable):not([href^="#"]):not([href^="mailto"]):not([href^="tel"]):not([href^="javascript:void(0);"]):not(.mobile-menu-toggle):not(.lightbox-link):not(.comment-reply-link):not(.input-control submit):not(.ab-item):not(#filter__selector):not(.no-animiate):not(.portfolio-professional__pinterest)',
        		loading: false,
        		unSupportCss: [
	        		'animation-duration',
	        		'-webkit-animation-duration',
	        		'-o-animation-duration'
        		],
        	} ).one( 'animsition.inEnd',function() {
        		body.addClass( 'animsition--done' );
        	} );

		/* Enable menu toggle for small screens */
		$( '.mobile-menu-toggle' ).on( 'click', function() {
			body.toggleClass( 'open-nav' );
		} );

		/* Single Project CTA Form */
		$( '.project-cta .button' ).click(function(e) {
			e.preventDefault();

			if ( formContainer.hasClass( active ) ) {
				setTimeout( function() {
					formContainer.removeClass( active )
				}, 500 );
			} else {
				formContainer.addClass( active );
			}

			setTimeout( function() {
				body.toggleClass( 'switchToForm' )
			}, 100 );
		} );

		/* Project form subject selector */
		$( '#subject_select' ).dropkick();
	}),

	/* Scroll functions */
	$(window).scroll(function() {
		projectCTAFadeIn();
	});

	/* Portfolio Isotope */
	function isotope() {

		var container = $( '.bricks' );

		container.imagesLoaded( function() {

			container.isotope({
				transitionDuration: '0.2s',
				itemSelector: '.bricks .brick',
				resizesContainer: true,
				isResizeBound: true,
				stagger: 30,
				layoutMode: 'masonry',
				getSortData: {
					views: '[data-views]',
					date: '[data-date]',
				},
				sortAscending: {
					views: false,
					date: false,
				},
				hiddenStyle: {
					opacity: 0
				},
				visibleStyle: {
					opacity: 1
				}
			});

			/* Portfolio Sorting */
			$( '.sort-group a' ).on( 'click', function(e) {
				var
				b = $( this ).attr( 'data-sort-by' ),
				c = $( '.sort-group a' );

				e.preventDefault();

				container.isotope( {
					sortBy: b
				} );

				c.removeClass( active );
				$( this ).addClass( active );

				container.addClass( 'is-filtering' );
			});

			/* Portfolio Filtering */
			$( '.filter-group a' ).on( 'click', function(e) {
				var
				b = $( this ).attr( 'data-filter' ),
				c = $('.project-filter a');

				e.preventDefault();

				container.isotope( {
					filter: b,
					stagger: 50
				} );

				c.removeClass( active );

				$( this ).addClass( active );

				container.addClass( 'is-filtering' );
			});

			/* Portfolio Random Suffle */
			$( '.shuffle-btn' ).on( 'click', function() {
				container.isotope('shuffle');
			} );

			/* Portfolio Infinite scrolling */
			container.infinitescroll( {
				navSelector  : '#page_nav',
				nextSelector : '#page_nav a',
				itemSelector : '.brick-fullwidth.brick .brick',
			},

			function( newElements ) {

				var myLazyLoad = new LazyLoad({
					elements_selector: ".lazyload"
				});

				myLazyLoad.update();

				var newElems = $( newElements );

				newElems.imagesLoaded( function() {
					container.isotope( 'appended', newElems, true );
				} );
			} );
		} );
	}

	$( window ).load( function() {
		isotope();
	} );

} )( jQuery );