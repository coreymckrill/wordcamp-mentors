/** global jQuery, Backbone, _, WordCampMentors, wp, userSettings */

( function( window, $ ) {

	'use strict';

	window.wordcamp = window.wordcamp || {};

	wordcamp.MentorsApp = function() {
		return {
			views: {},
			cache: {}
		}
	};

	wordcamp.mentors = new wordcamp.MentorsApp();

	var App = $.extend( wordcamp.mentors, WordCampMentors, {

		load: function() {
			App.getMultipleScripts( App.scripts ).done( App.init );
		},


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

	wp.api.loadPromise.done( App.load );

} )( window, jQuery );