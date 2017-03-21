/*global jQuery, wp, wordcamp, WordCampMentors */

( function( window, $ ) {

	'use strict';

	window.wordcamp = window.wordcamp || {};

	wordcamp.MentorsApp = function() {
		return {
			views: {},
			cache: {}
		};
	};

	wordcamp.mentors = new wordcamp.MentorsApp();

	var App = $.extend( wordcamp.mentors, WordCampMentors, {
		/**
		 * Load scripts and then kick off the app.
		 *
		 * The scripts will populate properties of the App object, such as views.
		 */
		load: function() {
			App.getMultipleScripts( App.scripts ).done( App.init );
		},

		/**
		 * Initialize the app.
		 */
		init: function() {
			var cache = App.cache;

			cache.list = new wordcamp.mentors.views.List( { el: '#the-list' } );
		},

		/**
		 * Load an array of scripts using promises so a callback can be
		 * used when all scripts have finished loading.
		 *
		 * @link https://stackoverflow.com/a/11803418
		 *
		 * @param paths
		 * @returns {*|$.Deferred.promise}
		 */
		getMultipleScripts: function( paths ) {
			var _arr = $.map( paths, function( path ) {
					return $.getScript( path );
				});

			_arr.push( $.Deferred( function( deferred ) {
				$( deferred.resolve );
			}));

			return $.when.apply( $, _arr );
		}
	});

	// Ensure the Backbone client is loaded before getting started.
	wp.api.loadPromise.done( App.load );

} )( window, jQuery );