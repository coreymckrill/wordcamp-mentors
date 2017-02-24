/** global Backbone */

( function( window, $ ) {

	'use strict';

	window.wordcamp = window.wordcamp || {};

	if ( ! wordcamp.mentors instanceof wordcamp.MentorsApp ) {
		return;
	}


	wordcamp.mentors.views.List = Backbone.View.extend( {

		initialize: function() {
			this.tasks      = new wp.api.collections.Wcm_task();
			this.categories = new wp.api.collections.Wcm_task_category();

			var view = this,
				taskData = {
					filter: {
						'orderby': 'menu_order',
						'order': 'ASC'
					}
				};

			$.when( this.tasks.fetch( taskData ), this.categories.fetch() ).done( function() {
				if ( view.tasks.length ) {
					view.render();
				}
			});
		},

		render: function() {
			var view = this;

			view.$el.html( '' );

			this.tasks.each( function( model ) {
				var categories, task;

				categories = _.filter( view.categories.models, function( category ) {
					return _.contains( model.get( 'wcm_task_category' ), category.get( 'id' ) );
				});

				task = new wordcamp.mentors.views.Task( {
					model: model,
					categories: categories
				});

				view.$el.append( task.$el );
			});
		}

	});


	wordcamp.mentors.views.Task = Backbone.View.extend( {

		tagName: 'tr',


		id: function() {
			return wordcamp.mentors.prefix + '-task-' + this.model.get( 'id' );
		},


		className: wordcamp.mentors.prefix + '-task',


		template: wp.template( wordcamp.mentors.prefix + '-task' ),


		initialize: function( options ) {
			this.categories = options.categories;

			var data = $.extend( {}, this.model.attributes, {
				wcm_task_category: this.categories,
				stati: wordcamp.mentors.stati
			} );

			this.render( data );

			return this;
		},


		render: function( data ) {
			this.$el.html( this.template( data ) );

			return this;
		},


		events: {
			'change .column-status select': 'changeStatus'
		},


		changeStatus: function( event ) {
			var value = $( event.target ).val();

			this.model.set( 'status', value );
			this.model.save();

			return this;
		},


		updateStatus: function() {

		}
	});

} )( window, jQuery );