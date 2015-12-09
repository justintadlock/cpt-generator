jQuery( document ).ready( function() {

	var form_template = wp.template( 'cptg-form' );
	var output_template = wp.template( 'cptg-output' );

	jQuery( '.cptg-form-wrap' ).append( form_template( cptg_data ) );

	//console.log( cptg_data );

	var output_data = {
		copy_paste       : '<!-- there be dragons -->',
		post_type        : cptg_data.post_type_singular,
		post_type_plural : cptg_data.post_type_plural,
		cap_singular     : cptg_data.post_type_singular,
		cap_plural       : cptg_data.post_type_singular + 's'
	};

	jQuery( '.cptg-output-wrap' ).html( output_template( output_data ) );


	function cptg_print_post_type( slug ) {

		// Sanitize the role.
		slug = slug.toLowerCase().trim().replace( /<.*?>/g, '' ).replace( /\s/g, '_' ).replace( /[^a-zA-Z0-9_]/g, '' );

		output_data.post_type = slug;
		output_data.cap_singular = slug;
		output_data.cap_plural = slug + 's';
		output_data.post_type_plural = slug + 's';

		// Add the text.
		jQuery( '.cptg-output-wrap' ).html( output_template( output_data ) );
	};

	// Check the role name input box for key presses.
	jQuery( 'input.cptg-field-post-type-singular' ).keyup(
		function() {

			//if ( ! jQuery( 'input.cptg-field-post-type-singular' ).val() )
			//	alert( this.value );
				cptg_print_post_type( this.value );
		}
	); // .keyup











} ); // ready()
