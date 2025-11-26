(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(document).ready(function () {
		console.log('SFA Admin JS loaded');

		// Team search functionality
		var searchInput = $('#sfa-team-search');
		var dataTable = $('.sfa-data-table');

		if (searchInput.length && dataTable.length) {
			console.log('Search input and table found, attaching search handler');

			searchInput.on('keyup', function () {
				var searchTerm = $(this).val().toLowerCase();
				console.log('Searching for:', searchTerm);

				var visibleCount = 0;
				dataTable.find('tbody tr').each(function () {
					var $row = $(this);
					var teamName = $row.find('td:first').text().toLowerCase();
					var teamId = $row.find('td:last').text().toLowerCase();

					if (teamName.indexOf(searchTerm) > -1 || teamId.indexOf(searchTerm) > -1) {
						$row.show();
						visibleCount++;
					} else {
						$row.hide();
					}
				});

				console.log('Visible rows:', visibleCount);
			});
		} else {
			console.log('Search input or table not found');
			console.log('Search input exists:', searchInput.length);
			console.log('Data table exists:', dataTable.length);
		}
	});

})(jQuery);
