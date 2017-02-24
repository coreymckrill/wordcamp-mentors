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
			this.filter     = new wordcamp.mentors.views.Filter( { el: '#tasks-filter' } );

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

			this.listeners();
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
		},


		listeners: function() {
			this.listenTo( this.filter, 'filter:tasks', this.updateVisibleTasks );
		},


		_getVisibleTasks: function( filter ) {
			var taskCollection = this.tasks,
				tasks;

			if ( 'any' !== filter.wcm_task_category ) {
				taskCollection = new Backbone.Collection( _.filter( taskCollection.models, function ( task ) {
					return _.contains( task.get( 'wcm_task_category' ), parseInt( filter.wcm_task_category ) );
				}) );
			}

			if ( 'any' !== filter.status ) {
				tasks = taskCollection.where( { status: filter.status } );
			} else {
				tasks = taskCollection.models;
			}

			return tasks;
		},


		updateVisibleTasks: function( filter ) {
			var visibleTasks = this._getVisibleTasks( filter );

			_.each( this.tasks.models, function( task ) {
				task.trigger( 'visibility:hide' );
			});

			_.each( visibleTasks, function( task ) {
				task.trigger( 'visibility:show' );
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

			this.listeners();

			return this;
		},


		render: function( data ) {
			this.$el.html( this.template( data ) );

			return this;
		},


		listeners: function() {
			this.listenTo( this.model, 'visibility:show', this.showMe );
			this.listenTo( this.model, 'visibility:hide', this.hideMe );
		},


		showMe: function() {
			this.$el.show();
		},


		hideMe: function() {
			this.$el.hide();
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


	wordcamp.mentors.views.Filter = Backbone.View.extend( {

		events: {
			'submit': 'setFilter'
		},


		setFilter: function( event ) {
			event.preventDefault();

			var filter = {};

			$( event.target ).find( 'select' ).each( function() {
				var attribute = $( this ).data( 'attribute' ),
					value     = $( this ).val();

				filter[ attribute ] = value;
			});

			this.trigger( 'filter:tasks', filter );
		}

	});

} )( window, jQuery );