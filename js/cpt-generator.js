jQuery( document ).ready( function() {

	// Store the form fields.
	var field_type_singular = 'input.cptg-field-post-type-singular';
	var field_type_plural   = 'input.cptg-field-post-type-plural';

	// Underscore templates.
	var form_template   = wp.template( 'cptg-form'   );
	var output_template = wp.template( 'cptg-output' );

	// Data to pass to the form template.
	var form_data = {
		type_singular  : 'example',
		type_plural    : '',
		label_singular : '',
		label_plural   : '',
		labels         : cptg_form_labels
	}

	// Data to pass to the output template.
	var output_data = {
		type_singular : form_data.type_singular,
		type_plural   : form_data.type_plural,
		labels        : form_data.labels
	};

	// Print the templates to the page.
	jQuery( '.cptg-form-wrap'   ).html( form_template(   form_data   ) );
	jQuery( '.cptg-output-wrap' ).html( output_template( output_data ) );

	// Function to sanitize post type name.
	// @todo Limit to 20 characters.
	function cptg_sanitize_post_type( post_type ) {

		return post_type.toLowerCase().trim().replace( /<.*?>/g, '' ).replace( /\s/g, '_' ).replace( /[^a-zA-Z0-9_]/g, '' );
	}

	// Updates the output template when we get a new post type name.
	function cptg_update_type_singular( post_type ) {

		post_type = cptg_sanitize_post_type( post_type );

		output_data.type_singular = post_type;

		// If there's no plural value, auto-create one by appending an "s" to the post type name.
		if ( ! jQuery( field_type_plural ).val() )
			output_data.type_plural   = post_type + 's';

		// Update output template.
		jQuery( '.cptg-output-wrap' ).html( output_template( output_data ) );
	}

	// Updates the output template when we get a new post type name.
	function cptg_update_type_plural( post_type ) {

		post_type = cptg_sanitize_post_type( post_type );

		output_data.type_plural = post_type;

		// Update output template.
		jQuery( '.cptg-output-wrap' ).html( output_template( output_data ) );
	}

	// Check the type singular input box for key presses.
	jQuery( field_type_singular ).keyup(
		function() {

			cptg_update_type_singular( this.value );
		}
	); // .keyup

	// Check the type plural input box for key presses.
	jQuery( field_type_plural ).keyup(
		function() {

			cptg_update_type_plural( this.value );
		}
	); // .keyup

} ); // ready()
