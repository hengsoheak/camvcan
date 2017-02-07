( function( api ) {

	// Extends our custom "mercantile" section.
	api.sectionConstructor['mercantile'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
