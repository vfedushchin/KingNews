(function($){
	"use strict";

	CHERRY_API.utilites.namespace('admin_theme_script');
	CHERRY_API.admin_theme_script = {
		init: function ( target ) {
			var self = this;
			if( CHERRY_API.status.document_ready ){
				self.render( target );
			}else{
				CHERRY_API.variable.$document.on('ready', self.render( target ) );
			}
		},
		render: function ( target ) {
			/*$( document ).on( 'widget-added widget-updated', function( event, data ){
				$( window ).trigger( 'cherry-ui-elements-init', { 'target': data } );
			} );*/
		}
	}
	CHERRY_API.admin_theme_script.init( $( 'body' ) );
}(jQuery));
