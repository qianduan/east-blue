/**
 * Functionality specific to Twenty Thirteen.
 *
 * Provides helper functions to enhance the theme experience.
 */

( function( $ ) {
	var body    = $( 'body' ),
	    _window = $( window );

	/**
	 * Enables menu toggle for small screens.
	 */
	( function() {
		var nav = $( '.main-navigation' ), menuButton,searchButton, menu, searchArea;
		if ( ! nav ) {
			return;
		}
		var topbar = $('.header .topbar')
		menuButton = topbar.find( '.icon-bars' );
		if ( ! menuButton ) {
			return;
		}
		searchButton = topbar.find( '.icon-search' );
		if ( ! searchButton ) {
			return;
		}

		// Hide button if menu is missing or empty.
		menu = nav.find( '.nav-menu' );
		if ( ! menu || ! menu.children().length ) {
			button.hide();
			return;
		}
		searchArea = topbar.find('.search-form');

		menuButton.on( 'click.eastBlue', function() {
			nav.toggleClass( 'toggled-on' );
		} );
		searchButton.on( 'click.eastBlue', function() {
			topbar.toggleClass( 'toggled-search' );
		} );
	} )();

	/**
	 * Makes "skip to content" link work correctly in IE9 and Chrome for better
	 * accessibility.
	 *
	 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
	 */
	_window.on( 'hashchange.eastBlue', function() {
		var element = document.getElementById( location.hash.substring( 1 ) );

		if ( element ) {
			if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) {
				element.tabIndex = -1;
			}

			element.focus();
		}
	} );

	/**
	 * Arranges footer widgets vertically.
	 */
	// if ( $.isFunction( $.fn.masonry ) ) {
	// 	var columnWidth = body.is( '.sidebar' ) ? 228 : 245;

	// 	$( '#secondary .widget-area' ).masonry( {
	// 		itemSelector: '.widget',
	// 		columnWidth: columnWidth,
	// 		gutterWidth: 20,
	// 		isRTL: body.is( '.rtl' )
	// 	} );
	// }

	var topBtn=$(".backToTop");
	topBtn.hide();
	$(function () {
		$(window).scroll(function(){
			if ($(window).scrollTop()>400){
				topBtn.fadeIn(500);
			}
			else
			{
				topBtn.fadeOut(500);
			}
		});
		topBtn.click(function(){
			$('body,html').animate({scrollTop:0},500);
		return false;
		});
	});
} )( jQuery );