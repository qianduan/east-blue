/**
 * Functionality specific to East Blue.
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
		var nav = $( '.main-navigation' ), menuButton, searchButton, menu, searchArea;
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

	_window.on( 'hashchange.eastBlue', function() {
		var element = document.getElementById( location.hash.substring( 1 ) );

		if ( element ) {
			if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) {
				element.tabIndex = -1;
			}

			element.focus();
		}
	} );


	( function () {
		var topBtn=jQuery(".backToTop");
		topBtn.hide();
		jQuery(window).scroll(function(){
			if (jQuery(window).scrollTop()>400){
				topBtn.fadeIn(500);
			}
			else
			{
				topBtn.fadeOut(500);
			}
		});
		topBtn.click(function(){
			jQuery('body,html').animate({scrollTop:0},500);
		return false;
		});
	});
	//
	function ProcessFormAjax() {

	var errorNotice = jQuery('.add-error'),
		successNotice = jQuery('.add-success')
		refresher = jQuery('.add-new')
		submit = jQuery('#submit');
	
	var theLanguage = jQuery('html').attr('lang');
	if (theLanguage == 'de-DE') {
		var btnMsg = 'Aktualisieren';
	} else {
		var btnMsg = 'Update';
	}
	

	jQuery("label#quiz_error").hide();
	if (jQuery("input#djd_quiz").val() !== jQuery("input#djd_quiz_hidden").val()) {
		jQuery("label#quiz_error").show();
		jQuery("input#djd_quiz").focus();
		return false;
	}

	var ed = tinyMCE.get('djdsitepostcontent');

	ed.setProgressState(1);
	tinyMCE.get('djdsitepostcontent').save();

	var newPostForm = jQuery(this).serialize();

	
	jQuery('#loading').show;
	jQuery.ajax({
		type:"POST",
		url: jQuery(this).attr('action'),
		data: newPostForm,
		success:function(response){
			ed.setProgressState(0);
			jQuery('#loading').hide;
            if(response == "success") {
				successNotice.show();
				refresher.show();
				submit.html(btnMsg);
			} else {
				errorNotice.show();
			}
		}
	});

	return false;
}
//
} )( jQuery );