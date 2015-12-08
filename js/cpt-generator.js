jQuery( document ).ready( function() {

	var form_template = wp.template( 'cptg-form' );

	jQuery( '.cptg-form-wrap' ).append( form_template( cptg_data ) );

} ); // ready()
